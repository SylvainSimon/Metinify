<?php

namespace Administration;

require __DIR__ . '../../../core/initialize.php';

class SQL_Procedure_Bannissement extends \PageHelper {

    public function run() {
        @include '../../pages/Fonctions_Utiles.php';


        $raison = $_POST["raison"];
        $id_raison = $_POST["id_raison"];
        $id_compte = $_POST["id_compte"];
        $commentaire = $_POST["commentaire"];
        $this->objConnection_Ip = $_SERVER['REMOTE_ADDR'];

        /* ------------------------ $Recuperation_Raison ---- ---------------------------- */
        $Recuperation_Raison = "SELECT *
                        FROM site.bannissement_raisons
                        WHERE raison = :raison
                        AND id = :id_raison
                        LIMIT 1";
        $Parametres_Recuperation_Raison = $this->objConnection->prepare($Recuperation_Raison);
        $Parametres_Recuperation_Raison->execute(array(
            ':raison' => $raison,
            ':id_raison' => $id_raison
        ));
        $Parametres_Recuperation_Raison->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Recuperation_Raison = $Parametres_Recuperation_Raison->rowCount();
        /* -------------------------------------------------------------------------- */
        ?>
        <?php if ($Nombre_De_Resultat_Recuperation_Raison != 0) { ?>
            <?php $Donnees_Recuperation_Raison = $Parametres_Recuperation_Raison->fetch(); ?>

            <?php if ($Donnees_Recuperation_Raison->sanction == 999) { ?>
                <?php $Definitif = '1'; ?>
            <?php } else { ?>
                <?php $Definitif = '0'; ?>
                <?php

            }

            /* ----------------- Update Compte --------------------- */
            $Update_Compte = "UPDATE account.account 
                      SET status = 'BLOCK' 
                      WHERE id = :id_compte
                      LIMIT 1";

            $Parametres_Update_Compte = $this->objConnection->prepare($Update_Compte);
            $Parametres_Update_Compte->execute(
                    array(
                        ':id_compte' => $id_compte
                    )
            );
            /* ----------------------------------------------------------- */

            /* ------------------------ $Recuperation_Email ---- ---------------------------- */
            $Recuperation_Email = "SELECT email, login
                            FROM account.account
                            WHERE id = :id_compte
                            LIMIT 1";
            $Parametres_Recuperation_Email = $this->objConnection->prepare($Recuperation_Email);
            $Parametres_Recuperation_Email->execute(array(
                ':id_compte' => $id_compte
            ));
            $Parametres_Recuperation_Email->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Recuperation_Email = $Parametres_Recuperation_Email->fetch();
            /* -------------------------------------------------------------------------- */

            $to = $Donnees_Recuperation_Email->email;

            $subject = 'VamosMt2 - Bannissement de ' . $Donnees_Recuperation_Email->login . '';

            $headers = "From: \"VamosMt2\" <contact@vamosmt2.fr>" . "\n";
            $headers .= "Reply-to: \"VamosMt2\" <contact@vamosmt2.fr>" . "\r\n";
            $headers .= 'Mime-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $headers .= "\r\n";

            $msg = 'Bonjour ' . $Donnees_Recuperation_Email->login . '' . "<br/>";
            $msg .= '' . "<br/>";
            $msg .= 'Votre compte a été banni de nos serveurs.' . "<br/>";
            $msg .= '' . "<br/>";
            $msg .= 'La raison est : ' . $Donnees_Recuperation_Raison->raison . ' ' . "<br/>";
            if ($Definitif == 1) {
                $msg .= 'Ce bannissement est définitif.' . "<br/>";
            } else {
                $msg .= 'Ce bannissement n\'est pas définif et nous vous invitons a vous rendre sur VamosMt2 afin d\'en connaitre les détails.' . "<br/>";
            }
            $msg .= '' . "<br/>";
            $msg .= 'Pour toute réclamation, veuillez vous adressez à l\'équipe via le formulaire sur le site.' . "<br/>";
            $msg .= '' . "<br/>";
            $msg .= 'Cordialement, Vamosmt2.' . "<br/>";
            $msg .= '' . "<br/>";

            mail($to, $subject, $msg, $headers);



            $Insertion_Logs = "INSERT INTO site.bannissements_actifs (id_compte, date_debut_bannissement, date_fin_bannissement, raison_bannissement, commentaire_bannissement, id_compte_gm, ip_gm, duree, definitif) 
                          VALUES (:id_compte, NOW(), (NOW() + INTERVAL $Donnees_Recuperation_Raison->sanction DAY), :raison_bannissement, :commentaire_bannissement, :id_compte_gm, :ip_gm, :duree, :definitif)";

            $Paremetres_Insertion = $this->objConnection->prepare($Insertion_Logs);
            $Paremetres_Insertion->execute(array(
                ':id_compte' => $id_compte,
                ':raison_bannissement' => $id_raison,
                ':commentaire_bannissement' => $commentaire,
                ':id_compte_gm' => $_SESSION["ID"],
                ':ip_gm' => $this->objConnection_Ip,
                ':duree' => $Donnees_Recuperation_Raison->sanction,
                ':definitif' => $Definitif,
            ));
            /* ----------------------------------------------------------------------------------------------------------------------------------- */
            ?>
            <?php

            $Tableau_Retour_Json = array(
                'result' => "WIN",
                'id_compte' => $id_compte,
                'reasons' => "Le bannissement est effectif."
            );
            ?>
        <?php } else { ?>

            <?php

            $Tableau_Retour_Json = array(
                'result' => "FAIL",
                'reasons' => "Cette sanction n'est pas valide."
            );
            ?>
        <?php } ?>

        <?php echo json_encode($Tableau_Retour_Json); ?>
        <?php

    }

}

$class = new SQL_Procedure_Bannissement();
$class->run();

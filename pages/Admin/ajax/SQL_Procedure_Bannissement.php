<?php

namespace Administration\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class SQL_Procedure_Bannissement extends \ScriptHelper {

    public $isProtected = true;
    public $isAdminProtected = true;

    public function run() {

        global $request;
        
        $raison = $request->request->get("raison");
        $id_raison = $request->request->get("id_raison");
        $id_compte = $request->request->get("id_compte");
        $commentaire = $request->request->get("commentaire");
        $this->objConnection_Ip = $request->server->get("REMOTE_ADDR");

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


            $template = $this->objTwig->loadTemplate("BanissementCompte.html5.twig");
            $result = $template->render([
                "compte" => $Donnees_Recuperation_Email->login,
                "definitif" => $Definitif,
                "raison" => $Donnees_Recuperation_Raison->raison
            ]);

            $subject = 'VamosMt2 - Bannissement de ' . $Donnees_Recuperation_Email->login . '';
            \EmailHelper::sendEmail($Donnees_Recuperation_Email->email, $subject, $result);

            $Insertion_Logs = "INSERT INTO site.bannissements_actifs (id_compte, date_debut_bannissement, date_fin_bannissement, raison_bannissement, commentaire_bannissement, id_compte_gm, ip_gm, duree, definitif) 
                          VALUES (:id_compte, NOW(), (NOW() + INTERVAL $Donnees_Recuperation_Raison->sanction DAY), :raison_bannissement, :commentaire_bannissement, :id_compte_gm, :ip_gm, :duree, :definitif)";

            $Paremetres_Insertion = $this->objConnection->prepare($Insertion_Logs);
            $Paremetres_Insertion->execute(array(
                ':id_compte' => $id_compte,
                ':raison_bannissement' => $id_raison,
                ':commentaire_bannissement' => $commentaire,
                ':id_compte_gm' => $this->objAccount->getId(),
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

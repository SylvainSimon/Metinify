<?php

namespace Administration\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class SQL_Procedure_Debannissement extends \ScriptHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    
    public function run() {


        $Id_Compte_Debannissement = $_POST['id_compte'];

        /* ------------------------ Vérification Données ---------------------------- */
        $Recuperation_Droits = "SELECT * 
                        FROM site.administration_users
                        WHERE id_compte = :id_compte
                        LIMIT 1";
        $Parametres_Recuperation_Droits = $this->objConnection->prepare($Recuperation_Droits);
        $Parametres_Recuperation_Droits->execute(array(':id_compte' => $_SESSION["ID"]));
        $Parametres_Recuperation_Droits->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Recuperation_Droits = $Parametres_Recuperation_Droits->rowCount();
        /* -------------------------------------------------------------------------- */

        if ($Nombre_De_Resultat_Recuperation_Droits != 0) {
            $Donnees_Recuperation_Droits = $Parametres_Recuperation_Droits->fetch();
            if ($Donnees_Recuperation_Droits->debannissement == 1) {

                /* ----------------- Update Compte --------------------- */
                $Update_Compte = "UPDATE account.account 
                      SET status = 'OK' 
                      WHERE id = :id_compte
                      LIMIT 1";

                $Parametres_Update_Compte = $this->objConnection->prepare($Update_Compte);
                $Parametres_Update_Compte->execute(
                        array(
                            ':id_compte' => $Id_Compte_Debannissement
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
                    ':id_compte' => $Id_Compte_Debannissement
                ));
                $Parametres_Recuperation_Email->setFetchMode(\PDO::FETCH_OBJ);
                $Donnees_Recuperation_Email = $Parametres_Recuperation_Email->fetch();
                /* -------------------------------------------------------------------------- */


                $to = $Donnees_Recuperation_Email->email;

                $subject = 'VamosMt2 - Levé du bannissement de ' . $Donnees_Recuperation_Email->login . '';

                $headers = "From: \"VamosMt2\" <contact@vamosmt2.fr>" . "\n";
                $headers .= "Reply-to: \"VamosMt2\" <contact@vamosmt2.fr>" . "\r\n";
                $headers .= 'Mime-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                $headers .= "\r\n";

                $msg = 'Bonjour ' . $Donnees_Recuperation_Email->login . '' . "<br/>";
                $msg .= '' . "<br/>";
                $msg .= 'Votre compte vien d\'être débloqué de nos serveurs.' . "<br/>";
                $msg .= '' . "<br/>";
                $msg .= 'Pour toute réclamation, veuillez vous adressez à l\'équipe via le formulaire sur le site.' . "<br/>";
                $msg .= '' . "<br/>";
                $msg .= 'Cordialement, Vamosmt2.' . "<br/>";
                $msg .= '' . "<br/>";

                mail($to, $subject, $msg, $headers);

                /* ------------------------------------- Insertion Player Deleted --------------------------------------- */
                $Insertion_Player_Deleted = "INSERT INTO site.historique_bannissements 
                                             SELECT * FROM site.bannissements_actifs
                                             WHERE bannissements_actifs.id_compte = ?";

                $Parametres_Insertion_Player_Deleted = $this->objConnection->prepare($Insertion_Player_Deleted);
                $Parametres_Insertion_Player_Deleted->execute(array(
                    $Id_Compte_Debannissement));
                /* -------------------------------------------------------------------------------------------------------- */

                $Dernier_Id_Inserer = $this->objConnection->lastInsertId();

                /* ------------------ Suppression Bannissements ---------------------------------------- */
                $Delete_Bannissement_Actif = "DELETE 
                                      FROM site.bannissements_actifs
                                      WHERE id_compte = :id_compte";

                $Parametres_Delete_Bannissement_Actif = $this->objConnection->prepare($Delete_Bannissement_Actif);
                $Parametres_Delete_Bannissement_Actif->execute(
                        array(
                            ':id_compte' => $Id_Compte_Debannissement
                        )
                );
                /* ------------------------------------------------------------------------------------- */

                /* ----------------- Update Email --------------------- */
                $Update_Mail = "UPDATE site.historique_bannissements 
                        SET debann_par = ?
                        WHERE historique_bannissements.id = ?
                        LIMIT 1";

                $Parametres_Update_Email = $this->objConnection->prepare($Update_Mail);
                $Parametres_Update_Email->execute(array(
                    $_SESSION["ID"],
                    $Dernier_Id_Inserer
                ));
                /* ----------------------------------------------------------- */

                echo "1";
            } else {
                "Interdiction_Acces";
            }
        } else {
            echo "Interdiction_Acces";
        }
?>
        <?php

    }

}

$class = new SQL_Procedure_Debannissement();
$class->run();

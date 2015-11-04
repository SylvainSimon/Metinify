<?php

namespace Pages\MonCompte\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxPasswordChangeSendEmail extends \ScriptHelper {

    public $isProtected = true;
    
    public function run() {


        $Mot_De_Passe_Ancien = $_POST['Ancien_Mot_De_Passe'];
        $Mot_De_Passe_Nouveau = $_POST["Nouveau_Mot_De_Passe"];

        $Changer_Mot_De_Passe_Envoie_Mail_Utilisateur = $_SESSION['Utilisateur'];
        $Changer_Mot_De_Passe_Envoie_Mail_ID = $_SESSION['ID'];
        $Changer_Mot_De_Passe_Envoie_Mail_Ip = $_SERVER["REMOTE_ADDR"];
        $Changer_Mot_De_Passe_Envoie_Mail_Email = $_SESSION['Email'];


        /* ------------------------ Vérification Données ---------------------------- */
        $Verification_Donnees = "SELECT id FROM account.account
                                   WHERE login = ?
                                   AND password = password(?)
                                   LIMIT 1";
        $Parametres_Verification_Donnees = $this->objConnection->prepare($Verification_Donnees);
        $Parametres_Verification_Donnees->execute(array(
            $Changer_Mot_De_Passe_Envoie_Mail_Utilisateur,
            $Mot_De_Passe_Ancien));
        $Parametres_Verification_Donnees->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat = $Parametres_Verification_Donnees->rowCount();
        /* -------------------------------------------------------------------------- */

        if ($Nombre_De_Resultat == 1) {

            /* -------------- Suppression autres demande ----------------------------------------------------- */
            $Delete_Demande_Changements = "DELETE 
                               FROM site.changement_mot_de_passe
                               WHERE id_compte = :id_compte";

            $Parametres_Delete_Demande_Changements = $this->objConnection->prepare($Delete_Demande_Changements);
            $Parametres_Delete_Demande_Changements->execute(
                    array(
                        ':id_compte' => $Changer_Mot_De_Passe_Envoie_Mail_ID
                    )
            );
            /* ------------------------------------------------------------------------------------------------ */


            mt_srand((float) microtime() * 1000000);
            $Nombre_Unique = mt_rand(0, 100000000000);

            /* ------------------------------------- Insertion Changement Mail --------------------------------------- */
            $Insertion_Changement_Mail = "INSERT site.changement_mot_de_passe (id_compte, compte, nouveau_mot_de_passe, numero_verif, date, ip) 
                                          VALUES (:id_compte, :compte, password(:nouveau_mot_de_passe), :numero_verif, NOW(), :ip)";

            $Parametres_Insertion_Changement_Mail = $this->objConnection->prepare($Insertion_Changement_Mail);
            $Parametres_Insertion_Changement_Mail->execute(array(
                ':id_compte' => $Changer_Mot_De_Passe_Envoie_Mail_ID,
                ':compte' => $Changer_Mot_De_Passe_Envoie_Mail_Utilisateur,
                ':nouveau_mot_de_passe' => $Mot_De_Passe_Nouveau,
                ':numero_verif' => $Nombre_Unique,
                ':ip' => $Changer_Mot_De_Passe_Envoie_Mail_Ip));
            /* -------------------------------------------------------------------------------------------------------- */

            $to = $Changer_Mot_De_Passe_Envoie_Mail_Email;

            $subject = 'VamosMT2 - Changement de mot de passe de ' . $Changer_Mot_De_Passe_Envoie_Mail_Utilisateur . '';

            $headers = "From: \"VamosMt2\" <contact@vamosmt2.org>" . "\n";
            $headers .= "Reply-to: \"VamosMt2\" <contact@vamosmt2.org>" . "\r\n";
            $headers .= 'Mime-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $headers .= "\r\n";

            $msg = 'Bonjour ' . $Changer_Mot_De_Passe_Envoie_Mail_Utilisateur . '' . "<br/>";
            $msg .= 'Vous avez demandé à changer de mot de passe sur votre compte.' . "<br/>";
            $msg .= '' . "<br/>";
            $msg .= 'Pour valider la demande veuillez indiquer le code suivant sur le site : ' . "<br/>";
            $msg .= '' . $Nombre_Unique . '' . "<br/>";
            $msg .= '' . "<br/>";
            $msg .= 'Cordialement, VamosMT2.' . "<br/>";
            $msg .= '' . "<br/>";

            mail($to, $subject, $msg, $headers);

            echo '1';
        } else {

            echo '2';
        }
?>
        <?php

    }

}

$class = new ajaxPasswordChangeSendEmail();
$class->run();

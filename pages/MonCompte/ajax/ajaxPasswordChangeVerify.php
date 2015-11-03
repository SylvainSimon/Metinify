<?php

namespace Pages\MonCompte\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxPasswordChangeVerify extends \PageHelper {

    public function run() {

        $Changer_Mot_De_Passe_Verification_Ip = $_SERVER["REMOTE_ADDR"];
        $Changer_Mot_De_Passe_Verification_Mail = $_SESSION["Email"];
        $Changer_Mot_De_Passe_Verification_Utilisateur = $_SESSION["Utilisateur"];
        $Changer_Mot_De_Passe_Verification_ID = $_SESSION["ID"];
        $Changer_Mot_De_Passe_Verification_Code_Verification = $_POST['code'];
        $Changer_Mot_De_Passe_Ip = $_SERVER["REMOTE_ADDR"];

        /* ------------------------ Vérification Données ---------------------------- */
        $Verification_Code = "SELECT * FROM site.changement_mot_de_passe
                                   WHERE numero_verif = ?
                                   AND ip = ?
                                   LIMIT 1";
        $Parametres_Verification_Code = $this->objConnection->prepare($Verification_Code);
        $Parametres_Verification_Code->execute(array(
            $Changer_Mot_De_Passe_Verification_Code_Verification,
            $Changer_Mot_De_Passe_Verification_Ip));
        $Parametres_Verification_Code->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat = $Parametres_Verification_Code->rowCount();
        /* -------------------------------------------------------------------------- */

        if ($Nombre_De_Resultat != 0) {

            $Donnees_Changer_Mot_De_Passe = $Parametres_Verification_Code->fetch();

            /* ----------------- Update Email --------------------- */
            $Update_Mot_De_Passe_Verif = "UPDATE account.account 
                SET password = ? 
                WHERE login = ?
                LIMIT 1";

            $Parametres_Update_Mot_De_Passe_Verif = $this->objConnection->prepare($Update_Mot_De_Passe_Verif);
            $Parametres_Update_Mot_De_Passe_Verif->execute(array(
                $Donnees_Changer_Mot_De_Passe->nouveau_mot_de_passe,
                $Donnees_Changer_Mot_De_Passe->compte));
            /* ----------------------------------------------------------- */

            /* ---------------- Delete Changement mot de passe ------------------------------------- */
            $Delete_Changement_Mot_De_Passe = "DELETE FROM site.changement_mot_de_passe
                                             WHERE id_compte = ?";

            $Parametres_Delete_Changement_Mail = $this->objConnection->prepare($Delete_Changement_Mot_De_Passe);
            $Parametres_Delete_Changement_Mail->execute(array(
                $Changer_Mot_De_Passe_Verification_ID));
            /* ------------------------------------------------------------------------------------- */

            /* ------------------------------------- Insertion Logs Changement Mail ---------------------------------- */
            $Insertion_Changement_Mot_De_Passe = "INSERT site.logs_changement_mot_de_passe (id_compte, compte, email, date, ip) 
                                          VALUES (:id_compte, :compte, :email, NOW(), :ip)";

            $Parametres_Insertion_Changement_Mot_De_Passe = $this->objConnection->prepare($Insertion_Changement_Mot_De_Passe);
            $Parametres_Insertion_Changement_Mot_De_Passe->execute(array(
                ':id_compte' => $Changer_Mot_De_Passe_Verification_ID,
                ':compte' => $Donnees_Changer_Mot_De_Passe->compte,
                ':email' => $Changer_Mot_De_Passe_Verification_Mail,
                ':ip' => $Changer_Mot_De_Passe_Ip));
            /* -------------------------------------------------------------------------------------------------------- */

            $to = $Changer_Mot_De_Passe_Verification_Mail;

            $subject = 'VamosMt2 - Changement de Mot de Passe de ' . $Changer_Mot_De_Passe_Verification_Utilisateur . '';

            $headers = "From: \"VamosMt2\" <contact@vamosmt2.fr>" . "\n";
            $headers .= "Reply-to: \"VamosMt2\" <contact@vamosmt2.fr>" . "\r\n";
            $headers .= 'Mime-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $headers .= "\r\n";

            $msg = 'Bonjour ' . $Changer_Mot_De_Passe_Verification_Utilisateur . '' . "<br/>";
            $msg .= '' . "<br/>";
            $msg .= 'Votre mot de passe a bien été changé ce jour sur VamosMT2.' . "<br/>";
            $msg .= 'En cas de problèmes n\'hésitez pas à contacter le support.' . "<br/>";
            $msg .= '' . "<br/>";
            $msg .= 'Cordialement, VamosMT2.' . "<br/>";
            $msg .= '' . "<br/>";

            mail($to, $subject, $msg, $headers);

            echo "1";
        } else {

            echo "2";
        }
?>
        <?php

    }

}

$class = new ajaxPasswordChangeVerify();
$class->run();

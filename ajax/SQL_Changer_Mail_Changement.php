<?php

namespace Ajax;

require __DIR__ . '../../core/initialize.php';

class SQL_Changer_Mail_Changement extends \PageHelper {

    public function run() {


        $Changement_Mail_Utilisateur = $_SESSION['Utilisateur'];
        $Changement_Mail_Ancien_Mail = $_SESSION['Email'];
        $Changement_Mail_Ancien_ID = $_SESSION['ID'];
        $Changement_Mail_Nouveau_Mail = $_POST['emailapres'];
        $Changement_Mail_Ip = $_SERVER["REMOTE_ADDR"];

        /* ------------------------------------- Insertion Logs Changement Mail --------------------------------------- */
        $Insertion_Logs_Changement_Mail = "INSERT INTO site.logs_changement_mail (id_compte, compte, ancien_mail, nouveau_mail, date, ip) 
                                          VALUES (:id_compte, :compte, :ancien_mail,:nouveau_mail, NOW(), :ip)";

        $Parametres_Insertion_Logs_Changement_Mail = $this->objConnection->prepare($Insertion_Logs_Changement_Mail);
        $Parametres_Insertion_Logs_Changement_Mail->execute(array(
            ':id_compte' => $Changement_Mail_Ancien_ID,
            ':compte' => $Changement_Mail_Utilisateur,
            ':ancien_mail' => $Changement_Mail_Ancien_Mail,
            ':nouveau_mail' => $Changement_Mail_Nouveau_Mail,
            ':ip' => $Changement_Mail_Ip));
        /* ------------------------------------------------------------------------------------------------------------ */

        /* ----------------- Update Email --------------------- */
        $Update_Mail = "UPDATE account.account 
                SET email = ? 
                WHERE login = ?
                LIMIT 1";

        $Parametres_Update_Email = $this->objConnection->prepare($Update_Mail);
        $Parametres_Update_Email->execute(array(
            $Changement_Mail_Nouveau_Mail,
            $Changement_Mail_Utilisateur));
        /* ----------------------------------------------------------- */

        /* ---------------- Delete Changement Mail ------------------- */
        $Delete_Changement_Mail = "DELETE FROM site.changement_mail
                                  WHERE compte = ?";

        $Parametres_Delete_Changement_Mail = $this->objConnection->prepare($Delete_Changement_Mail);
        $Parametres_Delete_Changement_Mail->execute(array(
            $Changement_Mail_Utilisateur));
        /* ----------------------------------------------------------- */

        $to = $Changement_Mail_Nouveau_Mail;

        $subject = 'VamosMt2 - Changement de mail de ' . $Changement_Mail_Utilisateur . '';

        $headers = "From: \"VamosMt2\" <contact@vamosmt2.fr>" . "\n";
        $headers .= "Reply-to: \"VamosMt2\" <contact@vamosmt2.fr>" . "\r\n";
        $headers .= 'Mime-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= "\r\n";

        $msg = 'Bonjour ' . $Changement_Mail_Utilisateur . '' . "<br/>";
        $msg .= '' . "<br/>";
        $msg .= 'Votre nouvelle e-mail est a présent effectif' . "<br/>";
        $msg .= '' . "<br/>";
        $msg .= 'Cordialement, Vamosmt2.' . "<br/>";
        $msg .= '' . "<br/>";

        mail($to, $subject, $msg, $headers);

        $to = $Changement_Mail_Ancien_Mail;

        $subject = 'VamosMt2 - Changement de mail de ' . $Changement_Mail_Utilisateur . '';

        $headers = "From: \"VamosMt2\" <contact@vamosmt2.fr>" . "\n";
        $headers .= "Reply-to: \"VamosMt2\" <contact@vamosmt2.fr>" . "\r\n";
        $headers .= 'Mime-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= "\r\n";

        $msg = 'Bonjour ' . $Changement_Mail_Utilisateur . '' . "<br/>";
        $msg .= '' . "<br/>";
        $msg .= 'Votre nouvelle e-mail ' . $_POST['emailapres'] . ' est a présent effective' . "<br/>";
        $msg .= 'Vous ne recevrez plus de mail sur ' . $Changement_Mail_Ancien_Mail . '.' . "<br/>";
        $msg .= '' . "<br/>";
        $msg .= 'Cordialement, Vamosmt2.' . "<br/>";
        $msg .= '' . "<br/>";

        mail($to, $subject, $msg, $headers);

        $_SESSION['Email'] = $Changement_Mail_Nouveau_Mail;

        echo '1';
?>
        <?php

    }

}

$class = new SQL_Changer_Mail_Changement();
$class->run();

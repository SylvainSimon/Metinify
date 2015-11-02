<?php

namespace Ajax;

require __DIR__ . '../../core/initialize.php';

class SQL_Contact_Envoie_Mail extends \PageHelper {

    public function run() {
        $Variables_Contact_Nom = $_POST["Nom"];
        $Variables_Contact_Email = $_POST["Email"];
        $Variables_Contact_Objet = $_POST["Objet"];
        $Variables_Contact_Message = $_POST["Message"];

        $to = "loco-tourte@romandie.com";

        $subject = 'VamosMt2 - Contacts de ' . $Variables_Contact_Nom . '';

        $headers = "From: \"VamosMt2\" <" . $Variables_Contact_Email . ">" . "\n";
        $headers .= "Reply-to: \"VamosMt2\" <" . $Variables_Contact_Email . ">" . "\r\n";
        $headers .= 'Mime-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= "\r\n";

        $msg = 'Bonjour Vamos !' . "<br/>";
        $msg .= 'Un utilisateur vous a écrit depuis la partie contact de votre site.' . "<br/>";
        $msg .= '' . "<br/>";
        $msg .= 'Il s\'appel : ' . $Variables_Contact_Nom . '.' . "<br/>";
        $msg .= 'Son e-mail est : ' . $Variables_Contact_Email . '.' . "<br/>";
        $msg .= 'L\'objet de son message est : ' . $Variables_Contact_Objet . '.' . "<br/>";
        $msg .= 'Le contenue est : ' . $Variables_Contact_Message . '.' . "<br/>";
        $msg .= '' . "<br/>";
        $msg .= 'Bonne journée !' . "<br/>";

        if (mail($to, $subject, $msg, $headers)) {
            echo "1";
        } else {
            echo "2";
        }
    }

}

$class = new SQL_Contact_Envoie_Mail();
$class->run();

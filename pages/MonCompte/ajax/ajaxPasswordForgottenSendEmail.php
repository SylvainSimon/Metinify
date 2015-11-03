<?php

namespace Pages\MonCompte\Ajax;

require __DIR__ . '../../core/initialize.php';

class ajaxPasswordForgottenSendEmail extends \PageHelper {

    public function run() {

        $Mot_De_Passe_Oublie_Compte = $_POST['Mot_De_Passe_Oublie_Compte'];
        $Mot_De_Passe_Oublie_Email = $_POST['Mot_De_Passe_Oublie_Email'];
        $Mot_De_Passe_Oublie_Ip = $_SERVER["REMOTE_ADDR"];
        $Mot_De_Passe_Oublie_Resultat = "";

        /* ------------------------ Vérification Données ---------------------------- */
        $Verification_Donnees = "SELECT id FROM account.account
                                   WHERE login = ?
                                   AND email = ?
                                   LIMIT 1";
        $Parametres_Verification_Donnees = $this->objConnection->prepare($Verification_Donnees);
        $Parametres_Verification_Donnees->execute(array(
            $Mot_De_Passe_Oublie_Compte,
            $Mot_De_Passe_Oublie_Email));
        $Parametres_Verification_Donnees->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat = $Parametres_Verification_Donnees->rowCount();
        /* -------------------------------------------------------------------------- */

        if ($Nombre_De_Resultat != 0) {

            $Mot_De_Passe_Generer = "";

            $Chaine_De_Caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@";
            $Nombre_Caractere = 8;

            for ($i = 1; $i <= $Nombre_Caractere; $i++) {

                $Taille_De_La_Chaine = strlen($Chaine_De_Caracteres);
                $Position_Aleatoire = mt_rand(0, ($Taille_De_La_Chaine - 1));

                $Mot_De_Passe_Generer .= $Chaine_De_Caracteres[$Position_Aleatoire];
            }

            $to = $Mot_De_Passe_Oublie_Email;

            $subject = 'VamosMt2 - Nouveau Mot de Passe';

            $headers = "From: \"VamosMT2\" <noreply@vamosmt2.org>" . "\n";
            $headers .= "Reply-to: \"VamosMT2\" <noreply@vamosmt2.org>" . "\r\n";
            $headers .= 'Mime-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $headers .= "\r\n";

            $msg = 'Vous avez demandé une nouveau mot de passe sur VamosMT2.' . "<br/>";
            $msg .= 'Vous le trouverez ci-joint, générer aléatoirement.' . "<br/>";
            $msg .= '' . "<br/>";
            $msg .= 'Nouveau Mot de passe : ' . $Mot_De_Passe_Generer . '' . "<br/>";
            $msg .= '' . "<br/>";
            $msg .= 'Bon jeu sur VamosMT2 !' . "<br/>";
            $msg .= '' . "<br/>";

            mail($to, $subject, $msg, $headers);


            /* ----------------- Update mot de passe --------------------- */
            $Update_Mot_De_Passe = "UPDATE account.account 
                               SET password=password(?) 
                               WHERE login=?";

            $Parametres_Update = $this->objConnection->prepare($Update_Mot_De_Passe);
            $Parametres_Update->execute(array(
                $Mot_De_Passe_Generer,
                $Mot_De_Passe_Oublie_Compte));
            /* ----------------------------------------------------------- */

            $Mot_De_Passe_Oublie_Resultat = "1";
            echo "1";
        } else {

            $Mot_De_Passe_Oublie_Resultat = "0";
            echo "2";
        }

        /* -------------------------------------------- Insertion logs --------------------------------------------------- */
        $Insertion_Logs = "INSERT INTO site.logs_oublie_mot_de_passe (compte_essaye, email_essaye, date_essai, resultat_demande, ip) 
                          VALUES (:compte_essaye,:email_essaye, NOW(), :resultat_demande, :ip)";

        $Parametres_Insertion = $this->objConnection->prepare($Insertion_Logs);
        $Parametres_Insertion->execute(array(
            ':compte_essaye' => $Mot_De_Passe_Oublie_Compte,
            ':email_essaye' => $Mot_De_Passe_Oublie_Email,
            ':resultat_demande' => $Mot_De_Passe_Oublie_Resultat,
            ':ip' => $Mot_De_Passe_Oublie_Ip));
        /* ---------------------------------------------------------------------------------------------------------------- */
    }

}

$class = new ajaxPasswordForgottenSendEmail();
$class->run();
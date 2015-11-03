<?php

namespace Ajax;

require __DIR__ . '../../core/initialize.php';

class SQL_Inscription2 extends \PageHelper {

    public function run() {
        include_once '../pages/Fonctions_Utiles.php';

        $Inscription_Utilisateur = $_POST["Utilisateur"];
        $Inscription_Utilisateur_Trim = trim($Inscription_Utilisateur);
        $Inscription_Mot_De_Passe = $_POST["Mot_De_Passe"];
        $Inscription_Email = $_POST["Email"];
        $Inscription_Cash = "0";
        $Inscription_Mileage = "0";
        $Inscription_Droits = "1";
        $Inscription_Ip = $_SERVER['REMOTE_ADDR'];
        $Status = ".";

        $ip_formate = ipAdressNumber($Inscription_Ip);

        /* ------------------------ Recherche Pays ---------------------------- */
        $Recherche_Pays = "SELECT * 
                   FROM site.ip_to_country 
                   WHERE ? BETWEEN IP_FROM AND IP_TO";
        $Parametres_Recherche_Pays = $this->objConnection->prepare($Recherche_Pays);
        $Parametres_Recherche_Pays->execute(array(
            $ip_formate));
        $Parametres_Recherche_Pays->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Recherche_Pays = $Parametres_Recherche_Pays->rowCount();
        /* -------------------------------------------------------------------------- */
        if ($Nombre_De_Resultat_Recherche_Pays != 0) {
            $Donnees_Recherche_Pays = $Parametres_Recherche_Pays->fetch();
            $Langue = $Donnees_Recherche_Pays->CNTRY;
        } else {
            $Langue = "Inconnu";
        }

        /* ------------------------------------------------ Inscription ---------------------------------------------------------------------- */
        $Insertion_Logs = "INSERT INTO account.account (login, password, email, create_time, mileage, cash, ip_creation, langue, status) 
                          VALUES (:login, password(:password), :email, NOW(), :mileage, :cash, :ip_creation, :langue, :status)";

        $Paremetres_Insertion = $this->objConnection->prepare($Insertion_Logs);
        $Paremetres_Insertion->execute(array(
            ':login' => $Inscription_Utilisateur_Trim,
            ':password' => $Inscription_Mot_De_Passe,
            ':email' => $Inscription_Email,
            ':mileage' => $Inscription_Mileage,
            ':cash' => $Inscription_Cash,
            ':ip_creation' => $Inscription_Ip,
            ':langue' => $Langue,
            ':status' => $Status));
        /* ----------------------------------------------------------------------------------------------------------------------------------- */

        $_SESSION['NomTemporaire'] = $Inscription_Utilisateur_Trim;

        $Id = $this->objConnection->lastInsertId();

        $to = $Inscription_Email;

        $subject = 'VamosMt2 - Activation de votre compte ' . $Inscription_Utilisateur . '';

        $headers = "From: \"VamosMt2\" <noreply@vamosmt2.org>" . "\n";
        $headers .= "Reply-to: \"VamosMt2\" <noreply@vamosmt2.org>" . "\r\n";
        $headers .= 'Mime-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= "\r\n";

        $msg = 'Bienvenue ' . $Inscription_Utilisateur . '' . "<br/>";
        $msg .= '' . "<br/>";
        $msg .= 'Afin de pouvoir jouer, une activation est requise en cliquant sur le lien ci-dessous:' . "<br/>";
        $msg .= '<a href="https://vamosmt2.org/Activation.php?id=' . $Id . '">Activer mon compte</a>' . "<br/>";
        $msg .= '' . "<br/>";
        $msg .= 'Si votre navigateur ne supporte pas les liens:' . "<br />";
        $msg .= 'https://vamosmt2.org/Activation.php?id=' . $Id . '' . "<br/>";
        $msg .= '' . "<br/>";
        $msg .= 'Contactez le support en cas de problème.' . "<br/>";
        $msg .= '' . "<br/>";
        $msg .= 'Bon jeu sur VamosMT2 ! =)' . "<br/>";
        $msg .= '' . "<br/>";

        mail($to, $subject, $msg, $headers);

        echo "1";
    }

}

$class = new SQL_Inscription2();
$class->run();

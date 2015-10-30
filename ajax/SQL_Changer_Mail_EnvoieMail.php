<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include '../configPDO.php'; ?>

<?php

$Envoie_Mail_Utilisateur = $_SESSION['Utilisateur'];
$Envoie_Mail_ID = $_SESSION['ID'];
$Envoie_Mail_Ip = $_SERVER["REMOTE_ADDR"];
$Envoie_Mail_Email = $_SESSION['Email'];

mt_srand((float) microtime() * 1000000);
$Nombre_Unique = mt_rand(0, 100000000000);

/* -------------- Suppression autres demande ----------------------------------------------------- */
$Delete_Demande_Changements = "DELETE 
                               FROM $BDD_Site.changement_mail
                               WHERE id_compte = :id_compte";

$Parametres_Delete_Demande_Changements = $Connexion->prepare($Delete_Demande_Changements);
$Parametres_Delete_Demande_Changements->execute(
        array(
            ':id_compte' => $Envoie_Mail_ID
        )
);
/* ------------------------------------------------------------------------------------------------ */

/* ------------------------------------- Insertion Changement Mail --------------------------------------- */
$Insertion_Changement_Mail = "INSERT $BDD_Site.changement_mail (id_compte, compte, email, numero_verif, date, ip) 
                                          VALUES (:id_compte, :compte, :email, :numero_verif, NOW(), :ip)";

$Parametres_Insertion_Changement_Mail = $Connexion->prepare($Insertion_Changement_Mail);
$Parametres_Insertion_Changement_Mail->execute(array(
    ':id_compte' => $Envoie_Mail_ID,
    ':compte' => $Envoie_Mail_Utilisateur,
    ':email' => $Envoie_Mail_Email,
    ':numero_verif' => $Nombre_Unique,
    ':ip' => $Envoie_Mail_Ip));
/* -------------------------------------------------------------------------------------------------------- */

$to = $Envoie_Mail_Email;

$subject = 'VamosMt2 - Changement de mail de ' . $Envoie_Mail_Utilisateur . '';

$headers = "From: \"VamosMt2\" <contact@vamosmt2.fr>" . "\n";
$headers .= "Reply-to: \"VamosMt2\" <contact@vamosmt2.fr>" . "\r\n";
$headers .= 'Mime-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
$headers .= "\r\n";

$msg = 'Bonjour ' . $Envoie_Mail_Utilisateur . '' . "<br/>";
$msg .= 'Vous avez demandé à changer d\'email sur votre compte.' . "<br/>";
$msg .= '' . "<br/>";
$msg .= 'Pour valider la demande veuillez indiquez le code suivant sur le site : ' . "<br/>";
$msg .= '' . $Nombre_Unique . '' . "<br/>";
$msg .= '' . "<br/>";
$msg .= 'Cordialement, Vamosmt2.' . "<br/>";
$msg .= '' . "<br/>";

mail($to, $subject, $msg, $headers);

echo '1';

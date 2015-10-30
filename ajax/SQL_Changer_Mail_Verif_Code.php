<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include '../configPDO.php'; ?>

<?php

$Changer_Mail_Verification_Ip = $_SERVER["REMOTE_ADDR"];
$Changer_Mail_Verification_Code_Verification = $_POST['code'];

/* ------------------------ Vérification Données ---------------------------- */
$Verification_Code = "SELECT * FROM site.changement_mail
                                   WHERE numero_verif = ?
                                   AND ip = ?
                                   LIMIT 1";
$Parametres_Verification_Code = $Connexion->prepare($Verification_Code);
$Parametres_Verification_Code->execute(array(
    $Changer_Mail_Verification_Code_Verification,
    $Changer_Mail_Verification_Ip));
$Parametres_Verification_Code->setFetchMode(PDO::FETCH_BOTH);
$Nombre_De_Resultat = $Parametres_Verification_Code->rowCount();
/* -------------------------------------------------------------------------- */

if ($Nombre_De_Resultat == 1) {

    echo "1";
} else {

    echo "2";
}
?>
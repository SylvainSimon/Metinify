<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include '../configPDO.php'; ?>
<?php

$Ip = $_SERVER['REMOTE_ADDR'];
$Jeton = $_POST["numero"];

/* ------------------------ Vérification Données ---------------------------- */
$Verification_Jeton = "SELECT id_compte 
                       FROM $BDD_Site.administration_pannel_jetons
                       WHERE jeton = :jeton
                       AND ip = :ip
                       LIMIT 1";
$Parametres_Verification_Jeton = $Connexion->prepare($Verification_Jeton);
$Parametres_Verification_Jeton->execute(array(
    ':jeton' => $Jeton,
    ':ip' => $Ip));
$Parametres_Verification_Jeton->setFetchMode(PDO::FETCH_OBJ);
$Nombre_De_Resultat_Verification_Jeton = $Parametres_Verification_Jeton->rowCount();
/* -------------------------------------------------------------------------- */

if ($Nombre_De_Resultat_Verification_Jeton != 0) {
    
    $Donnees_Verification_Jeton = $Parametres_Verification_Jeton->fetch();
    
    $Tableau_Retour_Json = array(
        'result' => "WIN",
        'reasons' => "Chargement du pannel d'administration...",
        'id_compte' => "".$Donnees_Verification_Jeton->id_compte
    );
} else {
    $Tableau_Retour_Json = array(
        'result' => "FAIL",
        'reasons' => "Interdiction d'accès au pannel."
    );
}
?>
<?php echo json_encode($Tableau_Retour_Json); ?>
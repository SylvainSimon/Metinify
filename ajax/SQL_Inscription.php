<?php @session_write_close(); ?>
<?php @session_start(); ?>

<?php include_once '../configPDO.php'; ?>
<?php include_once '../pages/Fonctions_Utiles.php'; ?>

<?php

$Inscription_Utilisateur = $_POST["Utilisateur"];
$Inscription_Utilisateur_Trim = trim($Inscription_Utilisateur);
$Inscription_Mot_De_Passe = $_POST["Mot_De_Passe"];
$Inscription_Email = $_POST["Email"];
$Inscription_Cash = "0";
$Inscription_Mileage = "0";
$Inscription_Droits = "1";
$Inscription_Ip = $_SERVER['REMOTE_ADDR'];
$Status = "OK";

$ip_formate = ipAdressNumber($Inscription_Ip);

/* ------------------------ Recherche Pays ---------------------------- */
$Recherche_Pays = "SELECT * 
                   FROM $BDD_Site.ip_to_country 
                   WHERE ? BETWEEN IP_FROM AND IP_TO";
$Parametres_Recherche_Pays = $Connexion->prepare($Recherche_Pays);
$Parametres_Recherche_Pays->execute(array(
    $ip_formate));
$Parametres_Recherche_Pays->setFetchMode(PDO::FETCH_OBJ);
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

$Paremetres_Insertion = $Connexion->prepare($Insertion_Logs);
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

echo "1";

?>

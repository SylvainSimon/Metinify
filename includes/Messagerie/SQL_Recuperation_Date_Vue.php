<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include '../../configPDO.php'; ?>
<?php include '../../pages/Fonctions_Utiles.php'; ?>
<?php

$ID_Message = $_POST['id'];

/* ----------------------- Recuperation Date ------------------------------- */
$Recuperation_Date = "SELECT * FROM $BDD_Site.support_ticket_traitement
                                  WHERE id = ?
                                  LIMIT 1";
$Parametres_Recuperation_Date = $Connexion->prepare($Recuperation_Date);
$Parametres_Recuperation_Date->execute(array(
    $ID_Message));
$Parametres_Recuperation_Date->setFetchMode(PDO::FETCH_OBJ);
$Donnees_Recuperation_Date = $Parametres_Recuperation_Date->fetch();
/* -------------------------------------------------------------------------- */

echo Formatage_Date_Vue($Donnees_Recuperation_Date->date_vue);
?>
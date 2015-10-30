<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include '../../configPDO.php'; ?>
<?php

$ID_Message = $_POST['id_message'];

/* ----------------------- Recuperation Date ------------------------------- */
$Verification_Proprietaire = "SELECT * FROM $BDD_Site.support_ticket_traitement
                                  WHERE id = ?
                                  AND id_emmeteur = ?
                                  LIMIT 1";
$Parametres_Verification_Proprietaire = $Connexion->prepare($Verification_Proprietaire);
$Parametres_Verification_Proprietaire->execute(array(
    $ID_Message,
    $_SESSION["ID"]));
$Parametres_Verification_Proprietaire->setFetchMode(PDO::FETCH_OBJ);
$Nombre_De_Resultat_Verification_Proprietaire = $Parametres_Verification_Proprietaire->rowCount();
/* -------------------------------------------------------------------------- */

if ($Nombre_De_Resultat_Verification_Proprietaire > 0) {
    /* ----------------------- Suppression du ticket en attente ------------------------------------ */
    $Requete_Suppression_Contenue_Site = "DELETE FROM $BDD_Site.support_ticket_traitement
                                             WHERE id = ?";
    $Preparation_Suppression_Contenue_Site = $Connexion->prepare($Requete_Suppression_Contenue_Site);
    $Preparation_Suppression_Contenue_Site->execute(array($ID_Message));
    /* --------------------------------------------------------------------------------------------- */
    
    echo $ID_Message;
    
} else {
    
    echo "NON";
}
?>
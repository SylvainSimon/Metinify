<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include '../../configPDO.php'; ?>
<?php

$Numero_Discussion = $_POST['Numero_Discussion'];

/* ----------------------- Recuperation Ligne ------------------------------- */
$Ligne_Ticket_Attente = "SELECT * FROM $BDD_Site.support_ticket_attente
                                  WHERE numero_discussion = ?
                                  LIMIT 1";
$Parametres_Ligne_Ticket_Attente = $Connexion->prepare($Ligne_Ticket_Attente);
$Parametres_Ligne_Ticket_Attente->execute(array(
    $Numero_Discussion));
$Parametres_Ligne_Ticket_Attente->setFetchMode(PDO::FETCH_OBJ);
$Nombre_De_Resultat_Ligne_Ticket_Attente = $Parametres_Ligne_Ticket_Attente->rowCount();
/* -------------------------------------------------------------------------- */

if ($Nombre_De_Resultat_Ligne_Ticket_Attente != 0) {

    $Donnees_Ligne_Ticket_Attente = $Parametres_Ligne_Ticket_Attente->fetch();

    /* ------------------------------------------------ Creation du ticket ---------------------------------------------------------------------- */
    $Insertion_Logs = "INSERT INTO $BDD_Site.support_ticket_traitement (id_emmeteur, id_recepteur, numero_discussion, objet_message, contenue_message, date, ip, etat) 
                          VALUES (:id_emmeteur, :id_recepteur, :numero_discussion, :objet_message, :contenue_message, :date, :ip, :etat)";

    $Paremetres_Insertion = $Connexion->prepare($Insertion_Logs);
    $Paremetres_Insertion->execute(array(
        ':id_emmeteur' => $Donnees_Ligne_Ticket_Attente->id_compte,
        ':id_recepteur' => $_SESSION["ID"],
        ':numero_discussion' => $Donnees_Ligne_Ticket_Attente->numero_discussion,
        ':objet_message' => $Donnees_Ligne_Ticket_Attente->objet_message,
        ':contenue_message' => $Donnees_Ligne_Ticket_Attente->contenue_message,
        ':date' => $Donnees_Ligne_Ticket_Attente->date,
        ':ip' => $Donnees_Ligne_Ticket_Attente->ip,
        ':etat' => "Non-Lu"));
    /* ----------------------------------------------------------------------------------------------------------------------------------- */

    $ID_Nouvelle_Ligne = $Connexion->lastInsertId();
    
    /* ----------------------- Suppression du ticket en attente ------------------------------------ */
    $Requete_Suppression_Contenue_Site = "DELETE FROM $BDD_Site.support_ticket_attente
                                              WHERE numero_discussion = ?";
    $Preparation_Suppression_Contenue_Site = $Connexion->prepare($Requete_Suppression_Contenue_Site);
    $Preparation_Suppression_Contenue_Site->execute(array($Numero_Discussion));
    /* --------------------------------------------------------------------------------------------- */
    
    echo $ID_Nouvelle_Ligne;
    
} else {

    echo "NULL";
}
?>
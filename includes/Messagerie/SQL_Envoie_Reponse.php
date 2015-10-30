<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include '../../configPDO.php'; ?>
<?php

$ID_Emmeteur = $_POST['ID_Emmeteur'];
$ID_Recepteur = $_POST['ID_Recepteur'];
$Num_Discussion = $_POST['Num_Discussion'];
$Objet_Message = $_POST['Objet_Message'];
$Type_message = $_POST['Type_message'];
$Contenue_message = $_POST['Contenue_message'];
$Ip = $_SERVER['REMOTE_ADDR'];

/* ------------------------------------------------ Creation du ticket ---------------------------------------------------------------------- */
$Insertion_Traitement = "INSERT INTO $BDD_Site.support_ticket_traitement (id_emmeteur, id_recepteur, numero_discussion, objet_message, contenue_message, date, ip, etat, type) 
                          VALUES (:id_emmeteur, :id_recepteur, :numero_discussion, :objet_message, :contenue_message, NOW(), :ip, :etat, :type)";

$Paremetres_Insertion = $Connexion->prepare($Insertion_Traitement);
$Paremetres_Insertion->execute(array(
    ':id_emmeteur' => $ID_Emmeteur,
    ':id_recepteur' => $ID_Recepteur,
    ':numero_discussion' => $Num_Discussion,
    ':objet_message' => $Objet_Message,
    ':contenue_message' => $Contenue_message,
    ':ip' => $Ip,
    ':etat' => "Non-Lu",
    ':type' => $Type_message));
/* ----------------------------------------------------------------------------------------------------------------------------------- */

echo $Connexion->lastInsertId();
?>
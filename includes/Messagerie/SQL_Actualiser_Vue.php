<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include '../../configPDO.php'; ?>

<?php

$etat = $_POST['etat'];

$id = explode("Message_", $_POST['id']);

/* ----------------- Update Email --------------------- */
$Update_Vue = "UPDATE $BDD_Site.support_ticket_traitement 
                SET etat = ?, date_vue = NOW()
                WHERE id = ?
                LIMIT 1";

$Parametres_Update_Vue = $Connexion->prepare($Update_Vue);
$Parametres_Update_Vue->execute(array(
    "Lu",
    $id[1]));
/* ----------------------------------------------------------- */

echo "1";

?>
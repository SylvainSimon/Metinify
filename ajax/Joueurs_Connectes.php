<?php

include '../configPDO.php';

/* ------------------------------ Vérification connecte ---------------------------------------------- */
$Comptage_Connectes = "SELECT id FROM player.player
                          WHERE player.last_play >= (NOW() - INTERVAL 90 MINUTE)";
$Parametres_Comptage_Connectes = $Connexion->prepare($Comptage_Connectes);
$Parametres_Comptage_Connectes->execute();
$Parametres_Comptage_Connectes->setFetchMode(PDO::FETCH_OBJ);
$Nombre_De_Resultat = $Parametres_Comptage_Connectes->rowCount();
/* -------------------------------------------------------------------------------------------------- */


echo $Nombre_De_Resultat;

?>

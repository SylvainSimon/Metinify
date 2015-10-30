<?php

include 'config.php';

set_time_limit("30000");
$monfichier = fopen('item_list.txt', 'r+');

while ($ligne = fgets($monfichier)) {

    $Decoupage_Ligne = explode(" ", $ligne);

    $Inserer_Ligne = mysql_query("INSERT player.item_list
                              SET item = '" . $Decoupage_Ligne[0] . "',
                                  chemin = '" . $Decoupage_Ligne[1] . "'");
    
}

fclose($monfichier);
?>
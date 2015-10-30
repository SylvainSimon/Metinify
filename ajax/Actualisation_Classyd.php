<?php

$port = '3306';
$ip = '94.23.6.155';

if (!$sock = @fsockopen($ip, $port, $num, $error, 1)) {
    echo '<img class="Ombre_Grise_2 Deplacement_Bouton_Status" title="Hors-Ligne" src="images/offline.gif" />';
} else {
    echo '<img class="Ombre_Grise_2 Deplacement_Bouton_Status" title="En Ligne" src="images/online.gif" />';

    fclose($sock);
}
?>
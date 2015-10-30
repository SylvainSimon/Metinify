<?php

$port = '3306';
$ip = '94.23.6.155';

if (!$sock = @fsockopen($ip, $port, $num, $error, 1)) {
    echo '<i class="text-red material-icons md-icon-public md-22" title="Hors-Ligne"></i>';
} else {
    echo '<i class="text-green material-icons md-icon-public md-22" title="En ligne"></i>';

    fclose($sock);
}
?>
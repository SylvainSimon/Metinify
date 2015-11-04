<?php

namespace Ajax;

require __DIR__ . '../../core/initialize.php';

class ajaxStatutServeur extends \ScriptHelper {

    public function run() {
        $port = '3306';
        $ip = '94.23.6.155';

        if (!$sock = @fsockopen($ip, $port, $num, $error, 1)) {
            echo '<i class="text-red material-icons md-icon-public md-22" data-tooltip="Hors-Ligne" data-tooltip-position="left"></i>';
        } else {
            echo '<i class="text-green material-icons md-icon-public md-22" data-tooltip="En ligne" data-tooltip-position="left"></i>';

            fclose($sock);
        }
    }

}

$class = new ajaxStatutServeur();
$class->run();

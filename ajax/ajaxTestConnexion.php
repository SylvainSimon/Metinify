<?php

namespace Ajax;

require __DIR__ . '../../core/initialize.php';

class ajaxTestConnexion extends \ScriptHelper {

    public function run() {
        if (empty($_SESSION['ID'])) {
            echo '0';
        } else {
            echo '1';
        }
    }

}

$class = new ajaxTestConnexion();
$class->run();

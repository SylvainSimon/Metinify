<?php

namespace Ajax;

require __DIR__ . '../../core/initialize.php';

class ajaxTestConnexion extends \ScriptHelper {

    public function run() {
        if ($this->isConnected) {
            echo '1';
        } else {
            echo '0';
        }
    }

}

$class = new ajaxTestConnexion();
$class->run();

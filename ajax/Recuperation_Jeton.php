<?php

namespace Ajax;

require __DIR__ . '../../core/initialize.php';

class Recuperation_Jeton extends \ScriptHelper {

    public function run() {
        if (empty($_SESSION['ID'])) {
            
        } else {
            echo $_SESSION["Administration_PannelAdmin_Jeton"];
        }
    }

}

$class = new Recuperation_Jeton();
$class->run();

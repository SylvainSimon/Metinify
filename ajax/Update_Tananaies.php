<?php

namespace Ajax;

require __DIR__ . '../../core/initialize.php';

class Update_Tananaies extends \ScriptHelper {

    public function run() {
        echo $_SESSION['TanaNaies'];
    }

}

$class = new Update_Tananaies();
$class->run();

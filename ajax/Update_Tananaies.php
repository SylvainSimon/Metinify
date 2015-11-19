<?php

namespace Ajax;

require __DIR__ . '../../core/initialize.php';

class Update_Tananaies extends \ScriptHelper {

    public function run() {
        global $session;
        echo $session->get("TanaNaies");
    }

}

$class = new Update_Tananaies();
$class->run();

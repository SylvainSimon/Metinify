<?php

namespace Ajax;

require __DIR__ . '../../../core/initialize.php';

class Update_Mileage extends \ScriptHelper {

    public function run() {
        global $session;
        echo $session->get("Mileage");
    }

}

$class = new Update_Mileage();
$class->run();

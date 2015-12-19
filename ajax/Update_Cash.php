<?php

namespace Ajax;

require __DIR__ . '../../core/initialize.php';

class Update_Cash extends \ScriptHelper {

    public function run() {
        
        global $session;
        echo $session->get("Cash");
    }

}

$class = new Update_Cash();
$class->run();

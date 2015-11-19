<?php

namespace Ajax;

require __DIR__ . '../../core/initialize.php';

class Update_Vamonaies extends \ScriptHelper {

    public function run() {
        
        global $session;
        echo $session->get("VamoNaies");
    }

}

$class = new Update_Vamonaies();
$class->run();

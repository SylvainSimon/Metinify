<?php

namespace Ajax;

require __DIR__ . '../../core/initialize.php';

class Update_Vamonaies extends \PageHelper {

    public function run() {
        echo $_SESSION['VamoNaies'];
    }

}

$class = new Update_Vamonaies();
$class->run();

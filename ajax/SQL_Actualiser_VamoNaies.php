<?php

namespace Ajax;

require __DIR__ . '../../core/initialize.php';

class SQL_Actualiser_VamoNaies extends \ScriptHelper {

    public function run() {

        if (empty($_SESSION['ID'])) {
            
        } else {
            echo $_SESSION["VamoNaies"];
        }
?>
        <?php
    }
}

$class = new SQL_Actualiser_VamoNaies();
$class->run();

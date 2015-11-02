<?php

namespace Ajax;

require __DIR__ . '../../core/initialize.php';

class Test_Connexion extends \PageHelper {

    public function run() {
        if (empty($_SESSION['ID'])) {
            echo '0';
        } else {
            echo '1';
        }
    }

}

$class = new Test_Connexion();
$class->run();

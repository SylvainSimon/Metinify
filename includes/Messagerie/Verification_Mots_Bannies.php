<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class Verification_Mots_Bannies extends \PageHelper {

    public function run() {
        echo str_ireplace($_SESSION['Tableau_Mots_Bannis'], "/* Expression interdite */", $_POST['Message_Texte']);
    }

}

$class = new Verification_Mots_Bannies();
$class->run();

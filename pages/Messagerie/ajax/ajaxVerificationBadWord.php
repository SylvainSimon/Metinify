<?php

namespace Pages\Messagerie\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxVerificationBadWord extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;
    
    public function run() {
        echo str_ireplace($_SESSION['Tableau_Mots_Bannis'], "/* Expression interdite */", $_POST['Message_Texte']);
    }

}

$class = new ajaxVerificationBadWord();
$class->run();

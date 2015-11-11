<?php

namespace Pages\Messagerie\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxVerificationBadWord extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;
    
    public function run() {
        
        global $session;
        global $request;
        
        echo str_ireplace($session->get("Tableau_Mots_Bannis"), "/* Expression interdite */", $request->request->get("Message_Texte"));
    }

}

$class = new ajaxVerificationBadWord();
$class->run();

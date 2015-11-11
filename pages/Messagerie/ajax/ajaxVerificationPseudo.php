<?php

namespace Pages\Messagerie\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxVerificationPseudo extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;
    
    public function run() {

        global $request;
        
        $pseudoMessagerie = $request->query->get("pseudo");
        $nombreIdentique = \Account\AccountHelper::getAccountRepository()->countByPseudoMessagerie($pseudoMessagerie);

        if ($nombreIdentique > 0) {
            echo "1";
        } else {
            echo "2";
        }
    }

}

$class = new ajaxVerificationPseudo();
$class->run();

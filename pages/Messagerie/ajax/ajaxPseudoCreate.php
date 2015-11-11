<?php

namespace Pages\Messagerie\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxPseudoCreate extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;
    
    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();
        
        $pseudoMessagerie = $request->request->get("Pseudo");
        
        $this->objAccount->setPseudoMessagerie($pseudoMessagerie);
        $em->persist($this->objAccount);
        $em->flush();

        echo "1";
    }

}

$class = new ajaxPseudoCreate();
$class->run();

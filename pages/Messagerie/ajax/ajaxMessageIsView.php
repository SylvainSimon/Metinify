<?php

namespace Pages\Messagerie\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxMessageIsView extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;
    
    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();
        
        $fullIdMessage = $request->request->get("idMessage");
        $idMessage = explode("_", $fullIdMessage);

        $objSupportMessage = \Site\SiteHelper::getSupportMessagesRepository()->find($idMessage[1]);
        
        if($objSupportMessage !== null){
            
            $objSupportMessage->setEtat(\Site\SupportEtatMessageHelper::LU);
            $em->persist($objSupportMessage);
            $em->flush();
        }
        
        echo "1";
    }

}

$class = new ajaxMessageIsView();
$class->run();

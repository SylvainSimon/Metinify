<?php

namespace Pages\Messagerie\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxDiscussionCreate extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;
    
    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $idObjet = $request->request->get("discussionObjet");
        $message = $request->request->get("discussionMessage");
        
        $objSupportDiscussion = new \Site\Entity\SupportDiscussions();
        $objSupportDiscussion->setIdCompte($this->objAccount->getId());
        $objSupportDiscussion->setIdObjet($idObjet);
        $objSupportDiscussion->setMessage($message);
        $objSupportDiscussion->setDate(new \DateTime(date("Y-m-d H:i:s")));
        $objSupportDiscussion->setDateDernierMessage(new \DateTime(date("Y-m-d H:i:s")));
        $objSupportDiscussion->setIp($this->ipAdresse);
        
        $em->persist($objSupportDiscussion);
        $em->flush();
        
        echo json_encode(["result" => 1]);
    }

}

$class = new ajaxDiscussionCreate();
$class->run();

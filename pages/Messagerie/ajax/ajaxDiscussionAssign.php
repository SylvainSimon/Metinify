<?php

namespace Pages\Messagerie\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxDiscussionAssign extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::SUPPORT_TICKET);
    }
    
    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $idDiscussion = $request->request->get("Numero_Discussion");
        $objSupportDiscussion = \Site\SiteHelper::getSupportDiscussionsRepository()->find($idDiscussion);

        if ($objSupportDiscussion !== null) {

            $objSupportDiscussion->setIdAdmin($this->objAccount->getId());
            $em->persist($objSupportDiscussion);
            $em->flush();
            echo \Encryption::encrypt($objSupportDiscussion->getId());
        } else {
            echo "NULL";
        }
    }

}

$class = new ajaxDiscussionAssign();
$class->run();

<?php

namespace Pages\Messagerie\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxDiscussionTransfert extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::SUPPORT_TICKET);
    }

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $idDiscussion = $request->request->get("idDiscussion");
        $idAccount = $request->request->get("idAccount");

        $objSupportDiscussion = \Site\SiteHelper::getSupportDiscussionsRepository()->find($idDiscussion);
        $objAccount = \Account\AccountHelper::getAccountRepository()->find($idAccount);

        if ($objSupportDiscussion !== null and $objAccount !== null) {

            $objSupportMessage = new \Site\Entity\SupportMessages();
            $objSupportMessage->setDate(new \DateTime(date("Y-m-d H:i:s")));
            $objSupportMessage->setDatechangementEtat(new \DateTime(date("Y-m-d H:i:s")));
            $objSupportMessage->setEtat(\SupportEtatMessageHelper::LU);
            $objSupportMessage->setIdCompte(0);
            $objSupportMessage->setIdDiscussion($objSupportDiscussion->getId());
            $objSupportMessage->setIp($this->ipAdresse);
            $objSupportMessage->setMessage("" . $this->objAccount->getPseudoMessagerie() . " à transféré le ticket à " . $objAccount->getPseudoMessagerie() . ".");

            $objSupportDiscussion->setIdAdmin($objAccount->getId());
            $em->persist($objSupportMessage);
            $em->persist($objSupportDiscussion);
            $em->flush();
        }

        echo json_encode(["result" => 1]);
    }

}

$class = new ajaxDiscussionTransfert();
$class->run();

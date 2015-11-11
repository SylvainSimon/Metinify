<?php

namespace Pages\Messagerie\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxMessageAdd extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $idCompte = $request->request->get("idCompte");
        $idDiscussion = $request->request->get("idDiscussion");
        $message = $request->request->get("message");

        $objSupportMessage = new \Site\Entity\SupportMessages();
        $objSupportMessage->setIdCompte($idCompte);
        $objSupportMessage->setIdDiscussion($idDiscussion);
        $objSupportMessage->setMessage($message);
        $objSupportMessage->setDate(new \DateTime(date("Y-m-d H:i:s")));
        $objSupportMessage->setEtat(\Site\SupportEtatMessageHelper::NON_LU);
        $objSupportMessage->setDatechangementEtat(new \DateTime(date("Y-m-d H:i:s")));
        $objSupportMessage->setIp($this->ipAdresse);

        $em->persist($objSupportMessage);
        $em->flush();

        echo json_encode([
            "id" => $objSupportMessage->getId(),
            "date" => \DateTimeHelper::dateTimeToFormatedString($objSupportMessage->getDate()),
            "message" => nl2br($objSupportMessage->getMessage())
        ]);
    }

}

$class = new ajaxMessageAdd();
$class->run();

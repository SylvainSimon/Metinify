<?php

namespace Pages\MonCompte\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxEmailChangeExecute extends \ScriptHelper {

    public $isProtected = true;

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();
        
        $AccountLogin = $this->objAccount->getLogin();
        $AccountEmailOld = $this->objAccount->getEmail();
        $AccountId = $this->objAccount->getId();
        $AccountEmailNew = $request->request->get("emailapres");
        $IP = $request->server->get("REMOTE_ADDR");

        //Application de la modification
        $this->objAccount->setEmail($AccountEmailNew);
        $em->persist($this->objAccount);
        
        //Suppression de l'entrée de vérification
        \Site\SiteHelper::getControleChangementMailRepository()->deleteByAccountId($AccountId);

        //On insère dans les logs
        $objLogsChangementMail = new \Site\Entity\LogsChangementMail();
        $objLogsChangementMail->setIdCompte($AccountId);
        $objLogsChangementMail->setOld($AccountEmailOld);
        $objLogsChangementMail->setNew($AccountEmailNew);
        $objLogsChangementMail->setIp($IP);
        $objLogsChangementMail->setDate(new \DateTime(date("Y-m-d H:i:s")));
        $em->persist($objLogsChangementMail);

        $em->flush();
        
        //Envoi sur l'ancienne adresse
        $templateOld = $this->objTwig->loadTemplate("EmailChangeEmailOld.html5.twig");
        $resultOld = $templateOld->render(["compte" => $AccountLogin]);
        $subject = 'VamosMt2 - Changement de mail de ' . $AccountLogin . '';
        \EmailHelper::sendEmail($AccountEmailOld, $subject, $resultOld);

        //Envoi sur la nouvelle adresse
        $templateNew = $this->objTwig->loadTemplate("EmailChangeEmailNew.html5.twig");
        $resultNew = $templateNew->render(["compte" => $AccountLogin, "new" => $AccountEmailNew, "old" => $AccountEmailOld]);
        $subject = 'VamosMt2 - Changement de mail de ' . $AccountLogin . '';
        \EmailHelper::sendEmail($AccountEmailNew, $subject, $resultNew);

        echo '1';
    }

}

$class = new ajaxEmailChangeExecute();
$class->run();

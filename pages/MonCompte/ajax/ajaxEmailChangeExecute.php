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
        $em->flush();
        
        //Suppression de l'entrée de vérification
        \Site\SiteHelper::getChangementMailRepository()->deleteByAccountId($AccountId);

        //On insère dans les logs
        $objLogChangementEmail = new \Site\Entity\LogsChangementMail();
        $objLogChangementEmail->setIdCompte($AccountId);
        $objLogChangementEmail->setCompte($AccountLogin);
        $objLogChangementEmail->setAncienMail($AccountEmailOld);
        $objLogChangementEmail->setNouveauMail($AccountEmailNew);
        $objLogChangementEmail->setIp($IP);
        $objLogChangementEmail->setDate(date("Y-m-d H:i:s"));
        $em->persist($objLogChangementEmail);

        //Envoi sur l'ancienne adresse
        $templateOld = $this->objTwig->loadTemplate("EmailChangeEmailOld.html5.twig");
        $resultOld = $templateOld->render(["compte" => $AccountLogin]);
        $subject = 'VamosMt2 - Changement de mail de ' . $AccountLogin . '';
        \EmailHelper::sendEmail($AccountEmailNew, $subject, $resultOld);

        //Envoi sur la nouvelle adresse
        $templateNew = $this->objTwig->loadTemplate("EmailChangeEmailNew.html5.twig");
        $resultNew = $templateNew->render(["compte" => $AccountLogin, "new" => $AccountEmailNew, "old" => $AccountEmailOld]);
        $subject = 'VamosMt2 - Changement de mail de ' . $AccountLogin . '';
        \EmailHelper::sendEmail($AccountEmailOld, $subject, $resultNew);

        echo '1';
    }

}

$class = new ajaxEmailChangeExecute();
$class->run();

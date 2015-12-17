<?php

namespace Pages\MonCompte\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxCodeEffacementCreateExecute extends \ScriptHelper {

    public $isProtected = true;

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $codeEffacementNew = $request->request->get("Code_Effacement");

        $this->objAccount->setCodeEffacement($codeEffacementNew);
        $em->persist($this->objAccount);

        $objLogsDefinitionCodeSurete = new \Site\Entity\LogsDefinitionCodeSurete();
        $objLogsDefinitionCodeSurete->setIdCompte($this->objAccount->getId());
        $objLogsDefinitionCodeSurete->setDate(new \DateTime(date("Y-m-d H:i:s")));
        $objLogsDefinitionCodeSurete->setIp($this->ipAdresse);
        $em->persist($objLogsDefinitionCodeSurete);

        $em->flush();

        echo '1';
    }

}

$class = new ajaxCodeEffacementCreateExecute();
$class->run();

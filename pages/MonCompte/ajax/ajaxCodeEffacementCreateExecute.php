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

        $objLogsCodeEffacementDefinition = new \Site\Entity\LogsCodeEffacementDefinition();
        $objLogsCodeEffacementDefinition->setIdCompte($this->objAccount->getId());
        $objLogsCodeEffacementDefinition->setCompte($this->objAccount->getLogin());
        $objLogsCodeEffacementDefinition->setCode($codeEffacementNew);
        $objLogsCodeEffacementDefinition->setDate(new \DateTime(date("Y-m-d H:i:s")));
        $objLogsCodeEffacementDefinition->setIp($this->ipAdresse);

        $em->persist($objLogsCodeEffacementDefinition);

        $em->flush();

        echo '1';
    }

}

$class = new ajaxCodeEffacementCreateExecute();
$class->run();

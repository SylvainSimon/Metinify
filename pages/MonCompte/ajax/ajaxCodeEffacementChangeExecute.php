<?php

namespace Pages\MonCompte\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxCodeEffacementChangeExecute extends \ScriptHelper {

    public $isProtected = true;

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $CodeEffacementOld = $request->request->get("Code_Avant");
        $CodeEffacementNew = $request->request->get("Code_Effacement");

        if ($this->objAccount->getCodeEffacement() == $CodeEffacementOld) {

            $this->objAccount->setCodeEffacement($CodeEffacementNew);
            $em->persist($this->objAccount);

            $objLogsChangementCodeSurete = new \Site\Entity\LogsChangementCodeSurete();
            $objLogsChangementCodeSurete->setIdCompte($this->objAccount->getId());
            $objLogsChangementCodeSurete->setEmail($this->objAccount->getEmail());
            $objLogsChangementCodeSurete->setDate(new \DateTime(date("Y-m-d H:i:s")));
            $objLogsChangementCodeSurete->setIp($this->ipAdresse);
            $em->persist($objLogsChangementCodeSurete);

            $em->flush();

            echo '1';
        } else {
            echo '2';
        }
    }

}

$class = new ajaxCodeEffacementChangeExecute();
$class->run();

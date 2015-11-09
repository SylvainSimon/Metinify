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

            $objLogsCodeEffacementChangement = new \Site\Entity\LogsCodeEffacementChangement();
            $objLogsCodeEffacementChangement->setIdCompte($this->objAccount->getId());
            $objLogsCodeEffacementChangement->setCompte($this->objAccount->getLogin());
            $objLogsCodeEffacementChangement->setAncienCode($CodeEffacementOld);
            $objLogsCodeEffacementChangement->setNouveauCode($CodeEffacementNew);
            $objLogsCodeEffacementChangement->setDate(new \DateTime(date("Y-m-d H:i:s")));
            $objLogsCodeEffacementChangement->setIp($this->ipAdresse);
            $em->persist($objLogsCodeEffacementChangement);

            $em->flush();

            echo '1';
        } else {
            echo '2';
        }
    }

}

$class = new ajaxCodeEffacementChangeExecute();
$class->run();

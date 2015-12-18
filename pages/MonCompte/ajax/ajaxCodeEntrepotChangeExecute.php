<?php

namespace Pages\MonCompte\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxCodeEntrepotChangeExecute extends \ScriptHelper {

    public $isProtected = true;

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $passwordSafeboxOld = $request->request->get("Code_Avant");
        $passwordSafeboxNew = $request->request->get("Code_Entrepot");

        //On recherche l'entrepot du compte
        $objSafebox = \Player\PlayerHelper::getSafeboxRepository()->findByIdCompte($this->objAccount->getId());

        if ($objSafebox !== null) {

            $objSafebox->setPassword($passwordSafeboxNew);
            $em->persist($objSafebox);

            $objLogsChangementCodeEntrepot = new \Site\Entity\LogsChangementCodeEntrepot();
            $objLogsChangementCodeEntrepot->setIdCompte($this->objAccount->getId());
            $objLogsChangementCodeEntrepot->setDate(new \DateTime(date("Y-m-d H:i:s")));
            $objLogsChangementCodeEntrepot->setIp($this->ipAdresse);
            $em->persist($objLogsChangementCodeEntrepot);

            $em->flush();

            echo '1';
        } else {
            echo '2';
        }
    }

}

$class = new ajaxCodeEntrepotChangeExecute();
$class->run();

<?php

namespace Pages\MonPersonnage\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxRepaireYang extends \ScriptHelper {

    public $isProtected = true;

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();
        $idPlayer = $request->request->get("id_perso");

        $objPlayer = \Player\PlayerHelper::getPlayerRepository()->findPlayerByIdPlayerAndIdAccount($idPlayer, $this->objAccount->getId());

        if ($objPlayer !== null) {

            if ($objPlayer->getGold() < 0) {

                $yangsOld = $objPlayer->getGold();

                $objPlayer->setGold("1500000000");
                $em->persist($objPlayer);

                $objLogsDeblocageYangs = new \Site\Entity\LogsDeblocageYangs();
                $objLogsDeblocageYangs->setIdPerso($idPlayer);
                $objLogsDeblocageYangs->setIdCompte($this->objAccount->getId());
                $objLogsDeblocageYangs->setDate(new \DateTime(date("Y-m-d H:i:s")));
                $objLogsDeblocageYangs->setIp($this->ipAdresse);
                $objLogsDeblocageYangs->setLogYangs($yangsOld);
                $em->persist($objLogsDeblocageYangs);
                
                $em->flush();
                
            } else {
                echo "YANGS";
            }
        } else {
            echo "NOT_YOU";
        }
    }

}

$class = new ajaxRepaireYang();
$class->run();

<?php

namespace Pages\MonPersonnage\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxRepairePosition extends \ScriptHelper {

    public $isProtected = true;

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $idPlayer = $request->request->get("id_perso");
        $objPlayer = \Player\PlayerHelper::getPlayerRepository()->findPlayerByIdPlayerAndIdAccount($idPlayer, $this->objAccount->getId());
        $objPlayerIndex = \Player\PlayerHelper::getPlayerIndexRepository()->find($this->objAccount->getId());

        if ($objPlayer !== null) {

            if ($objPlayerIndex !== null) {

                if ($objPlayerIndex->getEmpire() == "1") {
                    $x = "488774";
                    $y = "955480";
                    $map = "1";
                } elseif ($objPlayerIndex->getEmpire() == "2") {
                    $x = "64305";
                    $y = "186753";
                    $map = "21";
                } elseif ($objPlayerIndex->getEmpire() == "3") {
                    $x = "963684";
                    $y = "285235";
                    $map = "41";
                }

                $objPlayer->setMapIndex($map);
                $objPlayer->setX($x);
                $objPlayer->setY($y);
                $objPlayer->setExitMapIndex($map);
                $objPlayer->setExitX($x);
                $objPlayer->setExitY($y);
                $em->persist($objPlayer);
                
                $objLogDeblocagePerso = new \Site\Entity\LogsDeblocagePersos();
                $objLogDeblocagePerso->setIdPerso($objPlayer->getId());
                $objLogDeblocagePerso->setIdCompte($this->objAccount->getId());
                $objLogDeblocagePerso->setMapIndex($map);
                $objLogDeblocagePerso->setDate(new \DateTime(date("Y-m-d H:i:s")));
                $objLogDeblocagePerso->setIp($this->ipAdresse);
                $em->persist($objLogDeblocagePerso);
                
                $em->flush();

            } else {
                echo "NOT_EMPIRE";
            }
        } else {
            echo "NOT_YOU";
        }
    }

}

$class = new ajaxRepairePosition();
$class->run();

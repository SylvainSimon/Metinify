<?php

namespace Pages\MonPersonnage\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxRepairePosition extends \ScriptHelper {

    public $isProtected = true;
    public $objPlayer;

    public function __construct() {
        parent::__construct();
        global $request;
        $this->objPlayer = parent::VerifMonJoueur(\Encryption::decrypt($request->request->get("idPlayer")));
    }

    public function run() {

        $em = \Shared\DoctrineHelper::getEntityManager();
        $objPlayerIndex = \Player\PlayerHelper::getPlayerIndexRepository()->find($this->objAccount->getId());

        if ($objPlayerIndex !== null) {

            if ($objPlayerIndex->getEmpire() == \EmpireHelper::ROUGE) {
                $x = 488774;
                $y = 955480;
                $map = 1;
            } elseif ($objPlayerIndex->getEmpire() == \EmpireHelper::JAUNE) {
                $x = 64305;
                $y = 186753;
                $map = 21;
            } elseif ($objPlayerIndex->getEmpire() == \EmpireHelper::BLEU) {
                $x = 963684;
                $y = 285235;
                $map = 41;
            }

            $this->objPlayer->setMapIndex($map);
            $this->objPlayer->setX($x);
            $this->objPlayer->setY($y);
            $this->objPlayer->setExitMapIndex($map);
            $this->objPlayer->setExitX($x);
            $this->objPlayer->setExitY($y);
            
            $em->persist($this->objPlayer);
            
            $objLogDeblocagePerso = new \Site\Entity\LogsDeblocagePersos();
            $objLogDeblocagePerso->setIdPerso($this->objPlayer->getId());
            $objLogDeblocagePerso->setIdCompte($this->objAccount->getId());
            $objLogDeblocagePerso->setMapIndex($map);
            $objLogDeblocagePerso->setDate(new \DateTime(date("Y-m-d H:i:s")));
            $objLogDeblocagePerso->setIp($this->ipAdresse);
            $em->persist($objLogDeblocagePerso);

            $em->flush();
        }
    }

}

$class = new ajaxRepairePosition();
$class->run();

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
                $x = \EmpireHelper::ROUGE_DEFAULT_X;
                $y = \EmpireHelper::ROUGE_DEFAULT_Y;
                $map = \MapHelper::MAP_1_ROUGE;
            } elseif ($objPlayerIndex->getEmpire() == \EmpireHelper::JAUNE) {
                $x = \EmpireHelper::JAUNE_DEFAULT_X;
                $y = \EmpireHelper::JAUNE_DEFAULT_Y;
                $map = \MapHelper::MAP_1_JAUNE;
            } elseif ($objPlayerIndex->getEmpire() == \EmpireHelper::BLEU) {
                $x = \EmpireHelper::BLEU_DEFAULT_X;
                $y = \EmpireHelper::BLEU_DEFAULT_Y;
                $map = \MapHelper::MAP_1_BLEU;
            }

            $oldMapIndex = $this->objPlayer->getMapIndex();
            $oldX = $this->objPlayer->getX();
            $oldY = $this->objPlayer->getY();

            $this->objPlayer->setMapIndex($map);
            $this->objPlayer->setX($x);
            $this->objPlayer->setY($y);
            $this->objPlayer->setExitMapIndex($map);
            $this->objPlayer->setExitX($x);
            $this->objPlayer->setExitY($y);

            $em->persist($this->objPlayer);

            $objLogsRepairPosition = new \Site\Entity\LogsRepairPosition();
            $objLogsRepairPosition->setIdPlayer($this->objPlayer->getId());
            $objLogsRepairPosition->setNamePlayer($this->objPlayer->getName());
            $objLogsRepairPosition->setIdCompte($this->objAccount->getId());

            $objLogsRepairPosition->setOldMapIndex($oldMapIndex);
            $objLogsRepairPosition->setOldX($oldX);
            $objLogsRepairPosition->setOldY($oldY);

            $objLogsRepairPosition->setNewMapIndex($this->objPlayer->getMapIndex());
            $objLogsRepairPosition->setNewX($this->objPlayer->getX());
            $objLogsRepairPosition->setNewY($this->objPlayer->getY());

            $objLogsRepairPosition->setDate(new \DateTime(date("Y-m-d H:i:s")));
            $objLogsRepairPosition->setIp($this->ipAdresse);
            $em->persist($objLogsRepairPosition);

            $em->flush();
        }
    }

}

$class = new ajaxRepairePosition();
$class->run();

<?php

namespace Administration;

require __DIR__ . '../../../../../../core/initialize.php';

class ajaxGererEquipeJeuEditSave extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::GERER_EQUIPE_JEU);
    }

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $gmListMid = $request->request->get("GmListMid");
        $playerId = $request->request->get("playerId");
        $playerIp = $request->request->get("playerIp");
        $authority = $request->request->get("authority");

        $objPlayer = \Player\PlayerHelper::getPlayerRepository()->find($playerId);
        $objAccount = \Account\AccountHelper::getAccountRepository()->find($objPlayer->getIdAccount());

        if ($gmListMid > 0) {
            $objGmListMid = \Common\CommonHelper::getGmlistRepository()->find($gmListMid);
        } else {
            $objGmListMid = new \Common\Entity\Gmlist();
            $objGmListMid->setMserverip("ALL");
        }

        $objGmListMid->setMaccount($objAccount->getLogin());
        $objGmListMid->setMname($objPlayer->getName());
        $objGmListMid->setMauthority($authority);
        $objGmListMid->setMcontactip($playerIp);

        $em->persist($objGmListMid);
        $em->flush();

        $result = array(
            'result' => true,
            'reasons' => ""
        );

        echo json_encode($result);
    }

}

$class = new ajaxGererEquipeJeuEditSave();
$class->run();

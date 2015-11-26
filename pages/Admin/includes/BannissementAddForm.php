<?php

namespace Administration;

require __DIR__ . '../../../../core/initialize.php';

class BannissementAddForm extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    public $strTemplate = "BannissementAddForm.html5.twig";

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::BANNISSEMENT);
    }

    public function run() {

        global $request;
        $idAccount = $request->query->get("idAccount");

        $objAccount = \Account\AccountHelper::getAccountRepository()->find($idAccount);
        $arrObjPlayers = \Player\PlayerHelper::getPlayerRepository()->findPlayers($objAccount->getId());

        $this->arrayTemplate["arrBannissementMotifs"] = \BanRaisonHelper::getAll();
        $this->arrayTemplate["arrBannissementDuree"] = \BanDureeHelper::getAll(false);
        $this->arrayTemplate["iconCash"] = \FonctionsUtiles::findIconDevise(1);
        $this->arrayTemplate["iconMileage"] = \FonctionsUtiles::findIconDevise(2);
        $this->arrayTemplate["rightBannissementEmail"] = $this->HaveTheRight(\DroitsHelper::BANNISSEMENT_IP);
        $this->arrayTemplate["rightBannissementIp"] = $this->HaveTheRight(\DroitsHelper::BANNISSEMENT_EMAIL);
        $this->arrayTemplate["arrObjPlayers"] = $arrObjPlayers;
        $this->arrayTemplate["objAccount"] = $objAccount;

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new BannissementAddForm();
$class->run();

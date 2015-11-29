<?php

namespace Administration;

require __DIR__ . '../../../core/initialize.php';

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

        $this->arrayTemplate["arrBannissementMotifs"] = \BanRaisonHelper::getAll(false);
        $this->arrayTemplate["arrBannissementDuree"] = \BanDureeHelper::getAll(false);
        $this->arrayTemplate["rightBannissementEmail"] = $this->HaveTheRight(\DroitsHelper::BANNISSEMENT_IP);
        $this->arrayTemplate["rightBannissementIp"] = $this->HaveTheRight(\DroitsHelper::BANNISSEMENT_EMAIL);
        $this->arrayTemplate["objAccount"] = $objAccount;

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new BannissementAddForm();
$class->run();

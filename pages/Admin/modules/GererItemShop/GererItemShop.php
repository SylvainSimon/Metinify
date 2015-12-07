<?php

namespace Administration;

require __DIR__ . '../../../../../core/initialize.php';

class GererItemShop extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    public $strTemplate = "GererItemShop.html5.twig";

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::GERER_ITEMSHOP);
    }

    public function run() {

        $this->arrayTemplate["rightGererITemShopCategorie"] = $this->HaveTheRight(\DroitsHelper::GERER_ITEMSHOP_CATEGORIE);
        $this->arrayTemplate["rightGererITemShopStatistiques"] = $this->HaveTheRight(\DroitsHelper::GERER_ITEMSHOP_STATISTIQUE);
        
        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new GererItemShop();
$class->run();

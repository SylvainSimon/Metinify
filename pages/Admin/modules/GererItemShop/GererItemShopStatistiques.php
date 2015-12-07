<?php

namespace Administration;

require __DIR__ . '../../../../../core/initialize.php';

class GererItemShopStatistiques extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    public $strTemplate = "GererItemShopStatistiques.html5.twig";

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::GERER_ITEMSHOP_STATISTIQUE);
    }

    public function run() {

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new GererItemShopStatistiques();
$class->run();

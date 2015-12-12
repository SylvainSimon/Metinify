<?php

namespace Administration;

require __DIR__ . '../../../../../core/initialize.php';

class Parametres extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    public $strTemplate = "ParametresPersonnalisation.html5.twig";

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::PARAMETRES);
    }

    public function run() {
        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new Parametres();
$class->run();

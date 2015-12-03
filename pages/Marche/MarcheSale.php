<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class MarcheSell extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "MarcheSale.html5.twig";

    public function __construct() {
        parent::__construct();
        global $config;
        parent::moduleIsActivated($config->marche["activate"]);
    }
    
    public function run() {

        $arrObjPlayers = \Player\PlayerHelper::getPlayerRepository()->findPlayers($this->objAccount->getId());

        $this->arrayTemplate["arrObjPlayers"] = $arrObjPlayers;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new MarcheSell();
$class->run();

<?php

namespace Pages;

require __DIR__ . '../../../core/initialize.php';

class Pilori extends \PageHelper {

    public $strTemplate = "Pilori.html5.twig";

    public function run() {

        $arrObjPlayers = \Player\PlayerHelper::getPlayerRepository()->findPlayersBannis();

        $this->arrayTemplate["arrObjPlayers"] = $arrObjPlayers;
        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new Pilori();
$class->run();

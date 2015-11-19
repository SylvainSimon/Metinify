<?php

namespace Pages\MonPersonnage;

require __DIR__ . '../../../core/initialize.php';

class MonPersonnageAmis extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "MonPersonnageAmis.html5.twig";

    public function run() {

        global $request;
        $idPlayer = $request->query->get("id");
        $objPlayer = \Player\PlayerHelper::getPlayerRepository()->find($idPlayer);
        $arrObjMessengerList = \Player\PlayerHelper::getMessengerListRepository()->findByPlayerName($objPlayer->getName());

        $this->arrayTemplate["objPlayer"] = $objPlayer;
        $this->arrayTemplate["arrObjMessengerList"] = $arrObjMessengerList;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new MonPersonnageAmis();
$class->run();

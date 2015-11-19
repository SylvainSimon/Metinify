<?php

namespace Pages\MonPersonnage;

require __DIR__ . '../../../core/initialize.php';

class MonPersonnageEquitation extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "MonPersonnageEquitation.html5.twig";

    public function run() {

        global $request;
        $idPlayer = $request->query->get("id");
        $objPlayer = \Player\PlayerHelper::getPlayerRepository()->find($idPlayer);
        $haveGuild = \Player\PlayerHelper::haveGuild($objPlayer->getId());

        $this->arrayTemplate["objPlayer"] = $objPlayer;
        $this->arrayTemplate["haveGuild"] = $haveGuild;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new MonPersonnageEquitation();
$class->run();

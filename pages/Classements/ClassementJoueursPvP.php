<?php

namespace Pages\Classements;

require __DIR__ . '../../../core/initialize.php';

class ClassementJoueursPvP extends \PageHelper {

    public $strTemplate = "ClassementJoueursPvP.html5.twig";
    
    public function run() {

        $numPage = 0;
        $i = $numPage + 1;
        
        $arrObjPlayers = \Player\PlayerHelper::getPlayerRepository()->findClassement("PVP", 0, 10);
        $totalObjPlayers = \Player\PlayerHelper::getPlayerRepository()->countPlayerClassement();
        
        $totalPage = (($totalObjPlayers / 10) - 1);

        $this->arrayTemplate["arrObjPlayers"] = $arrObjPlayers;
        $this->arrayTemplate["totalObjPlayers"] = $totalObjPlayers;
        $this->arrayTemplate["totalPage"] = $totalPage;
        $this->arrayTemplate["numPage"] = $numPage;
        $this->arrayTemplate["place"] = $i;

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new ClassementJoueursPvP();
$class->run();

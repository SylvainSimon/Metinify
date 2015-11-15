<?php

namespace Pages\Classements\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ClassementJoueursPvESearch extends \PageHelper {

    public $strTemplate = "ClassementJoueursPvESearch.html5.twig";

    public function run() {

        global $request;

        $index = 0;
        $playerName = $request->request->get("recherche");

        $arrObjPlayersSearch = \Player\PlayerHelper::getPlayerRepository()->findClassement("PVE", 0, 0, true);

        foreach ($arrObjPlayersSearch AS $objPlayersSearch) {
            $index++;
            if ($objPlayersSearch["name"] == $playerName) {
                break;
            }
        }

        if (count($arrObjPlayersSearch) != $index) {

            $intervalStartSearch = ($index - 5);
            if ($intervalStartSearch < 0) {
                $intervalStartSearch = 0;
            }

            $arrObjPlayers = \Player\PlayerHelper::getPlayerRepository()->findClassement("PVE", $intervalStartSearch, 10);

            $this->arrayTemplate["finded"] = true;
            $this->arrayTemplate["arrObjPlayers"] = $arrObjPlayers;
            $this->arrayTemplate["search"] = $playerName;
            $this->arrayTemplate["place"] = $intervalStartSearch + 1;
            
        } else {
            $this->arrayTemplate["finded"] = false;
        }
        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new ClassementJoueursPvESearch();
$class->run();

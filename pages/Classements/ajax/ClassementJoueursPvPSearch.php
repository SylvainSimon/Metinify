<?php

namespace Pages\Classements\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ClassementJoueursPvPSearch extends \PageHelper {

    public $strTemplate = "ClassementJoueursPvPSearch.html5.twig";

    public function run() {

        global $request;

        $index = 0;
        $playerName = $request->request->get("recherche");

        $cacheManager = \CacheHelper::getCacheManager();
        if ($cacheManager->isExisting("arrObjPlayersCachePVP")) {
            $arrObjPlayersCachePVP = $cacheManager->get("arrObjPlayersCachePVP");
        } else {
            $arrObjPlayersCachePVP = \Player\PlayerHelper::getPlayerRepository()->findClassement("PVP", 0, 0, true);
            $cacheManager->set("arrObjPlayersCachePVP", $arrObjPlayersCachePVP, 3600);
        }
        
        foreach ($arrObjPlayersCachePVP AS $objPlayersCachePVP) {
            $index++;
            if ($objPlayersCachePVP["name"] == $playerName) {
                break;
            }
        }

        if (count($arrObjPlayersCachePVP) != $index) {

            $intervalStartSearch = ($index - 5);
            if ($intervalStartSearch < 0) {
                $intervalStartSearch = 0;
            }

            $arrObjPlayers = array_slice($arrObjPlayersCachePVP, $intervalStartSearch, 10);

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

$class = new ClassementJoueursPvPSearch();
$class->run();

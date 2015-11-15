<?php

namespace Pages\Classements\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ClassementJoueursPvESearch extends \PageHelper {

    public $strTemplate = "ClassementJoueursPvESearch.html5.twig";

    public function run() {

        global $request;

        $index = 0;
        $playerName = $request->request->get("recherche");

        $cacheManager = \CacheHelper::getCacheManager();
        if ($cacheManager->isExisting("arrObjPlayersCachePVE")) {
            $arrObjPlayersCachePVE = $cacheManager->get("arrObjPlayersCachePVE");
        } else {
            $arrObjPlayersCachePVE = \Player\PlayerHelper::getPlayerRepository()->findClassement("PVE", 0, 0, true);
            $cacheManager->set("arrObjPlayersCachePVE", $arrObjPlayersCachePVE, 3600);
        }
        
        foreach ($arrObjPlayersCachePVE AS $objPlayersCachePVE) {
            $index++;
            if ($objPlayersCachePVE["name"] == $playerName) {
                break;
            }
        }

        if (count($arrObjPlayersCachePVE) != $index) {

            $intervalStartSearch = ($index - 5);
            if ($intervalStartSearch < 0) {
                $intervalStartSearch = 0;
            }

            $arrObjPlayers = array_slice($arrObjPlayersCachePVE, $intervalStartSearch, 10);

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

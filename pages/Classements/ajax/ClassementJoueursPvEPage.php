<?php

namespace Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ClassementJoueursPvEPage extends \PageHelper {

    public $strTemplate = "ClassementJoueursPvEPage.html5.twig";
    
    public function run() {

        global $request;
        
        $numPage = $request->query->get("page");
        $intervalStart = ($numPage * 10);

        $cacheManager = \CacheHelper::getCacheManager();
        if ($cacheManager->isExisting("arrObjPlayersCachePVE")) {
            $arrObjPlayersCachePVE = $cacheManager->get("arrObjPlayersCachePVE");
        } else {
            $arrObjPlayersCachePVE = \Player\PlayerHelper::getPlayerRepository()->findClassement("PVE", 0, 0, true);
            $cacheManager->set("arrObjPlayersCachePVE", $arrObjPlayersCachePVE, 3600);
        }
        
        $arrObjPlayers = array_slice($arrObjPlayersCachePVE, $intervalStart, 10);
        $totalObjPlayers = count($arrObjPlayersCachePVE);

        $totalPage = (($totalObjPlayers / 10) - 1);
        $i = $intervalStart + 1;
        
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

$class = new ClassementJoueursPvEPage();
$class->run();

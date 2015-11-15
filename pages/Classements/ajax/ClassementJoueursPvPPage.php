<?php

namespace Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ClassementJoueursPvPPage extends \PageHelper {

    public $strTemplate = "ClassementJoueursPvPPage.html5.twig";
    
    public function run() {

        global $request;
        
        $numPage = $request->query->get("page");
        $intervalStart = ($numPage * 10);

        $cacheManager = \CacheHelper::getCacheManager();
        if ($cacheManager->isExisting("arrObjPlayersCachePVP")) {
            $arrObjPlayersCachePVP = $cacheManager->get("arrObjPlayersCachePVP");
        } else {
            $arrObjPlayersCachePVP = \Player\PlayerHelper::getPlayerRepository()->findClassement("PVP", 0, 0, true);
            $cacheManager->set("arrObjPlayersCachePVP", $arrObjPlayersCachePVP, 3600);
        }
        
        $arrObjPlayers = array_slice($arrObjPlayersCachePVP, $intervalStart, 10);
        $totalObjPlayers = count($arrObjPlayersCachePVP);
        
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

$class = new ClassementJoueursPvPPage();
$class->run();

<?php

namespace Administration;

require __DIR__ . '../../../../core/initialize.php';

class ajaxGererNewsEditSave extends \ScriptHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    public $strTemplate = "RadarGet.html5.twig";

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::RADAR);
    }

    public function run() {

        global $request;
        $idMap = $request->query->get("idMap");

        $arrObjPlayers = \Player\PlayerHelper::getPlayerRepository()->findPlayerOnlineByMap(30, $idMap, true);
        $arrIndex = \Localisation::getMapByIndex($idMap);
        $mapX = $arrIndex[4];
        $mapY = $arrIndex[5];
        $baseX = $arrIndex[2];
        $baseY = $arrIndex[3];

        $this->arrayTemplate["idMap"] = $idMap;
        $this->arrayTemplate["arrObjPlayers"] = $arrObjPlayers;
        $this->arrayTemplate["baseX"] = $baseX;
        $this->arrayTemplate["baseY"] = $baseY;
        $this->arrayTemplate["mapX"] = $mapX;
        $this->arrayTemplate["mapY"] = $mapY;
        $this->arrayTemplate["countOnMap"] = count($arrObjPlayers);
        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new ajaxGererNewsEditSave();
$class->run();

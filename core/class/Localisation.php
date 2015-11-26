<?php

class Localisation extends \ScriptHelper {

    public static function getMapByIndex($mapIndex) {

        $mapArchive = BASE_ROOT . "/maps.txt";
        $mapContents = file($mapArchive);
        $returnArray = false;
        foreach ($mapContents AS $aktMap) {

            $splitZeile = explode("|||", $aktMap);
            if (trim($splitZeile[0]) == $mapIndex) {
                $returnArray = array();
                $returnArray = $splitZeile;
            }
        }

        if (is_array($returnArray)) {
            return $returnArray;
        } else {
            return false;
        }
    }

    public static function localize($indexMap = 0, $objPlayer = null, $isConnected = false) {

        if ($indexMap == 0) {
            if (!$isConnected) {
                $indexMap = $objPlayer->getMapIndex();
            } else {
                $indexMap = $objPlayer->getExitMapIndex();
            }
        }

        include '../../pages/Tableaux_Arrays.php';

        $mapData = self::getMapByIndex($indexMap);

        if ($mapData != false) {

            $baseX = $mapData[2];
            $baseY = $mapData[3];

            if ($isConnected) {
                $chaDataX = ((($objPlayer->getX() - $baseX) / 200) / 0.5);
                $chaDataY = ((($objPlayer->getY() - $baseY) / 200) / 0.5);
            } else {
                $chaDataX = ((($objPlayer->getExitX() - $baseX) / 200) / 0.5);
                $chaDataY = ((($objPlayer->getExitY() - $baseY) / 200) / 0.5);
            }

            $view = [
                "map" => $Array_Maps[$indexMap],
                "positionX" => floor($chaDataX),
                "positionY" => floor($chaDataY)
            ];

            return json_encode($view);
        } else {
            return "Position inconnu";
        }
    }

}

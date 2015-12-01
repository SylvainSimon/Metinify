<?php

class MapHelper {

    const MAP_1_ROUGE = 1;
    const MAP_2_ROUGE = 3;
    const MAP_1_JAUNE = 21;
    const MAP_2_JAUNE = 23;
    const MAP_1_BLEU = 41;
    const MAP_2_BLEU = 43;
    const MONT_SO_HAN = 61;
    const PAPIER_DOYUM = 62;
    const DESERT_YONGBI = 63;
    const VALLEE_SEUNGRYONG = 64;
    const TEMPLE = 65;
    const FORET = 67;
    const BOIS_ROUGE = 68;
    const CAVE_2 = 71;
    const MAP_230 = 199;
    const MAP_X_KING = 200;
    const MAP_X_DD = 201;
    
    public static function getAll($sort = true) {

        $arrMap = array(
            self::ROUGE => "",
        );

        if ($sort) {
            asort($arrMap);
        }

        return $arrMap;
    }

    public static function getLibelle($idMap = 0) {
        
        $arrMap = self::getAll();

        if (array_key_exists($idMap, $arrMap)) {
            return $arrMap[$idMap];
        } else {
            return "inconnu";
        }
    }

    public static function getForDatatableSelect() {

        $arrResult = [];
        $arrMap = self::getAll();

        foreach ($arrMap AS $idMap => $empire) {
            $arrResult[] = "{value:'" . $idMap . "', label:'" . $empire . "'}";
        }
        
        return implode(", ", $arrResult);
    }

}

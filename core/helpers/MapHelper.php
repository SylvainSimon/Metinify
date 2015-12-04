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
    const TOUR_DEMON = 66;
    const FORET = 67;
    const BOIS_ROUGE = 68;
    const CAVE_2 = 71;
    const MAP_230 = 199;
    const MAP_X_KING = 200;
    const MAP_X_DD = 201;
    
    public static function getAll($sort = true) {

        global $translator;
        
        \Debug::log($translator);
        
        $arrMap = array(
            self::MAP_1_ROUGE => $translator->trans('map.map1Red', array(), 'map'),
            self::MAP_2_ROUGE => $translator->trans('map.map2Red', array(), 'map'),
            self::MAP_1_JAUNE => $translator->trans('map.map1Yellow', array(), 'map'),
            self::MAP_2_JAUNE => $translator->trans('map.map2Yellow', array(), 'map'),
            self::MAP_1_BLEU => $translator->trans('map.map1Blue', array(), 'map'),
            self::MAP_2_BLEU => $translator->trans('map.map2Blue', array(), 'map'),
            self::MONT_SO_HAN => $translator->trans('map.monSoHan', array(), 'map'),
            self::PAPIER_DOYUM => $translator->trans('map.papierDoyum', array(), 'map'),
            self::TOUR_DEMON => $translator->trans('map.tourDemon', array(), 'map'),
            self::DESERT_YONGBI => $translator->trans('map.desertYongbi', array(), 'map'),
            self::VALLEE_SEUNGRYONG => $translator->trans('map.valleeSeungryong', array(), 'map'),
            self::TEMPLE => $translator->trans('map.temple', array(), 'map'),
            self::FORET => $translator->trans('map.foret', array(), 'map'),
            self::BOIS_ROUGE => $translator->trans('map.boisRouge', array(), 'map'),
            self::CAVE_2 => $translator->trans('map.caveAraignee2', array(), 'map'),
            self::MAP_230 => $translator->trans('map.map230', array(), 'map'),
            self::MAP_X_KING => $translator->trans('map.mapXKing', array(), 'map'),
            self::MAP_X_DD => $translator->trans('map.mapDD', array(), 'map'),
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

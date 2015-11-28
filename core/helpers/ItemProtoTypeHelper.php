<?php

class ItemProtoTypeHelper {

    const CANNE_A_PECHE = 13;

    public static function getAll($sort = true) {

        $arrTypeAction = array(
            self::CANNE_A_PECHE => "Canne à pêche",
        );

        if ($sort) {
            asort($arrTypeAction);
        }

        return $arrTypeAction;
    }

    public static function getLibelle($idDevise = 0) {

        $arrTypeAction = self::getAll();

        if (array_key_exists($idDevise, $arrTypeAction)) {
            return $arrTypeAction[$idDevise];
        } else {
            return "";
        }
    }

    public static function getForDatatableSelect($sort = true) {

        $arrResult = [];
        $arrTypeAction = self::getAll($sort);

        foreach ($arrTypeAction AS $idDevise => $devise) {
            $arrResult[] = "{value:'" . $idDevise . "', label:'" . $devise . "'}";
        }
        
        return implode(", ", $arrResult);
    }

}

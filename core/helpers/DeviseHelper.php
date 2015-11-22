<?php

class DeviseHelper {

    const CASH = 1;
    const MILEAGE = 2;

    public static function getAll($sort = true) {

        global $config;

        $arrTypeAction = array(
            self::CASH => $config->libelleCash,
            self::MILEAGE => $config->libelleMileage,
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

    public static function getForDatatableSelect() {

        $arrResult = [];
        $arrTypeAction = self::getAll();

        foreach ($arrTypeAction AS $idDevise => $devise) {
            $arrResult[] = "{value:'" . $idDevise . "', label:'" . $devise . "'}";
        }
        
        return implode(", ", $arrResult);
    }

}

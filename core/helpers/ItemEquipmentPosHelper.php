<?php

class ItemEquipmentPosHelper {

    const ARME = 4;
    const ARMURE = 0;
    const CASQUE = 1;
    const BOUCLIER = 10;
    const BRACELET = 3;
    const BOUCLE = 6;
    const COLLIER = 5;
    const CHAUSSURE = 2;
    const FLECHE = 9;
    const SPECIAL1 = 7;
    const SPECIAL2 = 8;
    
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

<?php

class DeviseHelper {

    const CASH = 1;
    const MILEAGE = 2;
    
    const LIBELLE_CASH = "VamoNaie";
    const LIBELLE_MILEAGE = "TanaNaie";

    public static function getAll($sort = true) {

        $arrTypeAction = array(
            self::CASH => self::LIBELLE_CASH,
            self::MILEAGE => self::LIBELLE_MILEAGE,
        );

        if ($sort) {
            asort($arrTypeAction);
        }

        return $arrTypeAction;
    }

    public static function getLibelle($idTypeAction = 0) {

        $arrTypeAction = self::getAll();

        if (array_key_exists($idTypeAction, $arrTypeAction)) {
            return $arrTypeAction[$idTypeAction];
        } else {
            return "";
        }
    }

    public static function getAllForSelect() {

        $arrTypeAction = self::getAll();

        $Tableau_Retour = [];

        foreach ($arrTypeAction AS $idTypeAction => $typeAction) {
            $Tableau_Retour[] = "{value:\"" . $idTypeAction . "\", label:\"" . $typeAction . "\"}";
        }

        return implode(", ", $Tableau_Retour);
    }

}

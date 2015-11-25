<?php

class BanDureeHelper {

    const UN_JOUR = 1;
    const UNE_SEMAINE = 7;
    const UN_MOIS = 30;
    const UN_AN = 365;
    const DEFINITIF = 0;

    public static function getAll($sort = true) {

        $arr = array(
            self::UN_JOUR => "1 jour",
            self::UNE_SEMAINE => "1 semaine",
            self::UN_MOIS => "1 mois",
            self::UN_AN => "1 an",
            self::DEFINITIF => "Définitif",
        );

        if ($sort) {
            asort($arr);
        }

        return $arr;
    }

    public static function getLibelle($id = 0) {

        $arr = self::getAll();

        if (array_key_exists($id, $arr)) {
            return $arr[$id];
        } else {
            return "";
        }
    }

    public static function getForDatatableSelect() {

        $arrResult = [];
        $arr = self::getAll();

        foreach ($arr AS $id => $libelle) {
            $arrResult[] = "{value:'" . $id . "', label:'" . $libelle . "'}";
        }
        
        return implode(", ", $arrResult);
    }

}

<?php

class SupportObjetsHelper {

    const TECHNIQUE = 1;
    const ITEM_SHOP = 2;
    const RECHARGEMENT = 3;
    const PLAINTE = 4;
    const AUTRE = 5;

    public static function getAll($sort = true) {

        $arr = array(
            self::TECHNIQUE => "Problème technique",
            self::ITEM_SHOP => "Item-shop",
            self::RECHARGEMENT => "Rechargement",
            self::PLAINTE => "Plainte",
            self::AUTRE => "Autre..",
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

    public static function getForDatatableSelect($sort = true) {

        $arrResult = [];
        $arr = self::getAll($sort);

        foreach ($arr AS $id => $libelle) {
            $arrResult[] = "{value:'" . $id . "', label:'" . $libelle . "'}";
        }
        
        return implode(", ", $arrResult);
    }

}

<?php

class BanRaisonHelper {

    const BOT_PECHE = 1;
    const INSULTE_GM = 2;
    const INSULTE_JOUEUR = 3;

    public static function getAll($sort = true) {

        $arr = array(
            self::BOT_PECHE => "Bot pèche",
            self::INSULTE_GM => "Insulte(s) à GM",
            self::INSULTE_JOUEUR => "Insulte(s) à joueur(s)",
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

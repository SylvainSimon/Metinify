<?php

class BanRaisonHelper {

    const BOT_PECHE = 1;
    const INSULTE_GM = 4;
    const INSULTE_JOUEUR = 22;
    const TRICHERIE = 7;
    const BUG_USE = 12;
    const PUBLICITE = 23;
    const FRAUDE = 24;
    const VOL = 28;
    const USURPATION_TEAM = 29;
    const AUTRE = 27;

    public static function getAll($sort = true) {

        $arr = array(
            self::BOT_PECHE => "Bot pèche",
            self::INSULTE_JOUEUR => "Insulte(s) à joueur(s)",
            self::INSULTE_GM => "Insulte(s) à GM",
            self::TRICHERIE => "Triche",
            self::BUG_USE => "Utilisation de bug",
            self::PUBLICITE => "Publicité",
            self::FRAUDE => "Fraude",
            self::VOL => "Vol",
            self::USURPATION_TEAM => "Usurpation GM",
            self::AUTRE => "Autre",
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

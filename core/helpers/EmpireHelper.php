<?php

class EmpireHelper {

    const ROUGE = 1;
    const JAUNE = 2;
    const BLEU = 3;

    public static function getAll($sort = true) {
        global $config;

        $arrEmpire = array(
            self::ROUGE => $config->libelleEmpire1,
            self::JAUNE => $config->libelleEmpire2,
            self::BLEU => $config->libelleEmpire3,
        );

        if ($sort) {
            asort($arrEmpire);
        }

        return $arrEmpire;
    }

    public static function getLibelle($idEmpire = 0) {
        
        $arrEmpire = self::getAll();

        if (array_key_exists($idEmpire, $arrEmpire)) {
            return $arrEmpire[$idEmpire];
        } else {
            return "inconnu";
        }
    }

    public static function getForDatatableSelect() {

        $arrResult = [];
        $arrEmpire = self::getAll();

        foreach ($arrEmpire AS $idEmpire => $empire) {
            $arrResult[] = "{value:'" . $idEmpire . "', label:'" . $empire . "'}";
        }
        
        return implode(", ", $arrResult);
    }

}

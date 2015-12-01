<?php

class EmpireHelper {

    const ROUGE = 1;
    const JAUNE = 2;
    const BLEU = 3;
    
    const ROUGE_DEFAULT_X = 488774;
    const ROUGE_DEFAULT_Y = 955480;
    
    const JAUNE_DEFAULT_X = 64305;
    const JAUNE_DEFAULT_Y = 186753;
    
    const BLEU_DEFAULT_X = 963684;
    const BLEU_DEFAULT_Y = 285235;

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

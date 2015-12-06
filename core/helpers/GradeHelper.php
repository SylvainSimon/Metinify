<?php

class GradeHelper {

    const NEUTRE = 0;
    const AMICAL = 1;
    const BON = 2;
    const NOBLE = 3;
    const CHEVALIER = 4;
    const AGRESSIF = -1;
    const RETORD = -2;
    const MALICIEUX = -3;
    const CRUEL = -4;
    
    public static function getAll($sort = true) {
        
        global $translator;

        $arrGrade = array(
            self::NEUTRE => $translator->trans('grade.gradeNeutre', array(), 'grade'),
            self::AMICAL => $translator->trans('grade.gradeAmical', array(), 'grade'),
            self::BON => $translator->trans('grade.gradeBon', array(), 'grade'),
            self::NOBLE => $translator->trans('grade.gradeNoble', array(), 'grade'),
            self::CHEVALIER => $translator->trans('grade.gradeChevalier', array(), 'grade'),
            self::AGRESSIF => $translator->trans('grade.gradeAgressif', array(), 'grade'),
            self::RETORD => $translator->trans('grade.gradeRetord', array(), 'grade'),
            self::MALICIEUX => $translator->trans('grade.gradeMalicieux', array(), 'grade'),
            self::CRUEL => $translator->trans('grade.gradeCruel', array(), 'grade'),
        );

        if ($sort) {
            asort($arrGrade);
        }

        return $arrGrade;
    }

    public static function getLibelle($idGrade = 0) {
        
        $arrGrade = self::getAll();

        if (array_key_exists($idGrade, $arrGrade)) {
            return $arrGrade[$idGrade];
        } else {
            return "inconnu";
        }
    }

    public static function getForDatatableSelect() {

        $arrResult = [];
        $arrGrade = self::getAll();

        foreach ($arrGrade AS $idGrade => $grade) {
            $arrResult[] = "{value:'" . $idGrade . "', label:'" . $grade . "'}";
        }
        
        return implode(", ", $arrResult);
    }

}

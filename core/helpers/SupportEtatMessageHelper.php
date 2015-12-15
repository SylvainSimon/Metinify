<?php

class SupportEtatMessageHelper {

    const LU = 1;
    const NON_LU = 2;
    
    const LIBELLE_LU = 'LU';
    const LIBELLE_NON_LU = 'Non-lu';

    public static function getByCode($Code) {
        
        switch ($Code) {

            case self::LU:
                $Libelle_Code = self::LIBELLE_LU;
                break;

            case self::NON_LU:
                $Libelle_Code = self::LIBELLE_NON_LU;
                break;

            default :
                $Libelle_Code = "";
                break;
        }
        
        return $Libelle_Code;
    }

    public static function getLu() {
        return self::LIBELLE_LU;
    }

    public static function getNonLu() {
        return self::LIBELLE_NON_LU;
    }

    public static function getAll() {
        return array(
            self::LU,
            self::NON_LU,
        );
    }

}

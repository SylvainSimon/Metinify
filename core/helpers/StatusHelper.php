<?php

class StatusHelper {

    const ACTIF = "OK";
    const BANNI = "BLOCK";
    const NON_CONFIRME = ".";

    public static function getAll($sort = true, $withoutLast = false) {

        if ($withoutLast == true) {
            $arrStatus = array(
                self::ACTIF => "Actif",
                self::BANNI => "Banni",
            );
        } else {
            $arrStatus = array(
                self::ACTIF => "Actif",
                self::BANNI => "Banni",
                self::NON_CONFIRME => "Non confirmé",
            );
        }

        if ($sort) {
            asort($arrStatus);
        }

        return $arrStatus;
    }

    public static function getLibelle($idStatus = 0) {

        $arrStatus = self::getAll();

        if (array_key_exists($idStatus, $arrStatus)) {
            return $arrStatus[$idStatus];
        } else {
            return "Non défini";
        }
    }

    public static function getForDatatableSelect($withoutLast = false) {

        $arrResult = [];
        $arrStatus = self::getAll(true, $withoutLast);

        foreach ($arrStatus AS $idStatus => $status) {
            $arrResult[] = "{value:'" . $idStatus . "', label:'" . $status . "'}";
        }

        return implode(", ", $arrResult);
    }

}

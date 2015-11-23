<?php

class AuthorityHelper {

    const IMPLEMENTOR = "IMPLEMENTOR";
    const HIGH_WIZARD = "HIGH_WIZARD";

    public static function getAll($sort = true) {

        $arrAuthority = array(
            self::IMPLEMENTOR => "Admin/SGM",
            self::HIGH_WIZARD => "GM/TGM",
        );

        if ($sort) {
            asort($arrAuthority);
        }

        return $arrAuthority;
    }

    public static function getLibelle($idAuthority = 0) {

        $arrAuthority = self::getAll();

        if (array_key_exists($idAuthority, $arrAuthority)) {
            return $arrAuthority[$idAuthority];
        } else {
            return "";
        }
    }

    public static function getForDatatableSelect() {

        $arrResult = [];
        $arrAuthority = self::getAll();

        foreach ($arrAuthority AS $idAuthority => $authority) {
            $arrResult[] = "{value:'" . $idAuthority . "', label:'" . $authority . "'}";
        }
        
        return implode(", ", $arrResult);
    }

}

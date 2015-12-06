<?php

class FonctionsUtiles {

    static function Formatage_Taille($bytes, $format = '%.2f', $lang = 'fr') {

        $units = array(
            'fr' => array(
                'o',
                'Ko',
                'Mo',
                'Go',
                'To'
            ),
            'en' => array(
                'B',
                'KB',
                'MB',
                'GB',
                'TB'
        ));
        $translatedUnits = $units[$lang];

        if (isset($translatedUnits) === false) {
            $translatedUnits = $units['en'];
        }

        $b = (double) $bytes;
        /* On gére le cas des tailles de fichier négatives */
        if ($b > 0) {
            $e = (int) (log($b, 1024));
            /*             * Si on a pas l'unité on retourne en To */
            if (isset($translatedUnits[$e]) === false) {
                $e = 4;
            }
            $b = $b / pow(1024, $e);
        } else {
            $b = 0;
            $e = 0;
        }
        return sprintf($format . ' %s', $b, $translatedUnits[$e]);
    }

    static function myPasswordToDoubleSha1($input, $hex = true) {
        $sha1_stage1 = sha1($input, true);
        $output = sha1($sha1_stage1, !$hex);
        return "*" . strtoupper($output);
    }

    static function sizeOfFileExt($urlClient) {
        $headers = get_headers($urlClient, true);
        if (isset($headers['Content-Length'])) {
            $size = $headers['Content-Length'];
        } else {
            $size = 0;
        }
        return $size;
    }

    static function GenerateString($Nombre_De_Caracteres, $type = "ALL") {

        $Chaine_De_Puisement = "";

        switch ($type) {
            case "ALL":
                $Chaine_De_Puisement .= 'abcdefghijklmnopqrstuvwxyz';
                $Chaine_De_Puisement .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $Chaine_De_Puisement .= '1234567890';
                break;
            case "STRING":
                $Chaine_De_Puisement .= 'abcdefghijklmnopqrstuvwxyz';
                $Chaine_De_Puisement .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            case "INT":
                $Chaine_De_Puisement .= '1234567890';
        }

        $Chaine_Retourne = '';

        for ($i = 0; $i < $Nombre_De_Caracteres; $i++) {
            $Chaine_Retourne .= substr($Chaine_De_Puisement, rand() % (strlen($Chaine_De_Puisement)), 1);
        }
        return $Chaine_Retourne;
    }

    static function Raccourcissement_Chaine($Chaine, $Limite) {

        $Chaine_Temporaire = substr($Chaine, 0, $Limite);
        $Chaine_Final = $Chaine_Temporaire . "...";

        return $Chaine_Final;
    }

    static function Formatage_Yangs($Somme) {
        $Somme_Formatee = number_format($Somme, 0, '.', ' ');
        return $Somme_Formatee;
    }

    static function findTitleJob($job) {

        $Nom_Race = "";

        if ($job == "0") {
            $Nom_Race = "Guerrier, Homme";
        } else if ($job == "1") {
            $Nom_Race = "Ninja, Femme";
        } else if ($job == "2") {
            $Nom_Race = "Sura, Homme";
        } else if ($job == "3") {
            $Nom_Race = "Shaman, Femme";
        } else if ($job == "4") {
            $Nom_Race = "Guerrière, Femme";
        } else if ($job == "5") {
            $Nom_Race = "Ninja, Homme";
        } else if ($job == "6") {
            $Nom_Race = "Sura, Femme";
        } else if ($job == "7") {
            $Nom_Race = "Shaman, Homme";
        }

        return $Nom_Race;
    }

    static function findSkillGroup($job = 0, $skillGroup = 0) {

        $return = "Non définie";

        if ($job == 0 or $job == 4) {
            if ($skillGroup == 1) {
                $return = "Corps à corps";
            } else if ($skillGroup == 2) {
                $return = "Mental";
            }
        } else if ($job == 1 or $job == 5) {
            if ($skillGroup == 1) {
                $return = "Assasin";
            } else if ($skillGroup == 2) {
                $return = "Archer";
            }
        } else if ($job == 2 or $job == 6) {
            if ($skillGroup == 1) {
                $return = "Arme magique";
            } else if ($skillGroup == 2) {
                $return = "Magie noire";
            }
        } else if ($job == 3 or $job == 7) {
            if ($skillGroup == 1) {
                $return = "Dragon";
            } else if ($skillGroup == 2) {
                $return = "Soin";
            }
        }

        return $return;
    }

    static function isWomen($job = 0) {
        if ($job == "1" or $job == "3" or $job == "4" or $job == "6") {
            return false;
        } else {
            return true;
        }
    }

    static function countBonusOnAccount($objAccount) {

        $count = 0;
        if ($objAccount->getAutolootExpire() > \Carbon\Carbon::now()) {
            $count++;
        }
        if ($objAccount->getGoldExpire() > \Carbon\Carbon::now()) {
            $count++;
        }
        if ($objAccount->getSilverExpire() > \Carbon\Carbon::now()) {
            $count++;
        }
        if ($objAccount->getMarriageFastExpire() > \Carbon\Carbon::now()) {
            $count++;
        }
        if ($objAccount->getSafeboxExpire() > \Carbon\Carbon::now()) {
            $count++;
        }
        if ($objAccount->getMoneyDropRateExpire() > \Carbon\Carbon::now()) {
            $count++;
        }
        if ($objAccount->getFishMindExpire() > \Carbon\Carbon::now()) {
            $count++;
        }
        
        return $count;
    }

    static function findIconJob($job = 0) {

        $imgLink = '<img class="Dimension_Image_Classement" data-tooltip="' . self::findTitleJob($job) . '" src="';

        if ($job == "0") {
            $imgLink .= "images/races/0_mini.png";
        } else if ($job == "1") {
            $imgLink .= "images/races/1_mini.png";
        } else if ($job == "2") {
            $imgLink .= "images/races/2_mini.png";
        } else if ($job == "3") {
            $imgLink .= "images/races/3_mini.png";
        } else if ($job == "4") {
            $imgLink .= "images/races/4_mini.png";
        } else if ($job == "5") {
            $imgLink .= "images/races/5_mini.png";
        } else if ($job == "6") {
            $imgLink .= "images/races/6_mini.png";
        } else if ($job == "7") {
            $imgLink .= "images/races/7_mini.png";
        }

        $imgLink .= '" height="20">';

        return $imgLink;
    }

    static function findIconEmpire($idEmpire) {

        $iconElement = '<i data-tooltip="Empire ' . EmpireHelper::getLibelle($idEmpire) . '" class="';

        if ($idEmpire == 1) {
            $iconElement .= "text-red ";
        } else if ($idEmpire == 2) {
            $iconElement .= "text-yellow ";
        } else if ($idEmpire == 3) {
            $iconElement .= "text-blue ";
        } else {
            $iconElement .= "text-gray ";
        }

        $iconElement .= 'material-icons md-icon-map md-20"></i>';

        return $iconElement;
    }

    static function findIconDevise($idDevise) {

        $iconElement = '<i data-tooltip="' . DeviseHelper::getLibelle($idDevise) . '" class="';

        if ($idDevise == 1) {
            $iconElement .= "text-yellow ";
        } else if ($idDevise == 2) {
            $iconElement .= "text-gray ";
        }

        $iconElement .= 'material-icons md-icon-whatshot md-16"></i>';

        return $iconElement;
    }

    static function findIconOnline($statut = false) {

        if ($statut) {
            $iconElement = '<i data-tooltip="En ligne" class="';
        } else {
            $iconElement = '<i data-tooltip="Hors-ligne" class="';
        }

        if ($statut) {
            $iconElement .= "text-green";
        } else {
            $iconElement .= "text-red ";
        }

        $iconElement .= 'material-icons md-icon-account-circle md-20 pull-right"></i>';

        return $iconElement;
    }

    static function findIconStatus($statut) {

        $iconElement = '<i data-tooltip-position="left" data-tooltip="' . StatusHelper::getLibelle($statut) . '" class="';

        if ($statut == StatusHelper::ACTIF) {
            $iconElement .= "text-green md-icon-done ";
        } else if ($statut == StatusHelper::BANNI) {
            $iconElement .= "text-red md-icon-close ";
        } else if ($statut == StatusHelper::NON_CONFIRME) {
            $iconElement .= "text-warning md-icon-warning ";
        } else {
            $iconElement .= "text-gray md-icon-help ";
        }

        $iconElement .= 'material-icons md-20"></i>';

        return $iconElement;
    }

}

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

    static function Formatage_Date($Donnees_Brute, $simplifie = false) {

        $Array_Mois = array(
            '01' => 'Janvier',
            '02' => 'Fevrier',
            '03' => 'Mars',
            '04' => 'Avril',
            '05' => 'Mai',
            '06' => 'Juin',
            '07' => 'Juillet',
            '08' => 'Aout',
            '09' => 'Septembre',
            '10' => 'Octobre',
            '11' => 'Novembre',
            '12' => 'Decembre'
        );

        $Explosion_DateEntiere = explode(" ", $Donnees_Brute);

        $Explosion_Date = explode("-", $Explosion_DateEntiere[0]);
        $Explosion_Heure = explode(":", $Explosion_DateEntiere[1]);

        if ($Explosion_DateEntiere[0] != '0000-00-00') {

            $Date_Jours = $Explosion_Date[2];
            $Date_Mois = $Array_Mois[$Explosion_Date[1]];
            $Date_Annee = $Explosion_Date[0];
        }

        $Date_Heure = $Explosion_Heure[0];
        $Date_Minute = $Explosion_Heure[1];
        $Date_Seconde = $Explosion_Heure[2];

        if ($Explosion_DateEntiere[0] != '0000-00-00') {

            if ($simplifie) {
                $Recomposition_Date = "" . $Date_Jours . " " . $Date_Mois . " " . $Date_Annee . " à " . $Date_Heure . "h" . $Date_Minute . "m" . $Date_Seconde . "s";
            } else {
                $Recomposition_Date = "Le " . $Date_Jours . " " . $Date_Mois . " " . $Date_Annee . " à " . $Date_Heure . "h" . $Date_Minute . "m" . $Date_Seconde . "s";
            }
        } else {
            $Recomposition_Date = "La date n'a pas été définie.";
        }

        return $Recomposition_Date;
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

    static function findIconJob($job) {

        $imgLink = '<img class="Images_Recherches" data-tooltip="' . self::findTitleJob($job) . '" src="';

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

    static function findIconStatus($statut) {

        $iconElement = '<i data-tooltip="' . StatusHelper::getLibelle($statut) . '" class="';

        if ($statut == "OK") {
            $iconElement .= "text-green ";
        } else if ($statut == "BLOCK") {
            $iconElement .= "text-red ";
        } else {
            $iconElement .= "text-gray ";
        }

        $iconElement .= 'material-icons md-icon-account-circle md-20"></i>';

        return $iconElement;
    }
}

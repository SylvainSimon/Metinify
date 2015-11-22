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

    static function Formatage_Date_News($Donnees_Brute) {

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

        if ($Explosion_DateEntiere[0] != '0000-00-00') {

            $Date_Jours = $Explosion_Date[2];
            $Date_Mois = $Array_Mois[$Explosion_Date[1]];
            $Date_Annee = $Explosion_Date[0];
        }

        if ($Explosion_DateEntiere[0] != '0000-00-00') {
            $Recomposition_Date = "" . $Date_Jours . " " . $Date_Mois . " " . $Date_Annee . "";
        } else {
            $Recomposition_Date = "La date n'a pas été définie.";
        }

        return $Recomposition_Date;
    }

    static function Formatage_Date_Vue($Donnees_Brute) {

        $Explosion_DateEntiere = explode(" ", $Donnees_Brute);

        $Explosion_Date = explode("-", $Explosion_DateEntiere[0]);
        $Explosion_Heure = explode(":", $Explosion_DateEntiere[1]);

        if ($Explosion_DateEntiere[0] != '0000-00-00') {

            $Date_Jours = $Explosion_Date[2];
            $Date_Mois = $Explosion_Date[1];
        }

        $Date_Heure = $Explosion_Heure[0];
        $Date_Minute = $Explosion_Heure[1];
        $Date_Seconde = $Explosion_Heure[2];

        if ($Explosion_DateEntiere[0] != '0000-00-00') {
            $Recomposition_Date = "Vu : " . $Date_Jours . "/" . $Date_Mois . " à " . $Date_Heure . ":" . $Date_Minute . ":" . $Date_Seconde . "";
        } else {
            $Recomposition_Date = "Non-Vu";
        }

        return $Recomposition_Date;
    }

    static function Raccourcissement_Chaine($Chaine, $Limite) {

        $Chaine_Temporaire = substr($Chaine, 0, $Limite);
        $Chaine_Final = $Chaine_Temporaire . "...";

        return $Chaine_Final;
    }

    static function Obtenir_Annee_Date($Donnees_Brute) {

        $Explosion_DateEntiere = explode(" ", $Donnees_Brute);

        $Explosion_Date = explode("-", $Explosion_DateEntiere[0]);

        $Date_Annee = $Explosion_Date[0];

        return $Date_Annee;
    }

    static function Obtenir_Mois_Date($Donnees_Brute) {

        $Explosion_DateEntiere = explode(" ", $Donnees_Brute);

        $Explosion_Date = explode("-", $Explosion_DateEntiere[0]);

        $Date_Annee = $Explosion_Date[1];

        return $Date_Annee;
    }

    static function Obtenir_Jours_Date($Donnees_Brute) {

        $Explosion_DateEntiere = explode(" ", $Donnees_Brute);

        $Explosion_Date = explode("-", $Explosion_DateEntiere[0]);

        $Date_Annee = $Explosion_Date[2];

        return $Date_Annee;
    }

    static function Obtenir_Heure_Date($Donnees_Brute) {

        $Explosion_DateEntiere = explode(" ", $Donnees_Brute);

        $Explosion_Heure = explode(":", $Explosion_DateEntiere[1]);

        $Date_Annee = $Explosion_Heure[0];

        return $Date_Annee;
    }

    static function Obtenir_Minute_Date($Donnees_Brute) {

        $Explosion_DateEntiere = explode(" ", $Donnees_Brute);

        $Explosion_Heure = explode(":", $Explosion_DateEntiere[1]);

        $Date_Annee = $Explosion_Heure[1];

        return $Date_Annee;
    }

    static function Obtenir_Seconde_Date($Donnees_Brute) {

        $Explosion_DateEntiere = explode(" ", $Donnees_Brute);

        $Explosion_Heure = explode(":", $Explosion_DateEntiere[1]);

        $Date_Annee = $Explosion_Heure[2];

        return $Date_Annee;
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

        $imgLink = '<img class="Images_Recherches" data-tooltip="'.self::findTitleJob($job).'" src="';

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

    static function FindIconeEmpire($idEmpire) {

        if ($idEmpire == 1) {
            $icone = "<i data-tooltip='Empire Shinsoo' class='text-red material-icons md-icon-map md-20'></i>";
        } else if ($idEmpire == 2) {
            $icone = "<i data-tooltip='Empire Chunjo' class='text-yellow material-icons md-icon-map md-20'></i>";
        } else if ($idEmpire == 3) {
            $icone = "<i data-tooltip='Empire Jinno' class='text-blue material-icons md-icon-map md-20'></i>";
        } else {
            $icone = "<i data-tooltip='Royaume inconnu' class='material-icons md-icon-map md-20'></i>";
        }

        return $icone;
    }

    static function Find_Name_Empire($Empire) {

        $Nom_Empire = "Empire inconnu";

        if ($Empire == "0") {
            $Nom_Empire = "Empire inconnu";
        } else if ($Empire == "1") {
            $Nom_Empire = "Empire Shinsoo";
        } else if ($Empire == "2") {
            $Nom_Empire = "Empire Chunjo";
        } else if ($Empire == "3") {
            $Nom_Empire = "Empire Jinno";
        }

        return $Nom_Empire;
    }

    static function Find_Image_Empire($Empire) {

        $imgLink = "images/races/Royaume_Inconnu.jpg";

        if ($Empire == "0") {
            $imgLink = "images/races/Royaume_Inconnu.jpg";
        } else if ($Empire == "1") {
            $imgLink = "images/empire/red.jpg";
        } else if ($Empire == "2") {
            $imgLink = "images/empire/yellow.jpg";
        } else if ($Empire == "3") {
            $imgLink = "images/empire/blue.jpg";
        }
        return $imgLink;
    }

    static function Find_Image_Status($Status) {

        $imgLink = "";

        if ($Status == "OK") {
            $imgLink = "images/valid.gif";
        } else if ($Status == "BLOCK") {
            $imgLink = "images/invalid.gif";
        }
        return $imgLink;
    }

    static function Find_Title_Status($Status) {

        $Title = "";

        if ($Status == "OK") {
            $Title = "Compte Actif";
        } else if ($Status == "BLOCK") {
            $Title = "Compte Banni";
        }
        return $Title;
    }

}

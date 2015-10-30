<?php

function Formatage_Date($Donnees_Brute) {

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
        $Recomposition_Date = "Le " . $Date_Jours . " " . $Date_Mois . " " . $Date_Annee . " à " . $Date_Heure . "h" . $Date_Minute . "m" . $Date_Seconde . "s";
    } else {
        $Recomposition_Date = "La date n'a pas été définie.";
    }

    return $Recomposition_Date;
}

function Formatage_Date_News($Donnees_Brute) {

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


function Formatage_Date_Vue($Donnees_Brute) {

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

function Test_Connexion() {

    @session_write_close();
    @session_start();

    if (empty($_SESSION['ID'])) {
        return false;
    } else {
        return true;
    }
}

function Raccourcissement_Chaine($Chaine, $Limite) {

    $Chaine_Temporaire = substr($Chaine, 0, $Limite);
    $Chaine_Final = $Chaine_Temporaire . "...";

    return $Chaine_Final;
}

function ipAdressNumber($dotted) {

    error_reporting(0);

    $dotted = preg_split("/[.]+/", $dotted);
    $ip = (double) ($dotted[0] * 16777216) + ($dotted[1] * 65536) + ($dotted[2] * 256) + ($dotted[3]);
    // IP Number = A x (256*256*256) + B x (256*256) + C x 256 + D

    return $ip;
}

function Obtenir_Annee_Date($Donnees_Brute) {

    $Explosion_DateEntiere = explode(" ", $Donnees_Brute);

    $Explosion_Date = explode("-", $Explosion_DateEntiere[0]);

    $Date_Annee = $Explosion_Date[0];

    return $Date_Annee;
}

function Obtenir_Mois_Date($Donnees_Brute) {

    $Explosion_DateEntiere = explode(" ", $Donnees_Brute);

    $Explosion_Date = explode("-", $Explosion_DateEntiere[0]);

    $Date_Annee = $Explosion_Date[1];

    return $Date_Annee;
}

function Obtenir_Jours_Date($Donnees_Brute) {

    $Explosion_DateEntiere = explode(" ", $Donnees_Brute);

    $Explosion_Date = explode("-", $Explosion_DateEntiere[0]);

    $Date_Annee = $Explosion_Date[2];

    return $Date_Annee;
}

function Obtenir_Heure_Date($Donnees_Brute) {

    $Explosion_DateEntiere = explode(" ", $Donnees_Brute);

    $Explosion_Heure = explode(":", $Explosion_DateEntiere[1]);

    $Date_Annee = $Explosion_Heure[0];

    return $Date_Annee;
}

function Obtenir_Minute_Date($Donnees_Brute) {

    $Explosion_DateEntiere = explode(" ", $Donnees_Brute);

    $Explosion_Heure = explode(":", $Explosion_DateEntiere[1]);

    $Date_Annee = $Explosion_Heure[1];

    return $Date_Annee;
}

function Obtenir_Seconde_Date($Donnees_Brute) {

    $Explosion_DateEntiere = explode(" ", $Donnees_Brute);

    $Explosion_Heure = explode(":", $Explosion_DateEntiere[1]);

    $Date_Annee = $Explosion_Heure[2];

    return $Date_Annee;
}

function Formatage_Yangs($Somme) {

    $Somme_Formatee = number_format($Somme, 0, '.', ' ');

    return $Somme_Formatee;
}

function Find_Name_Race($Job) {

    $Nom_Race = "";

    if ($Job == "0") {
        $Nom_Race = "Guerrier, Homme";
    } else if ($Job == "1") {
        $Nom_Race = "Ninja, Femme";
    } else if ($Job == "2") {
        $Nom_Race = "Sura, Homme";
    } else if ($Job == "3") {
        $Nom_Race = "Shaman, Femme";
    } else if ($Job == "4") {
        $Nom_Race = "Guerrière, Femme";
    } else if ($Job == "5") {
        $Nom_Race = "Ninja, Homme";
    } else if ($Job == "6") {
        $Nom_Race = "Sura, Femme";
    } else if ($Job == "7") {
        $Nom_Race = "Shaman, Homme";
    }

    return $Nom_Race;
}

function Find_Image_Race($Job) {

    $Lien_Image = "";

    if ($Job == "0") {
        $Lien_Image = "images/races/0_mini.png";
    } else if ($Job == "1") {
        $Lien_Image = "images/races/1_mini.png";
    } else if ($Job == "2") {
        $Lien_Image = "images/races/2_mini.png";
    } else if ($Job == "3") {
        $Lien_Image = "images/races/3_mini.png";
    } else if ($Job == "4") {
        $Lien_Image = "images/races/4_mini.png";
    } else if ($Job == "5") {
        $Lien_Image = "images/races/5_mini.png";
    } else if ($Job == "6") {
        $Lien_Image = "images/races/6_mini.png";
    } else if ($Job == "7") {
        $Lien_Image = "images/races/7_mini.png";
    }

    return $Lien_Image;
}

function Find_Name_Empire($Empire) {

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

function Find_Image_Empire($Empire) {

    $Lien_Image = "images/races/Royaume_Inconnu.jpg";

    if ($Empire == "0") {
        $Lien_Image = "images/races/Royaume_Inconnu.jpg";
    } else if ($Empire == "1") {
        $Lien_Image = "images/empire/red.jpg";
    } else if ($Empire == "2") {
        $Lien_Image = "images/empire/yellow.jpg";
    } else if ($Empire == "3") {
        $Lien_Image = "images/empire/blue.jpg";
    }
    return $Lien_Image;
}

function Find_Image_Status($Status) {

    $Lien_Image = "";

    if ($Status == "OK") {
        $Lien_Image = "images/valid.gif";
    } else if ($Status == "BLOCK") {
        $Lien_Image = "images/invalid.gif";
    }
    return $Lien_Image;
}

function Find_Title_Status($Status) {

    $Title = "";

    if ($Status == "OK") {
        $Title = "Compte Actif";
    } else if ($Status == "BLOCK") {
        $Title = "Compte Banni";
    }
    return $Title;
}
?>

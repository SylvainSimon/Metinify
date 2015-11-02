<?php

namespace Administration;

require __DIR__ . '../../../core/initialize.php';

class SQL_Formatage_Date extends \PageHelper {

    public function run() {
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

        $Explosion_DateEntiere = explode(" ", $_POST["date"]);

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

        echo $Recomposition_Date;
?>
        <?php
    }
}

$class = new SQL_Formatage_Date();
$class->run();

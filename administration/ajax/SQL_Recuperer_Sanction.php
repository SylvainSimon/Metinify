<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php @include '../../configPDO.php'; ?>
<?php

$Id = $_POST["id_sanction"];

/* ------------------------ Vérification Recidive ---------------------------- */
$Recuperation_Sanction = "SELECT sanction, DATE(NOW() + INTERVAL sanction DAY) AS date, CURTIME() AS time
                          FROM $BDD_Site.bannissement_raisons
                          WHERE bannissement_raisons.id = :id";
$Parametres_Recuperation_Sanction = $Connexion->prepare($Recuperation_Sanction);
$Parametres_Recuperation_Sanction->execute(array(':id' => $Id));
$Parametres_Recuperation_Sanction->setFetchMode(PDO::FETCH_OBJ);
$Nombre_De_Resultat_Recuperation_Sanction = $Parametres_Recuperation_Sanction->rowCount();
/* -------------------------------------------------------------------------- */

if ($Nombre_De_Resultat_Recuperation_Sanction > 0) {

    $Donnees_Recuperation_Sanction = $Parametres_Recuperation_Sanction->fetch();


    if ($Donnees_Recuperation_Sanction->sanction == 999) {

        $Tableau_Retour_Json = array(
            'phrase' => "Bannissement définitif",
            'jours' => $Donnees_Recuperation_Sanction->sanction,
            'fin' => "Jamais"
        );
    } else {
        
        $Tableau_Retour_Json = array(
            'phrase' => "Bannissement pour " . $Donnees_Recuperation_Sanction->sanction . " jours.",
            'jours' => $Donnees_Recuperation_Sanction->sanction,
            'fin' => $Donnees_Recuperation_Sanction->date." ".$Donnees_Recuperation_Sanction->time
        );
    }
}
echo json_encode($Tableau_Retour_Json);
?>
<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include '../../configPDO.php'; ?>
<?php

$Id_Personnage = $_POST["id_perso"];
$Ip = $_SERVER["REMOTE_ADDR"];

/* ------------------------ Vérification Données ---------------------------- */
$Verification_Donnees = "SELECT gold FROM $BDD_Player.player
                                  WHERE id = ?
                                  AND account_id = ?
                                  LIMIT 1";
$Parametres_Verification_Donnees = $Connexion->prepare($Verification_Donnees);
$Parametres_Verification_Donnees->execute(array(
    $Id_Personnage,
    $_SESSION["ID"]));
$Parametres_Verification_Donnees->setFetchMode(PDO::FETCH_OBJ);
$Nombre_De_Resultat = $Parametres_Verification_Donnees->rowCount();
/* -------------------------------------------------------------------------- */

if ($Nombre_De_Resultat != 0) {

    $Donnees_Verification_Donnees = $Parametres_Verification_Donnees->fetch();

    if ($Donnees_Verification_Donnees->gold < 0) {

        /* ----------------- Update Coordonées --------------------- */
        $Update_Coordonees = "UPDATE $BDD_Player.player 
                          SET gold = ?
                          WHERE id = ?";

        $Parametres_Update_Coordonees = $Connexion->prepare($Update_Coordonees);
        $Parametres_Update_Coordonees->execute(array(
            "1500000000",
            $Id_Personnage));
        /* ----------------------------------------------------------- */

        /* -------------------------------------------- Insertion logs ----------------- */
        $Insertion_Logs = "INSERT INTO $BDD_Site.logs_deblocage_yangs (id_perso, id_compte, date, ip, log_yangs) 
                              VALUES (:id_perso, :id_compte, NOW(), :ip, :log_yangs)";

        $Parametres_Insertion = $Connexion->prepare($Insertion_Logs);
        $Parametres_Insertion->execute(array(
            ':id_perso' => $Id_Personnage,
            ':id_compte' => $_SESSION["ID"],
            ':ip' => $Ip,
            ':log_yangs' => $Donnees_Verification_Donnees->gold));
        /* ----------------------------------------------------------------------------- */
    } else {
        echo "YANGS";
    }
} else {
    echo "NOT_YOU";
}
?>
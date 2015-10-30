<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include_once '../configPDO.php'; ?>
<?php

$Suppression_Perssonage_Procedure_ID_Personnage = $_POST["id_personnage"];
$Suppression_Perssonage_Procedure_Nouveau_Nom = $_POST["nouveau_nom"];
$Connexion_Ip = $_SERVER['REMOTE_ADDR'];

if (!empty($_SESSION["ID"])) {

    /* ------------------------ Vérification Données ---------------------------- */
    $Verification_Donnees = "SELECT player.name 
                             FROM $BDD_Player.player
                             WHERE id = ?
                             AND account_id = ?
                             LIMIT 1";
    $Parametres_Verification_Donnees = $Connexion->prepare($Verification_Donnees);
    $Parametres_Verification_Donnees->execute(array(
        $Suppression_Perssonage_Procedure_ID_Personnage,
        $_SESSION["ID"]));
    $Parametres_Verification_Donnees->setFetchMode(PDO::FETCH_OBJ);
    $Nombre_De_Resultat = $Parametres_Verification_Donnees->rowCount();
    /* -------------------------------------------------------------------------- */

    if ($Nombre_De_Resultat != 0) {
        
        $Donnees_Verification_Donnees = $Parametres_Verification_Donnees->fetch();

        /* ------------------------ Vérification Liberté ---------------------------- */
        $Verification_Liberte = "SELECT id
                                 FROM $BDD_Player.player
                                 WHERE name = ?
                                 LIMIT 1";
        $Parametres_Verification_Liberte = $Connexion->prepare($Verification_Liberte);
        $Parametres_Verification_Liberte->execute(array(
            $Suppression_Perssonage_Procedure_Nouveau_Nom));
        $Parametres_Verification_Liberte->setFetchMode(PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Verification_Liberte = $Parametres_Verification_Liberte->rowCount();
        /* -------------------------------------------------------------------------- */
        if ($Nombre_De_Resultat_Verification_Liberte == 0) {

            if ($_SESSION['VamoNaies'] >= 1500) {

                /* ----------------- Update Name --------------------- */
                $Update_Name = "UPDATE $BDD_Player.player 
                            SET player.name = ? 
                            WHERE player.id = ?
                            LIMIT 1";

                $Parametres_Update_Name = $Connexion->prepare($Update_Name);
                $Parametres_Update_Name->execute(array(
                    $Suppression_Perssonage_Procedure_Nouveau_Nom,
                    $Suppression_Perssonage_Procedure_ID_Personnage));
                /* ----------------------------------------------------------- */

                /* ------------------------------------- Insertion Logs Changement Mail ---------------------------------- */
                $Insertion_Changement_Mot_De_Passe = "INSERT $BDD_Site.logs_rename (id_compte, ancien_nom, nouveau_nom, date, ip) 
                                          VALUES (:id_compte, :ancien_nom, :nouveau_nom, NOW(), :ip)";

                $Parametres_Insertion_Changement_Mot_De_Passe = $Connexion->prepare($Insertion_Changement_Mot_De_Passe);
                $Parametres_Insertion_Changement_Mot_De_Passe->execute(array(
                    ':id_compte' => $_SESSION['ID'],
                    ':ancien_nom' => $Donnees_Verification_Donnees->name,
                    ':nouveau_nom' => $Suppression_Perssonage_Procedure_Nouveau_Nom,
                    ':ip' => $Connexion_Ip));
                /* -------------------------------------------------------------------------------------------------------- */


                /* ----------------- Update monnaies --------------------- */
                $Update_Monnaie = "UPDATE $BDD_Account.account 
                            SET account.cash = (account.cash-1500), account.mileage = (account.mileage+1500)
                            WHERE account.id = ?
                            LIMIT 1";

                $Parametres_Update_Monnaie = $Connexion->prepare($Update_Monnaie);
                $Parametres_Update_Monnaie->execute(array(
                    $_SESSION["ID"]));
                /* ----------------------------------------------------------- */

                $_SESSION['VamoNaies'] = ($_SESSION['VamoNaies'] - 1500);
                $_SESSION['TanaNaies'] = ($_SESSION['TanaNaies'] + 1500);
                ?>

                <?php

                $Tableau_Retour_Json = array(
                    'result' => "WIN",
                    'cash' => "1500",
                    'reasons' => "Personnage renommé avec succès."
                );
                ?>
                <?php

            } else {
                $Tableau_Retour_Json = array(
                    'result' => "FAIL",
                    'reasons' => "Vous n'avez pas assez de VamoNaies."
                );
            }
        } else {
            $Tableau_Retour_Json = array(
                'result' => "FAIL",
                'reasons' => "Ce nom est déjà pris."
            );
        }
    } else {
        $Tableau_Retour_Json = array(
            'result' => "FAIL",
            'reasons' => "Ce n'est pas votre personnage."
        );
    }
} else {
    $Tableau_Retour_Json = array(
        'result' => "FAIL",
        'reasons' => "Veuillez vous reconnectez."
    );
}
?>
<?php echo json_encode($Tableau_Retour_Json); ?>
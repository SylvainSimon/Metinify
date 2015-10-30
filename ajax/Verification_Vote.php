<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include '../configPDO.php'; ?>
<?php

if (!empty($_POST['id_site'])) {
    if (($_POST['id_site'] == "1") || ($_POST['id_site'] == "2")) {

        $Ip = $_SERVER['REMOTE_ADDR'];
        $Id_Site = $_POST['id_site'];
	 $Id_Compte = $_SESSION['ID'];

        $Verification_Vote = "SELECT id AS nombre
                      FROM $BDD_Site.votes_logs
                      WHERE votes_logs.date > (NOW() - INTERVAL 2 HOUR)
                      AND id_compte = ?
                      AND id_site_vote = ?
                      LIMIT 1";
        $Parametres_Verification_Vote = $Connexion->prepare($Verification_Vote);
        $Parametres_Verification_Vote->execute(array(
            $Id_Compte,
            $Id_Site));
        $Parametres_Verification_Vote->setFetchMode(PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Verification_Vote = $Parametres_Verification_Vote->rowCount();
        if ($Nombre_De_Resultat_Verification_Vote != 0) {
            echo "1";
        } else {

            $Recuperation_Site_Vote = "SELECT votes_liste_sites.lien_site_vote
                               FROM $BDD_Site.votes_liste_sites
                               WHERE id_site_vote = ?
                               LIMIT 1";
            $Parametres_Recuperation_Site_Vote = $Connexion->prepare($Recuperation_Site_Vote);
            $Parametres_Recuperation_Site_Vote->execute(array(
                $Id_Site));
            $Parametres_Recuperation_Site_Vote->setFetchMode(PDO::FETCH_OBJ);
            $Nombre_De_Resultat_Recuperation_Site_Vote = $Parametres_Recuperation_Site_Vote->rowCount();

            if ($Nombre_De_Resultat_Recuperation_Site_Vote != 0) {
                $Donnees_Recuperation_Site_Vote = $Parametres_Recuperation_Site_Vote->fetch();
                echo $Donnees_Recuperation_Site_Vote->lien_site_vote;
            }

            /* -------------------------------------------- Insertion logs ------------------------- */
            $Insertion_Logs = "INSERT INTO $BDD_Site.votes_logs (id_compte, date, ip, id_site_vote) 
                          VALUES (:id_compte, NOW(), :ip, :id_site_vote)";

            $Parametres_Insertion = $Connexion->prepare($Insertion_Logs);
            $Parametres_Insertion->execute(array(
                ':id_compte' => $_SESSION["ID"],
                ':ip' => $Ip,
                ':id_site_vote' => $Id_Site));
            /* -------------------------------------------------------------------------------------- */

            /* -------------------------- Update des VamoNaies ----------------------------- */
            $Update_Monnaies = "UPDATE $BDD_Account.account 
                        SET cash = cash + 20 
                        WHERE id = ?
                        LIMIT 1";

            $Parametres_Update_Monnaies = $Connexion->prepare($Update_Monnaies);
            $Parametres_Update_Monnaies->execute(array(
                $_SESSION["ID"]));
            /* ----------------------------------------------------------------------------- */

            $_SESSION['VamoNaies'] = ($_SESSION['VamoNaies'] + 20);
        }
    }
}
?>
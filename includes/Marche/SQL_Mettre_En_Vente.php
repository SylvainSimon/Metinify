<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include '../../configPDO.php'; ?>
<?php include '../../pages/Fonctions_Utiles.php'; ?>
<?php

if (is_numeric($_POST["prix"])) {

$ID_Personnage = $_POST["id_personnage"];
$Texte_Titre = $_POST["texte_titre"];
$Texte_Description = $_POST["texte_description"];
$Prix_Article = str_replace(" ", "", $_POST["prix"]);
$Id_Devise = $_POST["id_devise"];
$Connexion_Ip = $_SERVER['REMOTE_ADDR'];

    if (!empty($_SESSION["ID"])) {

        /* ------------------------ Vérification Données ---------------------------- */
        $Verification_Donnees = "SELECT player.name, player.id
                             FROM $BDD_Player.player
                             WHERE id = ?
                             AND account_id = ?
                             AND player.last_play <= (NOW() - INTERVAL 20 MINUTE)
							 AND player.id NOT IN(SELECT pid FROM player.guild_member)
                             LIMIT 1";
        $Parametres_Verification_Donnees = $Connexion->prepare($Verification_Donnees);
        $Parametres_Verification_Donnees->execute(array(
            $ID_Personnage,
            $_SESSION["ID"]));
        $Parametres_Verification_Donnees->setFetchMode(PDO::FETCH_OBJ);
        $Nombre_De_Resultat = $Parametres_Verification_Donnees->rowCount();
        /* -------------------------------------------------------------------------- */
        ?>

        <?php if ($Nombre_De_Resultat != 0) { ?>

            <?php

            /* ------------------------ Selection_Player_Index ---------------------------- */
            $Selection_Index = "SELECT *
                            FROM $BDD_Player.player_index
                            WHERE id = ?
                            LIMIT 1";
            $Parametres_Selection_Index = $Connexion->prepare($Selection_Index);
            $Parametres_Selection_Index->execute(array(
                $_SESSION["ID"]));
            $Parametres_Selection_Index->setFetchMode(PDO::FETCH_OBJ);
            $Donnees_Selection_Index = $Parametres_Selection_Index->fetch();
            /* -------------------------------------------------------------------------- */

            $PID = "";

            if ($Donnees_Selection_Index->pid1 == $ID_Personnage) {
                $PID = "1";
            } else if ($Donnees_Selection_Index->pid2 == $ID_Personnage) {
                $PID = "2";
            } else if ($Donnees_Selection_Index->pid3 == $ID_Personnage) {
                $PID = "3";
            } else if ($Donnees_Selection_Index->pid4 == $ID_Personnage) {
                $PID = "4";
            }
            if ($PID != "") {

                /* ----------------------------------------$Insertion_Marche_Personnage------------------------------------------ */
                $Insertion_Marche_Personnage = "INSERT $BDD_Site.marche_personnages (id_proprietaire, id_personnage, pid) 
                                            VALUES (:id_proprietaire, :id_personnage, :pid)";

                $Parametres_Insertion_Marche_Personnage = $Connexion->prepare($Insertion_Marche_Personnage);
                $Parametres_Insertion_Marche_Personnage->execute(array(
                    ':id_proprietaire' => $_SESSION["ID"],
                    ':id_personnage' => $ID_Personnage,
                    ':pid' => $PID));
                /* ------------------------------------------------------------------------------------------------------------ */

                $ID_Insertion_Marche_Personnage = $Connexion->lastInsertId();

                /* ----------------- Update Email --------------------- */
                $Detachement_Personnage = "UPDATE $BDD_Player.player_index 
                SET pid$PID = '9999999' 
                WHERE id = ?
                LIMIT 1";

                $Parametres_Detachement_Personnage = $Connexion->prepare($Detachement_Personnage);
                $Parametres_Detachement_Personnage->execute(array($_SESSION["ID"]));
                /* ----------------------------------------------------------- */

                /* ----------------- Update Email --------------------- */
                $Detachement_Player = "UPDATE $BDD_Player.player 
                SET account_id = '0' 
                WHERE id = ?
                LIMIT 1";

                $Parametres_Detachement_Player = $Connexion->prepare($Detachement_Player);
                $Parametres_Detachement_Player->execute(array($ID_Personnage));
                /* ----------------------------------------------------------- */

                /* ----------------------------------------$Insertion_Marche_Personnage------------------------------------------ */
                $Insertion_Article = "INSERT $BDD_Site.marche_articles (designation, description, categorie, identifiant_article, prix, devise, date_ajout, ip) 
                                            VALUES (:designation, :description, :categorie, :identifiant_article, :prix, :devise, NOW(), :ip)";

                $Parametres_Insertion_Article = $Connexion->prepare($Insertion_Article);
                $Parametres_Insertion_Article->execute(array(
                    ':designation' => $Texte_Titre,
                    ':description' => $Texte_Description,
                    ':categorie' => '1',
                    ':identifiant_article' => $ID_Insertion_Marche_Personnage,
                    ':prix' => $Prix_Article,
                    ':devise' => $Id_Devise,
                    ':ip' => $Connexion_Ip,
                ));
                /* ------------------------------------------------------------------------------------------------------------ */

                /* --------------------------- Insertion de l'item ---------------------------- */
                $Insertion_Logs_Marche = "INSERT INTO $BDD_Site.logs_marche_mise_en_vente (id_compte, id_personnage, prix, devise, date, ip) 
                              VALUES (:id_compte, :id_personnage, :prix, :devise, NOW(), :ip)";

                $Parametres_Insertion_Logs_Marche = $Connexion->prepare($Insertion_Logs_Marche);
                $Parametres_Insertion_Logs_Marche->execute(array(
                    ':id_compte' => $_SESSION["ID"],
                    ':id_personnage' => $ID_Personnage,
                    ':prix' => $Prix_Article,
                    ':devise' => $Id_Devise,
                    ':ip' => $Connexion_Ip));
                /* ---------------------------------------------------------------------------- */

                $Tableau_Retour_Json = array(
                    'result' => "WIN",
                    'reasons' => ""
                );
            } else {
                $Tableau_Retour_Json = array(
                    'result' => "FAIL",
                    'reasons' => "Ce personnage n'existe pas."
                );
            }
            ?>

        <?php } else { ?>
            <?php

            $Tableau_Retour_Json = array(
                'result' => "FAIL",
                'reasons' => "Le perso ne doit pas avoir de guilde et rester déco 10 minutes."
            );
            ?>
        <?php } ?>
    <?php } else { ?>
        <?php

        $Tableau_Retour_Json = array(
            'result' => "FAIL",
            'reasons' => "Vous n'êtes pas connecter."
        );
        ?>
    <?php } ?>
<?php } else { ?>
    <?php

    $Tableau_Retour_Json = array(
        'result' => "FAIL",
        'reasons' => "Vous n'avez pas indiquer un chiffre."
    );
    ?>
<?php } ?>

<?php echo json_encode($Tableau_Retour_Json); ?>


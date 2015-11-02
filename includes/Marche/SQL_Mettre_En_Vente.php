<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class SQL_Mettre_En_Vente extends \PageHelper {

    public function run() {
        ?>
        <?php include '../../pages/Fonctions_Utiles.php'; ?>
        <?php

        if (is_numeric($_POST["prix"])) {

            $ID_Personnage = $_POST["id_personnage"];
            $Texte_Titre = $_POST["texte_titre"];
            $Texte_Description = $_POST["texte_description"];
            $Prix_Article = str_replace(" ", "", $_POST["prix"]);
            $Id_Devise = $_POST["id_devise"];
            $this->objConnection_Ip = $_SERVER['REMOTE_ADDR'];

            if (!empty($_SESSION["ID"])) {

                /* ------------------------ Vérification Données ---------------------------- */
                $Verification_Donnees = "SELECT player.name, player.id
                             FROM player.player
                             WHERE id = ?
                             AND account_id = ?
                             AND player.last_play <= (NOW() - INTERVAL 20 MINUTE)
							 AND player.id NOT IN(SELECT pid FROM player.guild_member)
                             LIMIT 1";
                $Parametres_Verification_Donnees = $this->objConnection->prepare($Verification_Donnees);
                $Parametres_Verification_Donnees->execute(array(
                    $ID_Personnage,
                    $_SESSION["ID"]));
                $Parametres_Verification_Donnees->setFetchMode(\PDO::FETCH_OBJ);
                $Nombre_De_Resultat = $Parametres_Verification_Donnees->rowCount();
                /* -------------------------------------------------------------------------- */
                ?>

                <?php if ($Nombre_De_Resultat != 0) { ?>

                    <?php

                    /* ------------------------ Selection_Player_Index ---------------------------- */
                    $Selection_Index = "SELECT *
                            FROM player.player_index
                            WHERE id = ?
                            LIMIT 1";
                    $Parametres_Selection_Index = $this->objConnection->prepare($Selection_Index);
                    $Parametres_Selection_Index->execute(array(
                        $_SESSION["ID"]));
                    $Parametres_Selection_Index->setFetchMode(\PDO::FETCH_OBJ);
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
                        $Insertion_Marche_Personnage = "INSERT site.marche_personnages (id_proprietaire, id_personnage, pid) 
                                            VALUES (:id_proprietaire, :id_personnage, :pid)";

                        $Parametres_Insertion_Marche_Personnage = $this->objConnection->prepare($Insertion_Marche_Personnage);
                        $Parametres_Insertion_Marche_Personnage->execute(array(
                            ':id_proprietaire' => $_SESSION["ID"],
                            ':id_personnage' => $ID_Personnage,
                            ':pid' => $PID));
                        /* ------------------------------------------------------------------------------------------------------------ */

                        $ID_Insertion_Marche_Personnage = $this->objConnection->lastInsertId();

                        /* ----------------- Update Email --------------------- */
                        $Detachement_Personnage = "UPDATE player.player_index 
                SET pid$PID = '9999999' 
                WHERE id = ?
                LIMIT 1";

                        $Parametres_Detachement_Personnage = $this->objConnection->prepare($Detachement_Personnage);
                        $Parametres_Detachement_Personnage->execute(array($_SESSION["ID"]));
                        /* ----------------------------------------------------------- */

                        /* ----------------- Update Email --------------------- */
                        $Detachement_Player = "UPDATE player.player 
                SET account_id = '0' 
                WHERE id = ?
                LIMIT 1";

                        $Parametres_Detachement_Player = $this->objConnection->prepare($Detachement_Player);
                        $Parametres_Detachement_Player->execute(array($ID_Personnage));
                        /* ----------------------------------------------------------- */

                        /* ----------------------------------------$Insertion_Marche_Personnage------------------------------------------ */
                        $Insertion_Article = "INSERT site.marche_articles (designation, description, categorie, identifiant_article, prix, devise, date_ajout, ip) 
                                            VALUES (:designation, :description, :categorie, :identifiant_article, :prix, :devise, NOW(), :ip)";

                        $Parametres_Insertion_Article = $this->objConnection->prepare($Insertion_Article);
                        $Parametres_Insertion_Article->execute(array(
                            ':designation' => $Texte_Titre,
                            ':description' => $Texte_Description,
                            ':categorie' => '1',
                            ':identifiant_article' => $ID_Insertion_Marche_Personnage,
                            ':prix' => $Prix_Article,
                            ':devise' => $Id_Devise,
                            ':ip' => $this->objConnection_Ip,
                        ));
                        /* ------------------------------------------------------------------------------------------------------------ */

                        /* --------------------------- Insertion de l'item ---------------------------- */
                        $Insertion_Logs_Marche = "INSERT INTO site.logs_marche_mise_en_vente (id_compte, id_personnage, prix, devise, date, ip) 
                              VALUES (:id_compte, :id_personnage, :prix, :devise, NOW(), :ip)";

                        $Parametres_Insertion_Logs_Marche = $this->objConnection->prepare($Insertion_Logs_Marche);
                        $Parametres_Insertion_Logs_Marche->execute(array(
                            ':id_compte' => $_SESSION["ID"],
                            ':id_personnage' => $ID_Personnage,
                            ':prix' => $Prix_Article,
                            ':devise' => $Id_Devise,
                            ':ip' => $this->objConnection_Ip));
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

        <?php

    }

}

$class = new SQL_Mettre_En_Vente();
$class->run();

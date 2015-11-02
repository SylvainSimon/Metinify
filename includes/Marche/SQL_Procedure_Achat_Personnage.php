<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class SQL_Procedure_Achat_Personnage extends \PageHelper {

    public function run() {
        ?>
        <?php include '../../pages/Fonctions_Utiles.php'; ?>
        <?php

        if (!empty($_SESSION["ID"])) {
            $ID_Marche_Personnage = $_POST["id_marche_personnage"];

            /* -------------------- Recuperation_Marche_Personnage ---------------------- */
            $Recuperation_Marche_Personnage = "SELECT *
                                       FROM site.marche_personnages
                                       WHERE id = ?
                                       LIMIT 1";
            $Parametres_Recuperation_Marche_Personnage = $this->objConnection->prepare($Recuperation_Marche_Personnage);
            $Parametres_Recuperation_Marche_Personnage->execute(array(
                $ID_Marche_Personnage));
            $Parametres_Recuperation_Marche_Personnage->setFetchMode(\PDO::FETCH_OBJ);
            $Nombre_De_Resultat_Recuperation_Marche_Personnage = $Parametres_Recuperation_Marche_Personnage->rowCount();
            /* -------------------------------------------------------------------------- */
            ?>
            <?php if ($Nombre_De_Resultat_Recuperation_Marche_Personnage != 0) { ?>
                <?php $Donnees_Recuperation_Marche_Personnage = $Parametres_Recuperation_Marche_Personnage->fetch(); ?>
                <?php

                $ID_Proprietaire = $Donnees_Recuperation_Marche_Personnage->id_proprietaire;
                $ID_Personnage = $Donnees_Recuperation_Marche_Personnage->id_personnage;
                $PID_Emplacement_Vendeur = "pid" . $Donnees_Recuperation_Marche_Personnage->pid;
                ?>

                <?php

                /* -------------------- $Recuperation_Monnaies ------------------------------ */
                $Recuperation_Monnaies = "SELECT *
                                  FROM account.account
                                  WHERE id = ?
                                  LIMIT 1";
                $Parametres_Recuperation_Monnaies = $this->objConnection->prepare($Recuperation_Monnaies);
                $Parametres_Recuperation_Monnaies->execute(array(
                    $_SESSION["ID"]));
                $Parametres_Recuperation_Monnaies->setFetchMode(\PDO::FETCH_OBJ);
                $Donnees_Recuperation_Monnaies = $Parametres_Recuperation_Monnaies->fetch();
                /* -------------------------------------------------------------------------- */
                ?>
                <?php

                $Nombre_Vamonnaies = $Donnees_Recuperation_Monnaies->cash;
                $Nombre_Tananaies = $Donnees_Recuperation_Monnaies->mileage;
                ?>

                <?php

                /* -------------------- $Recuperation_Article ------------------------------ */
                $Recuperation_Article = "SELECT *
                                  FROM site.marche_articles
                                  WHERE identifiant_article = ?
                                  LIMIT 1";
                $Parametres_Recuperation_Article = $this->objConnection->prepare($Recuperation_Article);
                $Parametres_Recuperation_Article->execute(array(
                    $ID_Marche_Personnage));
                $Parametres_Recuperation_Article->setFetchMode(\PDO::FETCH_OBJ);
                $Nombre_De_Resultat_Recuperation_Article = $Parametres_Recuperation_Article->rowCount();
                /* -------------------------------------------------------------------------- */
                ?>
                <?php if ($Nombre_De_Resultat_Recuperation_Article != 0) { ?>
                    <?php $Donnees_Recuperation_Article = $Parametres_Recuperation_Article->fetch(); ?>
                    <?php

                    $Prix_Article = $Donnees_Recuperation_Article->prix;
                    $Devise_Prix = $Donnees_Recuperation_Article->devise;
                    ?>

                    <?php

                    $Resultat_Comparaison_Prix = "0";

                    if ($Devise_Prix == 1) {

                        if ($Nombre_Vamonnaies >= $Prix_Article) {
                            $Resultat_Comparaison_Prix = "1";
                        } else {
                            $Resultat_Comparaison_Prix = "0";
                        }
                    } else if ($Devise_Prix == 2) {

                        if ($Nombre_Tananaies >= $Prix_Article) {
                            $Resultat_Comparaison_Prix = "1";
                        } else {
                            $Resultat_Comparaison_Prix = "0";
                        }
                    }
                    ?>

                    <?php if ($Resultat_Comparaison_Prix == "1") { ?>

                        <?php

                        $PID_Emplacement_Disponible = "";

                        /* ------------------------ Vérification Emplacement ---------------------------- */
                        $Verification_Emplacement = "SELECT *
                                             FROM player.player_index
                                             WHERE id = ?
                                             LIMIT 1";
                        $Parametres_Verification_Emplacement = $this->objConnection->prepare($Verification_Emplacement);
                        $Parametres_Verification_Emplacement->execute(array($_SESSION["ID"]));
                        $Parametres_Verification_Emplacement->setFetchMode(\PDO::FETCH_OBJ);
                        $Nombre_De_Resultat_Verification_Emplacement = $Parametres_Verification_Emplacement->rowCount();
                        ?>

                        <?php if ($Nombre_De_Resultat_Verification_Emplacement != 0) { ?>
                            <?php $Donnees_Verification_Emplacement = $Parametres_Verification_Emplacement->fetch(); ?>

                            <?php

                            if ($Donnees_Verification_Emplacement->pid1 == "0") {
                                $PID_Emplacement_Disponible = "pid1";
                            } else if ($Donnees_Verification_Emplacement->pid2 == "0") {
                                $PID_Emplacement_Disponible = "pid2";
                            } else if ($Donnees_Verification_Emplacement->pid3 == "0") {
                                $PID_Emplacement_Disponible = "pid3";
                            } else if ($Donnees_Verification_Emplacement->pid4 == "0") {
                                $PID_Emplacement_Disponible = "pid4";
                            }
                            ?>

                            <?php if ($PID_Emplacement_Disponible != "") { ?>

                                <?php

                                /* --------------------------- $Suppression_Article ---------------------------- */
                                $Suppression_Article = "DELETE 
                                                FROM site.marche_articles
                                                WHERE identifiant_article = :id_marche_article";

                                $Parametres_Suppression_Article = $this->objConnection->prepare($Suppression_Article);
                                $Parametres_Suppression_Article->execute(
                                        array(
                                            ':id_marche_article' => $ID_Marche_Personnage
                                        )
                                );
                                $Nombre_De_Ligne_Supprimes = $Parametres_Suppression_Article->rowCount();
                                /* --------------------------------------------------------------------------------- */
                                ?>

                                <?php if ($Nombre_De_Ligne_Supprimes != 0) { ?>

                                    <?php if ($Devise_Prix == 1) { ?>
                                        <?php

                                        /* ----------------- $Update_Monnaies_Vendeur  --------------------- */
                                        $Update_Monnaies_Vendeur = "UPDATE account.account
                                          SET cash = (cash + $Prix_Article)
                                          WHERE id = ?
                                          LIMIT 1";

                                        $Parametres_Update_Monnaies_Vendeur = $this->objConnection->prepare($Update_Monnaies_Vendeur);
                                        $Parametres_Update_Monnaies_Vendeur->execute(array(
                                            $ID_Proprietaire
                                        ));
                                        /* ----------------------------------------------------------- */

                                        /* ----------------- Update Monnaies Acheteur  --------------------- */
                                        $Update_Monnaies_Acheteur = "UPDATE account.account
                                          SET cash = (cash - $Prix_Article)
                                          WHERE id = ?
                                          LIMIT 1";

                                        $Parametres_Update_Monnaies_Acheteur = $this->objConnection->prepare($Update_Monnaies_Acheteur);
                                        $Parametres_Update_Monnaies_Acheteur->execute(array(
                                            $_SESSION["ID"]
                                        ));
                                        /* ----------------------------------------------------------- */
                                        ?>
                                    <?php } else if ($Devise_Prix == 2) { ?>
                                        <?php

                                        /* ----------------- $Update_Monnaies_Vendeur  --------------------- */
                                        $Update_Monnaies_Vendeur = "UPDATE account.account
                                          SET mileage = (mileage + $Prix_Article)
                                          WHERE id = ?
                                          LIMIT 1";

                                        $Parametres_Update_Monnaies_Vendeur = $this->objConnection->prepare($Update_Monnaies_Vendeur);
                                        $Parametres_Update_Monnaies_Vendeur->execute(array(
                                            $ID_Proprietaire
                                        ));
                                        /* ----------------------------------------------------------- */

                                        /* ----------------- Update Monnaies Acheteur  --------------------- */
                                        $Update_Monnaies_Acheteur = "UPDATE account.account
                                          SET mileage = (mileage - $Prix_Article)
                                          WHERE id = ?
                                          LIMIT 1";

                                        $Parametres_Update_Monnaies_Acheteur = $this->objConnection->prepare($Update_Monnaies_Acheteur);
                                        $Parametres_Update_Monnaies_Acheteur->execute(array(
                                            $_SESSION["ID"]
                                        ));
                                        /* ----------------------------------------------------------- */
                                        ?>
                                    <?php } ?>

                                    <?php if ($Devise_Prix == 1) { ?>

                                        <?php $_SESSION['VamoNaies'] = ($_SESSION['VamoNaies'] - ($Prix_Article)); ?> 
                                    <?php } else if ($Devise_Prix == 2) { ?>
                                        <?php $_SESSION['TanaNaies'] = ($_SESSION['TanaNaies'] - ($Prix_Article)); ?> 
                                    <?php } ?>

                                    <?php

                                    $this->objConnection_Ip = $_SERVER['REMOTE_ADDR'];
                                    /* --------------------------- Insertion de l'item ---------------------------- */
                                    $Insertion_Logs = "INSERT INTO site.log_achats (id_compte, compte, vnum_item, item, quantite, prix, monnaie, date, ip, resultat) 
                              VALUES (:id_compte, :compte, :vnum_item, :item, :quantite, :prix, :monnaie, NOW(), :ip, :resultat)";

                                    $Parametres_Insertion = $this->objConnection->prepare($Insertion_Logs);
                                    $Parametres_Insertion->execute(array(
                                        ':id_compte' => $_SESSION['ID'],
                                        ':compte' => $_SESSION['Utilisateur'],
                                        ':vnum_item' => '999999999',
                                        ':item' => 'Personnage',
                                        ':quantite' => '1',
                                        ':prix' => $Prix_Article,
                                        ':monnaie' => $Devise_Prix,
                                        ':ip' => $this->objConnection_Ip,
                                        ':resultat' => 'Réussi'));
                                    /* ---------------------------------------------------------------------------- */

                                    /* --------------------------- Insertion de l'item ---------------------------- */
                                    $Insertion_Logs_Marche = "INSERT INTO site.logs_marche_achats (id_vendeur, id_acheteur, id_personnage, prix, devise, date, ip) 
                              VALUES (:id_vendeur, :id_acheteur, :id_personnage, :prix, :devise, NOW(), :ip)";

                                    $Parametres_Insertion_Logs_Marche = $this->objConnection->prepare($Insertion_Logs_Marche);
                                    $Parametres_Insertion_Logs_Marche->execute(array(
                                        ':id_vendeur' => $ID_Proprietaire,
                                        ':id_acheteur' => $_SESSION["ID"],
                                        ':id_personnage' => $ID_Personnage,
                                        ':prix' => $Prix_Article,
                                        ':devise' => $Devise_Prix,
                                        ':ip' => $this->objConnection_Ip));
                                    /* ---------------------------------------------------------------------------- */
                                    ?>

                                    <?php

                                    /* ----------------- $Update_Player_Index_Acheteur --------------------- */
                                    $Update_Player_Index_Acheteur = "UPDATE player.player_index 
                                                             SET $PID_Emplacement_Disponible = ?
                                                             WHERE id = ?
                                                             LIMIT 1";

                                    $Parametres_Update_Player_Index_Acheteur = $this->objConnection->prepare($Update_Player_Index_Acheteur);
                                    $Parametres_Update_Player_Index_Acheteur->execute(array(
                                        $ID_Personnage,
                                        $_SESSION["ID"]
                                    ));
                                    /* ----------------------------------------------------------- */

                                    /* ----------------- $Update_Player_Index_Vendeur --------------------- */
                                    $Update_Player_Index_Vendeur = "UPDATE player.player_index 
                                                            SET $PID_Emplacement_Vendeur = '0'
                                                            WHERE id = ?
                                                            LIMIT 1";

                                    $Parametres_Update_Player_Index_Vendeur = $this->objConnection->prepare($Update_Player_Index_Vendeur);
                                    $Parametres_Update_Player_Index_Vendeur->execute(array(
                                        $ID_Proprietaire
                                    ));
                                    /* ----------------------------------------------------------- */

                                    /* ----------------- $Update_Player --------------------- */
                                    $Update_Player = "UPDATE player.player
                                              SET account_id = ?
                                              WHERE id = ?
                                              LIMIT 1";

                                    $Parametres_Update_Player = $this->objConnection->prepare($Update_Player);
                                    $Parametres_Update_Player->execute(array(
                                        $_SESSION["ID"],
                                        $ID_Personnage
                                    ));
                                    /* ----------------------------------------------------------- */
                                    ?>

                                    <?php

                                    /* --------------------------- Suppression Article ---------------------------- */
                                    $Suppression_Table_Personnage = "DELETE 
                                                             FROM site.marche_personnages
                                                             WHERE marche_personnages.id = :id_marche_article";

                                    $Parametres_Suppression_Table_Personnage = $this->objConnection->prepare($Suppression_Table_Personnage);
                                    $Parametres_Suppression_Table_Personnage->execute(
                                            array(
                                                ':id_marche_article' => $ID_Marche_Personnage
                                            )
                                    );
                                    /* --------------------------------------------------------------------------------- */
                                    ?>

                                    <?php

                                    $Tableau_Retour_Json = array(
                                        'result' => "WIN",
                                        'reasons' => ""
                                    );
                                    ?>

                                <?php } else { ?>
                                    <?php

                                    $Tableau_Retour_Json = array(
                                        'result' => "FAIL",
                                        'reasons' => "L'article a déjà été acheter."
                                    );
                                    ?>
                                <?php } ?>

                            <?php } else { ?>
                                <?php

                                $Tableau_Retour_Json = array(
                                    'result' => "FAIL",
                                    'reasons' => "Vous n'avez aucun emplacement libre."
                                );
                                ?>
                            <?php } ?>

                        <?php } else { ?>
                            <?php

                            $Tableau_Retour_Json = array(
                                'result' => "FAIL",
                                'reasons' => "Votre compte n'existe pas."
                            );
                            ?>
                        <?php } ?>

                    <?php } else { ?>
                        <?php

                        $Tableau_Retour_Json = array(
                            'result' => "FAIL",
                            'reasons' => "Vous n'avez pas assez de monnaies."
                        );
                        ?>
                    <?php } ?>

                <?php } else { ?>
                    <?php

                    $Tableau_Retour_Json = array(
                        'result' => "FAIL",
                        'reasons' => "L'article n'existe plus."
                    );
                    ?>
                <?php } ?>

            <?php } else { ?>
                <?php

                $Tableau_Retour_Json = array(
                    'result' => "FAIL",
                    'reasons' => "Ce personnage n'est pas en vente."
                );
                ?>
            <?php } ?>
        <?php } else { ?>
            <?php

            $Tableau_Retour_Json = array(
                'result' => "FAIL",
                'reasons' => "Vous n'êtes plus connecté."
            );
            ?>
        <?php } ?>
        <?php echo json_encode($Tableau_Retour_Json); ?>
        <?php

    }

}

$class = new SQL_Procedure_Achat_Personnage();
$class->run();

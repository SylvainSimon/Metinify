<?php

namespace Pages\Marche\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class SQL_Procedure_Achat_Personnage extends \ScriptHelper {

    public $isProtected = true;

    public function run() {

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

        if ($Nombre_De_Resultat_Recuperation_Marche_Personnage != 0) {
            $Donnees_Recuperation_Marche_Personnage = $Parametres_Recuperation_Marche_Personnage->fetch();


            $ID_Proprietaire = $Donnees_Recuperation_Marche_Personnage->id_proprietaire;
            $ID_Personnage = $Donnees_Recuperation_Marche_Personnage->id_personnage;
            $PID_Emplacement_Vendeur = "pid" . $Donnees_Recuperation_Marche_Personnage->pid;


            /* -------------------- $Recuperation_Monnaies ------------------------------ */
            $Recuperation_Monnaies = "SELECT *
                                  FROM account.account
                                  WHERE id = ?
                                  LIMIT 1";
            $Parametres_Recuperation_Monnaies = $this->objConnection->prepare($Recuperation_Monnaies);
            $Parametres_Recuperation_Monnaies->execute(array(
                $this->objAccount->getId()));
            $Parametres_Recuperation_Monnaies->setFetchMode(\PDO::FETCH_OBJ);
            $Donnees_Recuperation_Monnaies = $Parametres_Recuperation_Monnaies->fetch();
            /* -------------------------------------------------------------------------- */

            $Nombre_Vamonnaies = $Donnees_Recuperation_Monnaies->cash;
            $Nombre_Tananaies = $Donnees_Recuperation_Monnaies->mileage;

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

            if ($Nombre_De_Resultat_Recuperation_Article != 0) {
                $Donnees_Recuperation_Article = $Parametres_Recuperation_Article->fetch();


                $Prix_Article = $Donnees_Recuperation_Article->prix;
                $Devise_Prix = $Donnees_Recuperation_Article->devise;


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

                if ($Resultat_Comparaison_Prix == "1") {


                    $PID_Emplacement_Disponible = "";

                    /* ------------------------ Vérification Emplacement ---------------------------- */
                    $Verification_Emplacement = "SELECT *
                                             FROM player.player_index
                                             WHERE id = ?
                                             LIMIT 1";
                    $Parametres_Verification_Emplacement = $this->objConnection->prepare($Verification_Emplacement);
                    $Parametres_Verification_Emplacement->execute(array($this->objAccount->getId()));
                    $Parametres_Verification_Emplacement->setFetchMode(\PDO::FETCH_OBJ);
                    $Nombre_De_Resultat_Verification_Emplacement = $Parametres_Verification_Emplacement->rowCount();

                    if ($Nombre_De_Resultat_Verification_Emplacement != 0) {
                        $Donnees_Verification_Emplacement = $Parametres_Verification_Emplacement->fetch();


                        if ($Donnees_Verification_Emplacement->pid1 == "0") {
                            $PID_Emplacement_Disponible = "pid1";
                        } else if ($Donnees_Verification_Emplacement->pid2 == "0") {
                            $PID_Emplacement_Disponible = "pid2";
                        } else if ($Donnees_Verification_Emplacement->pid3 == "0") {
                            $PID_Emplacement_Disponible = "pid3";
                        } else if ($Donnees_Verification_Emplacement->pid4 == "0") {
                            $PID_Emplacement_Disponible = "pid4";
                        }
                        if ($PID_Emplacement_Disponible != "") {


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

                            if ($Nombre_De_Ligne_Supprimes != 0) {
                                if ($Devise_Prix == 1) {


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
                                        $this->objAccount->getId()
                                    ));
                                    /* ----------------------------------------------------------- */
                                } else if ($Devise_Prix == 2) {


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
                                        $this->objAccount->getId()
                                    ));
                                    /* ----------------------------------------------------------- */
                                }
                                if ($Devise_Prix == 1) {
                                    $_SESSION['VamoNaies'] = ($_SESSION['VamoNaies'] - ($Prix_Article));
                                } else if ($Devise_Prix == 2) {
                                    $_SESSION['TanaNaies'] = ($_SESSION['TanaNaies'] - ($Prix_Article));
                                }


                                $this->objConnection_Ip = $_SERVER['REMOTE_ADDR'];
                                /* --------------------------- Insertion de l'item ---------------------------- */
                                $Insertion_Logs = "INSERT INTO site.log_achats (id_compte, compte, vnum_item, item, quantite, prix, monnaie, date, ip, resultat) 
                              VALUES (:id_compte, :compte, :vnum_item, :item, :quantite, :prix, :monnaie, NOW(), :ip, :resultat)";

                                $Parametres_Insertion = $this->objConnection->prepare($Insertion_Logs);
                                $Parametres_Insertion->execute(array(
                                    ':id_compte' => $this->objAccount->getId(),
                                    ':compte' => $this->objAccount->getLogin(),
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
                                    ':id_acheteur' => $this->objAccount->getId(),
                                    ':id_personnage' => $ID_Personnage,
                                    ':prix' => $Prix_Article,
                                    ':devise' => $Devise_Prix,
                                    ':ip' => $this->objConnection_Ip));
                                /* ---------------------------------------------------------------------------- */


                                /* ----------------- $Update_Player_Index_Acheteur --------------------- */
                                $Update_Player_Index_Acheteur = "UPDATE player.player_index 
                                                             SET $PID_Emplacement_Disponible = ?
                                                             WHERE id = ?
                                                             LIMIT 1";

                                $Parametres_Update_Player_Index_Acheteur = $this->objConnection->prepare($Update_Player_Index_Acheteur);
                                $Parametres_Update_Player_Index_Acheteur->execute(array(
                                    $ID_Personnage,
                                    $this->objAccount->getId()
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
                                    $this->objAccount->getId(),
                                    $ID_Personnage
                                ));
                                /* ----------------------------------------------------------- */


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


                                $Tableau_Retour_Json = array(
                                    'result' => "WIN",
                                    'reasons' => ""
                                );
                            } else {


                                $Tableau_Retour_Json = array(
                                    'result' => "FAIL",
                                    'reasons' => "L'article a déjà été acheter."
                                );
                            }
                        } else {
                            
                        }
                    } else {
                        $Tableau_Retour_Json = array(
                            'result' => "FAIL",
                            'reasons' => "Votre compte n'existe pas."
                        );
                    }
                } else {


                    $Tableau_Retour_Json = array(
                        'result' => "FAIL",
                        'reasons' => "Vous n'avez pas assez de monnaies."
                    );
                }
            } else {


                $Tableau_Retour_Json = array(
                    'result' => "FAIL",
                    'reasons' => "L'article n'existe plus."
                );
            }
        } else {


            $Tableau_Retour_Json = array(
                'result' => "FAIL",
                'reasons' => "Ce personnage n'est pas en vente."
            );
        }
        echo json_encode($Tableau_Retour_Json);
    }

}

$class = new SQL_Procedure_Achat_Personnage();
$class->run();

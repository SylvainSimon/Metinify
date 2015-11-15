<?php

namespace Pages\Marche\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class SQL_Mettre_En_Vente extends \ScriptHelper {

    public $isProtected = true;

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $playerId = $request->request->get("id_personnage");
        $titre = $request->request->get("texte_titre");
        $description = $request->request->get("texte_description");
        $prix = trim($request->request->get("prix"));
        $idDevise = $request->request->get("id_devise");

        if (is_numeric($prix)) {

            $objPlayer = parent::VerifMonJoueur($playerId);
            
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
                $playerId,
                $this->objAccount->getId()));
            $Parametres_Verification_Donnees->setFetchMode(\PDO::FETCH_OBJ);
            $Nombre_De_Resultat = $Parametres_Verification_Donnees->rowCount();
            /* -------------------------------------------------------------------------- */

            if ($Nombre_De_Resultat != 0) {

                /* ------------------------ Selection_Player_Index ---------------------------- */
                $Selection_Index = "SELECT *
                            FROM player.player_index
                            WHERE id = ?
                            LIMIT 1";
                $Parametres_Selection_Index = $this->objConnection->prepare($Selection_Index);
                $Parametres_Selection_Index->execute(array(
                    $this->objAccount->getId()));
                $Parametres_Selection_Index->setFetchMode(\PDO::FETCH_OBJ);
                $Donnees_Selection_Index = $Parametres_Selection_Index->fetch();
                /* -------------------------------------------------------------------------- */

                $PID = "";

                if ($Donnees_Selection_Index->pid1 == $playerId) {
                    $PID = "1";
                } else if ($Donnees_Selection_Index->pid2 == $playerId) {
                    $PID = "2";
                } else if ($Donnees_Selection_Index->pid3 == $playerId) {
                    $PID = "3";
                } else if ($Donnees_Selection_Index->pid4 == $playerId) {
                    $PID = "4";
                }
                if ($PID != "") {

                    /* ----------------------------------------$Insertion_Marche_Personnage------------------------------------------ */
                    $Insertion_Marche_Personnage = "INSERT site.marche_personnages (id_proprietaire, id_personnage, pid) 
                                            VALUES (:id_proprietaire, :id_personnage, :pid)";

                    $Parametres_Insertion_Marche_Personnage = $this->objConnection->prepare($Insertion_Marche_Personnage);
                    $Parametres_Insertion_Marche_Personnage->execute(array(
                        ':id_proprietaire' => $this->objAccount->getId(),
                        ':id_personnage' => $playerId,
                        ':pid' => $PID));
                    /* ------------------------------------------------------------------------------------------------------------ */

                    $ID_Insertion_Marche_Personnage = $this->objConnection->lastInsertId();

                    /* ----------------- Update Email --------------------- */
                    $Detachement_Personnage = "UPDATE player.player_index 
                SET pid$PID = '9999999' 
                WHERE id = ?
                LIMIT 1";

                    $Parametres_Detachement_Personnage = $this->objConnection->prepare($Detachement_Personnage);
                    $Parametres_Detachement_Personnage->execute(array($this->objAccount->getId()));
                    /* ----------------------------------------------------------- */

                    /* ----------------- Update Email --------------------- */
                    $Detachement_Player = "UPDATE player.player 
                SET account_id = '0' 
                WHERE id = ?
                LIMIT 1";

                    $Parametres_Detachement_Player = $this->objConnection->prepare($Detachement_Player);
                    $Parametres_Detachement_Player->execute(array($playerId));
                    /* ----------------------------------------------------------- */

                    /* ----------------------------------------$Insertion_Marche_Personnage------------------------------------------ */
                    $Insertion_Article = "INSERT site.marche_articles (designation, description, categorie, identifiant_article, prix, devise, date_ajout, ip) 
                                            VALUES (:designation, :description, :categorie, :identifiant_article, :prix, :devise, NOW(), :ip)";

                    $Parametres_Insertion_Article = $this->objConnection->prepare($Insertion_Article);
                    $Parametres_Insertion_Article->execute(array(
                        ':designation' => $titre,
                        ':description' => $description,
                        ':categorie' => '1',
                        ':identifiant_article' => $ID_Insertion_Marche_Personnage,
                        ':prix' => $prix,
                        ':devise' => $idDevise,
                        ':ip' => $this->ipAdresse,
                    ));
                    /* ------------------------------------------------------------------------------------------------------------ */

                    /* --------------------------- Insertion de l'item ---------------------------- */
                    $Insertion_Logs_Marche = "INSERT INTO site.logs_marche_mise_en_vente (id_compte, id_personnage, prix, devise, date, ip) 
                              VALUES (:id_compte, :id_personnage, :prix, :devise, NOW(), :ip)";

                    $Parametres_Insertion_Logs_Marche = $this->objConnection->prepare($Insertion_Logs_Marche);
                    $Parametres_Insertion_Logs_Marche->execute(array(
                        ':id_compte' => $this->objAccount->getId(),
                        ':id_personnage' => $playerId,
                        ':prix' => $prix,
                        ':devise' => $idDevise,
                        ':ip' => $this->ipAdresse));
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
            } else {


                $Tableau_Retour_Json = array(
                    'result' => "FAIL",
                    'reasons' => "Le perso ne doit pas avoir de guilde et rester déco 10 minutes."
                );
            }
        } else {
            $Tableau_Retour_Json = array(
                'result' => "FAIL",
                'reasons' => "Vous n'avez pas indiquer un chiffre."
            );
        }
        echo json_encode($Tableau_Retour_Json);
    }

}

$class = new SQL_Mettre_En_Vente();
$class->run();

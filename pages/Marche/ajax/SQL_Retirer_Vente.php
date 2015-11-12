<?php

namespace Pages\Marche\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class SQL_Retirer_Vente extends \ScriptHelper {

    public $isProtected = true;

    public function run() {

        $ID_Marche_Personnage = $_POST["id_marche_personnage"];

        /* ------------------------ Vérification Données ---------------------------- */
        $Verification_Donnees = "SELECT id, id_personnage, pid
                             FROM site.marche_personnages
                             WHERE id_proprietaire = ?
                             AND id = ?
                             LIMIT 1";
        $Parametres_Verification_Donnees = $this->objConnection->prepare($Verification_Donnees);
        $Parametres_Verification_Donnees->execute(array(
            $this->objAccount->getId(),
            $ID_Marche_Personnage));
        $Parametres_Verification_Donnees->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat = $Parametres_Verification_Donnees->rowCount();
        /* -------------------------------------------------------------------------- */

        if ($Nombre_De_Resultat != 0) {


            $Donnees_Verification_Donnees = $Parametres_Verification_Donnees->fetch();

            $ID_Personnage = $Donnees_Verification_Donnees->id_personnage;
            $Emplacement_Personnage = $Donnees_Verification_Donnees->pid;

            /* ------------------------ Vérification Emplacement ---------------------------- */
            $Verification_Emplacement = "SELECT id
                                 FROM player.player_index
                                 WHERE pid$Emplacement_Personnage = 9999999
                                 AND id = ?
                                 LIMIT 1";
            $Parametres_Verification_Emplacement = $this->objConnection->prepare($Verification_Emplacement);
            $Parametres_Verification_Emplacement->execute(array($this->objAccount->getId()));
            $Parametres_Verification_Emplacement->setFetchMode(\PDO::FETCH_OBJ);
            $Nombre_De_Resultat_Verification_Emplacement = $Parametres_Verification_Emplacement->rowCount();
            /* -------------------------------------------------------------------------- */

            if ($Nombre_De_Resultat_Verification_Emplacement != 0) {


                /* ------------------------ Vérification Player ---------------------------- */
                $Verification_Player = "SELECT id
                                    FROM player.player
                                    WHERE account_id = 0
                                    AND id = ?
                                    LIMIT 1";
                $Parametres_Verification_Player = $this->objConnection->prepare($Verification_Player);
                $Parametres_Verification_Player->execute(array($ID_Personnage));
                $Parametres_Verification_Player->setFetchMode(\PDO::FETCH_OBJ);
                $Nombre_De_Resultat_Verification_Player = $Parametres_Verification_Player->rowCount();
                /* -------------------------------------------------------------------------- */

                if ($Nombre_De_Resultat_Verification_Player != 0) {


                    /* ----------------- Update Index --------------------- */
                    $Update_Player_Index = "UPDATE player.player_index 
                                       SET pid$Emplacement_Personnage = ?
                                       WHERE id = ?
                                       LIMIT 1";

                    $Parametres_Update_Player_Index = $this->objConnection->prepare($Update_Player_Index);
                    $Parametres_Update_Player_Index->execute(array(
                        $ID_Personnage,
                        $this->objAccount->getId()
                    ));
                    /* ----------------------------------------------------------- */

                    /* ----------------- Update Index --------------------- */
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
                    $Suppression_Article = "DELETE 
                                        FROM site.marche_articles
                                        WHERE identifiant_article = :id_marche_article";

                    $Parametres_Suppression_Article = $this->objConnection->prepare($Suppression_Article);
                    $Parametres_Suppression_Article->execute(
                            array(
                                ':id_marche_article' => $ID_Marche_Personnage
                            )
                    );
                    /* --------------------------------------------------------------------------------- */

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
                        'reasons' => "Le personnage est déja lié a un compte."
                    );
                }
            } else {


                $Tableau_Retour_Json = array(
                    'result' => "FAIL",
                    'reasons' => "L'emplacement original est occupé."
                );
            }
        } else {


            $Tableau_Retour_Json = array(
                'result' => "FAIL",
                'reasons' => "Ce personnage ne vous appartient pas."
            );
        }
        echo json_encode($Tableau_Retour_Json);
    }

}

$class = new SQL_Retirer_Vente();
$class->run();

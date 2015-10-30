<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include '../../configPDO.php'; ?>
<?php include '../../pages/Fonctions_Utiles.php'; ?>
<?php

if (!empty($_SESSION["ID"])) {
    $ID_Marche_Personnage = $_POST["id_marche_personnage"];

    /* ------------------------ Vérification Données ---------------------------- */
    $Verification_Donnees = "SELECT id, id_personnage, pid
                             FROM $BDD_Site.marche_personnages
                             WHERE id_proprietaire = ?
                             AND id = ?
                             LIMIT 1";
    $Parametres_Verification_Donnees = $Connexion->prepare($Verification_Donnees);
    $Parametres_Verification_Donnees->execute(array(
        $_SESSION["ID"],
        $ID_Marche_Personnage));
    $Parametres_Verification_Donnees->setFetchMode(PDO::FETCH_OBJ);
    $Nombre_De_Resultat = $Parametres_Verification_Donnees->rowCount();
    /* -------------------------------------------------------------------------- */
    ?>
    <?php if ($Nombre_De_Resultat != 0) { ?>
        <?php

        $Donnees_Verification_Donnees = $Parametres_Verification_Donnees->fetch();

        $ID_Personnage = $Donnees_Verification_Donnees->id_personnage;
        $Emplacement_Personnage = $Donnees_Verification_Donnees->pid;

        /* ------------------------ Vérification Emplacement ---------------------------- */
        $Verification_Emplacement = "SELECT id
                                 FROM $BDD_Player.player_index
                                 WHERE pid$Emplacement_Personnage = 9999999
                                 AND id = ?
                                 LIMIT 1";
        $Parametres_Verification_Emplacement = $Connexion->prepare($Verification_Emplacement);
        $Parametres_Verification_Emplacement->execute(array($_SESSION["ID"]));
        $Parametres_Verification_Emplacement->setFetchMode(PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Verification_Emplacement = $Parametres_Verification_Emplacement->rowCount();
        /* -------------------------------------------------------------------------- */
        ?>

        <?php if ($Nombre_De_Resultat_Verification_Emplacement != 0) { ?>
            <?php

            /* ------------------------ Vérification Player ---------------------------- */
            $Verification_Player = "SELECT id
                                    FROM $BDD_Player.player
                                    WHERE account_id = 0
                                    AND id = ?
                                    LIMIT 1";
            $Parametres_Verification_Player = $Connexion->prepare($Verification_Player);
            $Parametres_Verification_Player->execute(array($ID_Personnage));
            $Parametres_Verification_Player->setFetchMode(PDO::FETCH_OBJ);
            $Nombre_De_Resultat_Verification_Player = $Parametres_Verification_Player->rowCount();
            /* -------------------------------------------------------------------------- */
            ?>

            <?php if ($Nombre_De_Resultat_Verification_Player != 0) { ?>

                <?php

                /* ----------------- Update Index --------------------- */
                $Update_Player_Index = "UPDATE $BDD_Player.player_index 
                                       SET pid$Emplacement_Personnage = ?
                                       WHERE id = ?
                                       LIMIT 1";

                $Parametres_Update_Player_Index = $Connexion->prepare($Update_Player_Index);
                $Parametres_Update_Player_Index->execute(array(
                    $ID_Personnage,
                    $_SESSION["ID"]
                ));
                /* ----------------------------------------------------------- */

                /* ----------------- Update Index --------------------- */
                $Update_Player = "UPDATE $BDD_Player.player
                                       SET account_id = ?
                                       WHERE id = ?
                                       LIMIT 1";

                $Parametres_Update_Player = $Connexion->prepare($Update_Player);
                $Parametres_Update_Player->execute(array(
                    $_SESSION["ID"],
                    $ID_Personnage
                ));
                /* ----------------------------------------------------------- */

                /* --------------------------- Suppression Article ---------------------------- */
                $Suppression_Article = "DELETE 
                                        FROM $BDD_Site.marche_articles
                                        WHERE identifiant_article = :id_marche_article";

                $Parametres_Suppression_Article = $Connexion->prepare($Suppression_Article);
                $Parametres_Suppression_Article->execute(
                        array(
                            ':id_marche_article' => $ID_Marche_Personnage
                        )
                );
                /* --------------------------------------------------------------------------------- */

                /* --------------------------- Suppression Article ---------------------------- */
                $Suppression_Table_Personnage = "DELETE 
                                        FROM $BDD_Site.marche_personnages
                                        WHERE marche_personnages.id = :id_marche_article";

                $Parametres_Suppression_Table_Personnage = $Connexion->prepare($Suppression_Table_Personnage);
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
                    'reasons' => "Le personnage est déja lié a un compte."
                );
                ?>
            <?php } ?>
        <?php } else { ?>
            <?php

            $Tableau_Retour_Json = array(
                'result' => "FAIL",
                'reasons' => "L'emplacement original est occupé."
            );
            ?>
        <?php } ?>
    <?php } else { ?>
        <?php

        $Tableau_Retour_Json = array(
            'result' => "FAIL",
            'reasons' => "Ce personnage ne vous appartient pas."
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


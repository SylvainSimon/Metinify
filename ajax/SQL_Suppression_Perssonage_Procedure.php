<?php

namespace Ajax;

require __DIR__ . '../../core/initialize.php';

class SQL_Suppression_Perssonage_Procedure extends \PageHelper {

    public function run() {

        $Suppression_Perssonage_Procedure_ID_Compte = $_POST["id_compte"];
        $Suppression_Perssonage_Procedure_ID_Personnage = $_POST["id_personnage"];
        $Suppression_Perssonage_Procedure_Numero_Verif = $_POST["numero_verif"];
        $Ip = $_SERVER['REMOTE_ADDR'];

        /* ------------------------ Vérifications Expiration ------------------------------ */
        $Vérification_Expiration = "SELECT id
                            FROM site.suppression_personnage 
                            WHERE id_compte = :id_compte
                            AND id_personnage = :id_personnage
                            AND ip = :ip
                            AND date > (NOW() - INTERVAL 1 HOUR)
                            LIMIT 1";
        $Parametres_Vérification_Expiration = $this->objConnection->prepare($Vérification_Expiration);
        $Parametres_Vérification_Expiration->execute(
                array(
                    ':id_compte' => $Suppression_Perssonage_Procedure_ID_Compte,
                    ':id_personnage' => $Suppression_Perssonage_Procedure_ID_Personnage,
                    ':ip' => $Ip
                )
        );
        $Parametres_Vérification_Expiration->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Vérification_Expiration = $Parametres_Vérification_Expiration->rowCount();
        /* -------------------------------------------------------------------------- */
        ?>

        <?php if ($Nombre_De_Resultat_Vérification_Expiration != 0) { ?>

            <?php

            /* ------------------------ Vérifications Numéro ------------------------------ */
            $Vérification_Numero = "SELECT id
                            FROM site.suppression_personnage 
                            WHERE id_compte = :id_compte
                            AND id_personnage = :id_personnage
                            AND ip = :ip
                            AND numero_verif = :numero_verif
                            AND date > (NOW() - INTERVAL 1 HOUR)
                            LIMIT 1";
            $Parametres_Vérification_Numero = $this->objConnection->prepare($Vérification_Numero);
            $Parametres_Vérification_Numero->execute(
                    array(
                        ':id_compte' => $Suppression_Perssonage_Procedure_ID_Compte,
                        ':id_personnage' => $Suppression_Perssonage_Procedure_ID_Personnage,
                        ':ip' => $Ip,
                        ':numero_verif' => $Suppression_Perssonage_Procedure_Numero_Verif
                    )
            );
            $Parametres_Vérification_Numero->setFetchMode(\PDO::FETCH_OBJ);
            $Nombre_De_Resultat_Vérification_Numero = $Parametres_Vérification_Numero->rowCount();
            /* -------------------------------------------------------------------------- */
            ?>

            <?php if ($Nombre_De_Resultat_Vérification_Numero != 0) { ?>
                <?php $_SESSION["Verification_Suppression"] = 0; ?>

                <?php

                /* ------------------------ Verification Chef Guilde ----------------------- */
                $Verification_Chef_Guilde = "SELECT id
                                     FROM player.guild 
                                     WHERE master = :id_personnage
                                     LIMIT 1";
                $Parametres_Verification_Chef_Guilde = $this->objConnection->prepare($Verification_Chef_Guilde);
                $Parametres_Verification_Chef_Guilde->execute(
                        array(
                            ':id_personnage' => $Suppression_Perssonage_Procedure_ID_Personnage
                        )
                );
                $Parametres_Verification_Chef_Guilde->setFetchMode(\PDO::FETCH_OBJ);
                $Nombre_De_Resultat_Verification_Chef_Guilde = $Parametres_Verification_Chef_Guilde->rowCount();
                /* -------------------------------------------------------------------------- */
                ?>

                <?php if ($Nombre_De_Resultat_Verification_Chef_Guilde == 0) { ?>

                    <?php

                    /* ------------------------ Verification Membre Guilde ----------------------- */
                    $Verification_Membre_Guilde = "SELECT pid
                                           FROM player.guild_member 
                                           WHERE pid = :id_personnage
                                           LIMIT 1";
                    $Parametres_Verification_Membre_Guilde = $this->objConnection->prepare($Verification_Membre_Guilde);
                    $Parametres_Verification_Membre_Guilde->execute(
                            array(
                                ':id_personnage' => $Suppression_Perssonage_Procedure_ID_Personnage
                            )
                    );
                    $Parametres_Verification_Membre_Guilde->setFetchMode(\PDO::FETCH_OBJ);
                    $Nombre_De_Resultat_Verification_Membre_Guilde = $Parametres_Verification_Membre_Guilde->rowCount();
                    /* -------------------------------------------------------------------------- */
                    ?>

                    <?php if ($Nombre_De_Resultat_Verification_Membre_Guilde == 0) { ?>

                        <?php

                        /* ------------------------ Selection dans Player_Index ------------------------------ */
                        $Selection_Player_Index = "SELECT *
                                   FROM player.player_index 
                                   WHERE id = :id_compte
                                   LIMIT 1";
                        $Parametres_Selection_Player_Index = $this->objConnection->prepare($Selection_Player_Index);
                        $Parametres_Selection_Player_Index->execute(
                                array(
                                    ':id_compte' => $Suppression_Perssonage_Procedure_ID_Compte
                                )
                        );
                        $Parametres_Selection_Player_Index->setFetchMode(\PDO::FETCH_OBJ);
                        $Donnees_Selection_Player_Index = $Parametres_Selection_Player_Index->fetch();
                        /* -------------------------------------------------------------------------- */
                        ?>

                        <?php if ($Donnees_Selection_Player_Index->pid1 == $Suppression_Perssonage_Procedure_ID_Personnage) { ?>
                            <?php

                            /* ----------------- Update Player_Index --------------------- */
                            $Update_Player_Index = "UPDATE player.player_index SET pid1 = ? WHERE id = ? LIMIT 1";
                            /* ----------------------------------------------------------- */
                            ?>
                        <?php } else if ($Donnees_Selection_Player_Index->pid2 == $Suppression_Perssonage_Procedure_ID_Personnage) { ?>
                            <?php

                            /* ----------------- Update Player_Index --------------------- */
                            $Update_Player_Index = "UPDATE player.player_index SET pid2 = ? WHERE id = ? LIMIT 1";
                            /* ----------------------------------------------------------- */
                            ?>
                        <?php } else if ($Donnees_Selection_Player_Index->pid3 == $Suppression_Perssonage_Procedure_ID_Personnage) { ?>
                            <?php

                            /* ----------------- Update Player_Index --------------------- */
                            $Update_Player_Index = "UPDATE player.player_index SET pid3 = ? WHERE id = ? LIMIT 1";
                            /* ----------------------------------------------------------- */
                            ?>
                        <?php } else if ($Donnees_Selection_Player_Index->pid4 == $Suppression_Perssonage_Procedure_ID_Personnage) { ?>
                            <?php

                            /* ----------------- Update Player_Index --------------------- */
                            $Update_Player_Index = "UPDATE player.player_index SET pid4 = ? WHERE id = ? LIMIT 1";
                            /* ----------------------------------------------------------- */
                            ?>
                        <?php } ?>

                        <?php

                        $Parametres_Update_Player_Index = $this->objConnection->prepare($Update_Player_Index);
                        $Parametres_Update_Player_Index->execute(
                                array(
                                    "0",
                                    $Suppression_Perssonage_Procedure_ID_Compte
                                )
                        );
                        ?>

                        <?php

                        /* --------------------------- Suppression des mariés ---------------------------- */
                        $Delete_Maries = "DELETE 
                                  FROM player.marriage
                                  WHERE pid1 = :id_personnage
                                  OR pid2 = :id_personnage2";

                        $Parametres_Delete_Maries = $this->objConnection->prepare($Delete_Maries);
                        $Parametres_Delete_Maries->execute(
                                array(
                                    ':id_personnage' => $Suppression_Perssonage_Procedure_ID_Personnage,
                                    ':id_personnage2' => $Suppression_Perssonage_Procedure_ID_Personnage
                                )
                        );
                        /* --------------------------------------------------------------------------------- */
                        ?>

                        <?php

                        /* --------------------------- Suppression des items ---------------------------- */
                        $Delete_Items = "DELETE 
                                 FROM player.item
                                 WHERE owner_id = :id_personnage";

                        $Parametres_Delete_Items = $this->objConnection->prepare($Delete_Items);
                        $Parametres_Delete_Items->execute(
                                array(
                                    ':id_personnage' => $Suppression_Perssonage_Procedure_ID_Personnage
                                )
                        );
                        /* --------------------------------------------------------------------------------- */
                        ?>

                        <?php

                        /* ------------------------ Selection Name ------------------------------ */
                        $Selection_Name = "SELECT *
                                   FROM player.player 
                                   WHERE id = :id_personnage
                                   LIMIT 1";
                        $Parametres_Selection_Name = $this->objConnection->prepare($Selection_Name);
                        $Parametres_Selection_Name->execute(
                                array(
                                    ':id_personnage' => $Suppression_Perssonage_Procedure_ID_Personnage
                                )
                        );
                        $Parametres_Selection_Name->setFetchMode(\PDO::FETCH_OBJ);
                        $Donnees_Selection_Name = $Parametres_Selection_Name->fetch();
                        /* -------------------------------------------------------------------------- */


                        /* ------------------------------------- Insertion Player Deleted --------------------------------------- */
                        $Insertion_Player_Deleted = "INSERT INTO player.player_deleted 
                                             SELECT * FROM player.player
                                             WHERE player.id = ?";

                        $Parametres_Insertion_Player_Deleted = $this->objConnection->prepare($Insertion_Player_Deleted);
                        $Parametres_Insertion_Player_Deleted->execute(array(
                            $Suppression_Perssonage_Procedure_ID_Personnage));
                        /* -------------------------------------------------------------------------------------------------------- */


                        /* --------------------------- Suppression des amis ---------------------------- */
                        $Delete_Player = "DELETE 
                                 FROM player.player
                                 WHERE id = :id_personnage";

                        $Parametres_Delete_Player = $this->objConnection->prepare($Delete_Player);
                        $Parametres_Delete_Player->execute(
                                array(
                                    ':id_personnage' => $Suppression_Perssonage_Procedure_ID_Personnage
                                )
                        );
                        /* --------------------------------------------------------------------------------- */
                        ?>

                        <?php

                        /* --------------------------- Suppression des amis ---------------------------- */
                        $Delete_Amis = "DELETE 
                                 FROM player.messenger_list
                                 WHERE companion = :nom_personnage
                                 OR account = :nom_personnage2";

                        $Parametres_Delete_Amis = $this->objConnection->prepare($Delete_Amis);
                        $Parametres_Delete_Amis->execute(
                                array(
                                    ':nom_personnage' => $Donnees_Selection_Name->name,
                                    ':nom_personnage2' => $Donnees_Selection_Name->name
                                )
                        );
                        /* --------------------------------------------------------------------------------- */


                        /* -------------- Suppression autres demande ----------------------------------------------------- */
                        $Delete_Demande_Suppresion_Persos = "DELETE 
                                         FROM site.suppression_personnage
                                         WHERE id_personnage = :id_personnage";

                        $Parametres_Delete_Demande_Suppresion_Persos = $this->objConnection->prepare($Delete_Demande_Suppresion_Persos);
                        $Parametres_Delete_Demande_Suppresion_Persos->execute(
                                array(
                                    ':id_personnage' => $Suppression_Perssonage_Procedure_ID_Personnage
                                )
                        );
                        /* ------------------------------------------------------------------------------------------------ */
                        ?>

                        <?php

                        $Tableau_Retour_Json = array(
                            'result' => "WIN"
                        );
                        ?>

                    <?php } else { ?>
                        <?php

                        /* -------------- Suppression autres demande ----------------------------------------------------- */
                        $Delete_Demande_Suppresion_Persos = "DELETE 
                                                 FROM site.suppression_personnage
                                                 WHERE id_personnage = :id_personnage";

                        $Parametres_Delete_Demande_Suppresion_Persos = $this->objConnection->prepare($Delete_Demande_Suppresion_Persos);
                        $Parametres_Delete_Demande_Suppresion_Persos->execute(
                                array(
                                    ':id_personnage' => $Suppression_Perssonage_Procedure_ID_Personnage
                                )
                        );
                        /* ------------------------------------------------------------------------------------------------ */

                        $Tableau_Retour_Json = array(
                            'result' => "FAIL",
                            'reasons' => "Membre"
                        );
                        ?>
                    <?php } ?>

                <?php } else { ?>
                    <?php

                    /* -------------- Suppression autres demande ----------------------------------------------------- */
                    $Delete_Demande_Suppresion_Persos = "DELETE 
                                                 FROM site.suppression_personnage
                                                 WHERE id_personnage = :id_personnage";

                    $Parametres_Delete_Demande_Suppresion_Persos = $this->objConnection->prepare($Delete_Demande_Suppresion_Persos);
                    $Parametres_Delete_Demande_Suppresion_Persos->execute(
                            array(
                                ':id_personnage' => $Suppression_Perssonage_Procedure_ID_Personnage
                            )
                    );
                    /* ------------------------------------------------------------------------------------------------ */

                    $Tableau_Retour_Json = array(
                        'result' => "FAIL",
                        'reasons' => "Chef"
                    );
                    ?>
                <?php } ?>

            <?php } else { ?>
                <?php

                if (empty($_SESSION["Verification_Suppression"]) || ($_SESSION["Verification_Suppression"] == 0)) {

                    $Tableau_Retour_Json = array(
                        'result' => "FAIL_ONE",
                        'reasons' => "Le numéro de vérification est faux (1)."
                    );
                    $_SESSION["Verification_Suppression"] = 1;
                } else if ($_SESSION["Verification_Suppression"] == 1) {

                    $Tableau_Retour_Json = array(
                        'result' => "FAIL_ONE",
                        'reasons' => "Le numéro de vérification est faux (2)."
                    );
                    $_SESSION["Verification_Suppression"] = 2;
                } else if ($_SESSION["Verification_Suppression"] == 2) {

                    $Tableau_Retour_Json = array(
                        'result' => "FAIL_ONE",
                        'reasons' => "Le numéro de vérification est faux (3)."
                    );
                    $_SESSION["Verification_Suppression"] = 3;
                } else if ($_SESSION["Verification_Suppression"] == 3) {

                    /* -------------- Suppression autres demande ----------------------------------------------------- */
                    $Delete_Demande_Suppresion_Persos = "DELETE 
                                                 FROM site.suppression_personnage
                                                 WHERE id_personnage = :id_personnage";

                    $Parametres_Delete_Demande_Suppresion_Persos = $this->objConnection->prepare($Delete_Demande_Suppresion_Persos);
                    $Parametres_Delete_Demande_Suppresion_Persos->execute(
                            array(
                                ':id_personnage' => $Suppression_Perssonage_Procedure_ID_Personnage
                            )
                    );
                    /* ------------------------------------------------------------------------------------------------ */

                    $Tableau_Retour_Json = array(
                        'result' => "FAIL_OVER",
                        'reasons' => "Annulation de la procédure."
                    );

                    $_SESSION["Verification_Suppression"] = 0;
                }
                ?>
            <?php } ?>

        <?php } else { ?>
            <?php

            /* -------------- Suppression autres demande ----------------------------------------------------- */
            $Delete_Demande_Suppresion_Persos = "DELETE 
                                         FROM site.suppression_personnage
                                         WHERE id_personnage = :id_personnage";

            $Parametres_Delete_Demande_Suppresion_Persos = $this->objConnection->prepare($Delete_Demande_Suppresion_Persos);
            $Parametres_Delete_Demande_Suppresion_Persos->execute(
                    array(
                        ':id_personnage' => $Suppression_Perssonage_Procedure_ID_Personnage
                    )
            );
            /* ------------------------------------------------------------------------------------------------ */

            $Tableau_Retour_Json = array(
                'result' => "FAIL_EXPIRE",
                'reasons' => "Demande expiré ou inexistante, vous devez recommencer."
            );
            ?>
        <?php } ?>
        <?php echo json_encode($Tableau_Retour_Json); ?>
        <?php

    }

}

$class = new SQL_Suppression_Perssonage_Procedure();
$class->run();

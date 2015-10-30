<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php @include '../../configPDO.php'; ?>
<?php if (!empty($_SESSION["ID"])) { ?>
    <?php

    /* ------------------------ Vérification Données ---------------------------- */
    $Recuperation_Droits = "SELECT * 
                            FROM $BDD_Site.administration_users
                            WHERE id_compte = :id_compte
                            LIMIT 1";
    $Parametres_Recuperation_Droits = $Connexion->prepare($Recuperation_Droits);
    $Parametres_Recuperation_Droits->execute(array(':id_compte' => $_SESSION["ID"]));
    $Parametres_Recuperation_Droits->setFetchMode(PDO::FETCH_OBJ);
    $Nombre_De_Resultat_Recuperation_Droits = $Parametres_Recuperation_Droits->rowCount();
    /* -------------------------------------------------------------------------- */
    ?>
    <?php if ($Nombre_De_Resultat_Recuperation_Droits != 0) { ?>
        <?php $Donnees_Recuperation_Droits = $Parametres_Recuperation_Droits->fetch(); ?>

        <?php if ($Donnees_Recuperation_Droits->gerer_monnaies == 1) { ?>

            <?php if ($_POST["compte"] == "*") { ?>

                <?php

                $Id_Compte = "0";
                $Nombre_De_Monnaies = $_POST["nombre_monnaies"];
                $Transaction = $_POST["transaction"];
                $Devise = $_POST["devise"];
                $Error = "";

                if ($Transaction == "1") {
                    $Operation = "+";
                } else if ($Transaction == "2") {
                    $Operation = "-";
                } else {
                    $Error = "Problème";
                }

                if ($Devise == "1") {
                    $Designation_Devise = "cash";
                } else if ($Devise == "2") {
                    $Designation_Devise = "mileage";
                } else {
                    $Error = "Problème";
                }
                ?>

                <?php if ($Error == "") { ?>
                    <?php

                    /* ----------------- Update monnaies --------------------- */
                    $Update_Monnaies = "UPDATE $BDD_Account.account 
                                        SET $Designation_Devise = ($Designation_Devise $Operation $Nombre_De_Monnaies)";

                    $Parametres_Update_Monnaies = $Connexion->prepare($Update_Monnaies);
                    $Parametres_Update_Monnaies->execute(array(
                        ':id_compte' => $Id_Compte
                    ));
                    /* ----------------------------------------------------------- */
                    ?>

                    <?php

                    $Connexion_Ip = $_SERVER['REMOTE_ADDR'];

                    /* --------------------------- Insertion de l'item ---------------------------- */
                    $Insertion_Logs_Marche = "INSERT INTO $BDD_Site.administration_logs_gerer_monnaies (id_compte, montant, devise, operation, id_gm, date, ip) 
                              VALUES (:id_compte, :montant, :devise, :operation, :id_gm, NOW(), :ip)";

                    $Parametres_Insertion_Logs_Marche = $Connexion->prepare($Insertion_Logs_Marche);
                    $Parametres_Insertion_Logs_Marche->execute(array(
                        ':id_compte' => $Id_Compte,
                        ':montant' => $Nombre_De_Monnaies,
                        ':devise' => $Devise,
                        ':operation' => $Transaction,
                        ':id_gm' => $_SESSION["ID"],
                        ':ip' => $Connexion_Ip));
                    /* ---------------------------------------------------------------------------- */
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
                        'reasons' => "Problème de paramètres."
                    );
                    ?>
                <?php } ?>

            <?php } else { ?>

                <?php

                /* ------------------------ Vérification Données ---------------------------- */
                $Verification_Compte = "SELECT id 
                                    FROM $BDD_Account.account
                                    WHERE login = :login
                                    LIMIT 1";
                $Parametres_Verification_Compte = $Connexion->prepare($Verification_Compte);
                $Parametres_Verification_Compte->execute(array(':login' => $_POST["compte"]));
                $Parametres_Verification_Compte->setFetchMode(PDO::FETCH_OBJ);
                $Nombre_De_Resultat_Verification_Compte = $Parametres_Verification_Compte->rowCount();
                /* -------------------------------------------------------------------------- */
                ?>

                <?php if ($Nombre_De_Resultat_Verification_Compte != 0) { ?>

                    <?php $Donnees_Verification_Compte = $Parametres_Verification_Compte->fetch(); ?>

                    <?php

                    $Id_Compte = $Donnees_Verification_Compte->id;
                    $Nombre_De_Monnaies = $_POST["nombre_monnaies"];
                    $Transaction = $_POST["transaction"];
                    $Devise = $_POST["devise"];
                    $Error = "";

                    if ($Transaction == "1") {
                        $Operation = "+";
                    } else if ($Transaction == "2") {
                        $Operation = "-";
                    } else {
                        $Error = "Problème";
                    }

                    if ($Devise == "1") {
                        $Designation_Devise = "cash";
                    } else if ($Devise == "2") {
                        $Designation_Devise = "mileage";
                    } else {
                        $Error = "Problème";
                    }
                    ?>

                    <?php if ($Error == "") { ?>
                        <?php

                        /* ----------------- Update monnaies --------------------- */
                        $Update_Monnaies = "UPDATE $BDD_Account.account 
                                        SET $Designation_Devise = ($Designation_Devise $Operation $Nombre_De_Monnaies)
                                        WHERE id = :id_compte
                                        LIMIT 1";

                        $Parametres_Update_Monnaies = $Connexion->prepare($Update_Monnaies);
                        $Parametres_Update_Monnaies->execute(array(
                            ':id_compte' => $Id_Compte
                        ));
                        /* ----------------------------------------------------------- */
                        ?>

                        <?php

                        $Connexion_Ip = $_SERVER['REMOTE_ADDR'];

                        /* --------------------------- Insertion de l'item ---------------------------- */
                        $Insertion_Logs_Marche = "INSERT INTO $BDD_Site.administration_logs_gerer_monnaies (id_compte, montant, devise, operation, id_gm, date, ip) 
                              VALUES (:id_compte, :montant, :devise, :operation, :id_gm, NOW(), :ip)";

                        $Parametres_Insertion_Logs_Marche = $Connexion->prepare($Insertion_Logs_Marche);
                        $Parametres_Insertion_Logs_Marche->execute(array(
                            ':id_compte' => $Id_Compte,
                            ':montant' => $Nombre_De_Monnaies,
                            ':devise' => $Devise,
                            ':operation' => $Transaction,
                            ':id_gm' => $_SESSION["ID"],
                            ':ip' => $Connexion_Ip));
                        /* ---------------------------------------------------------------------------- */
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
                            'reasons' => "Problème de paramètres."
                        );
                        ?>
                    <?php } ?>

                <?php } else { ?>

                    <?php

                    $Tableau_Retour_Json = array(
                        'result' => "FAIL",
                        'reasons' => "Ce compte n'existe pas."
                    );
                    ?>
                <?php } ?>
            <?php } ?>
        <?php } else { ?>
            <?php

            $Tableau_Retour_Json = array(
                'result' => "FAIL",
                'reasons' => "Vous n'avez pas les droits nécessaires."
            );
            ?>
        <?php } ?>
    <?php } else { ?>
        <?php

        $Tableau_Retour_Json = array(
            'result' => "FAIL",
            'reasons' => "Vous n'avez pas les droits nécessaires."
        );
        ?>
    <?php } ?>
<?php } else { ?>
    <?php

    $Tableau_Retour_Json = array(
        'result' => "FAIL",
        'reasons' => "Vous n'avez pas les droits nécessaires."
    );
    ?>
<?php } ?>
<?php echo json_encode($Tableau_Retour_Json); ?>
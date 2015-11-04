<?php

namespace Pages\MonPersonnage\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxPersonnageDeleteSendEmail extends \ScriptHelper {

    public $isProtected = true;
    
    public function run() {

        $Suppression_Perssonage_Envoie_Mail_ID_Compte = $_POST["id_compte"];
        $Suppression_Perssonage_Envoie_Mail_ID_Personnage = $_POST["id_personnage"];
        $Ip = $_SERVER['REMOTE_ADDR'];

        /* ------------------------ Vérifications Doublons ------------------------------ */
        $Vérification_Doublon = "SELECT id
                         FROM site.suppression_personnage 
                         WHERE id_compte = :id_compte
                         AND id_personnage = :id_personnage
                         AND ip = :ip
                         AND date > (NOW() - INTERVAL 1 HOUR)
                         LIMIT 1";
        $Parametres_Vérification_Doublon = $this->objConnection->prepare($Vérification_Doublon);
        $Parametres_Vérification_Doublon->execute(
                array(
                    ':id_compte' => $Suppression_Perssonage_Envoie_Mail_ID_Compte,
                    ':id_personnage' => $Suppression_Perssonage_Envoie_Mail_ID_Personnage,
                    ':ip' => $Ip
                )
        );
        $Parametres_Vérification_Doublon->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Vérification_Doublon = $Parametres_Vérification_Doublon->rowCount();
        /* -------------------------------------------------------------------------- */

        if ($Nombre_De_Resultat_Vérification_Doublon == 0) {

            /* -------------- Suppression autres demande ----------------------------------------------------- */
            $Delete_Demande_Suppresion_Persos = "DELETE 
                                         FROM site.suppression_personnage
                                         WHERE id_personnage = :id_personnage";

            $Parametres_Delete_Demande_Suppresion_Persos = $this->objConnection->prepare($Delete_Demande_Suppresion_Persos);
            $Parametres_Delete_Demande_Suppresion_Persos->execute(
                    array(
                        ':id_personnage' => $Suppression_Perssonage_Envoie_Mail_ID_Personnage
                    )
            );
            /* ------------------------------------------------------------------------------------------------ */

            /* ------------------------ Récupération Email ------------------------------ */
            $Recuperation_Email = "SELECT account.email,
                                  account.login
                           FROM account.account
                           WHERE id = :id
                           LIMIT 1";
            $Parametres_Recuperation_Email = $this->objConnection->prepare($Recuperation_Email);
            $Parametres_Recuperation_Email->execute(
                    array(
                        ':id' => $Suppression_Perssonage_Envoie_Mail_ID_Compte
                    )
            );
            $Parametres_Recuperation_Email->setFetchMode(\PDO::FETCH_OBJ);
            $Nombre_De_Resultat_Recuperation_Email = $Parametres_Recuperation_Email->rowCount();
            /* -------------------------------------------------------------------------- */
            ?>
            <?php if ($Nombre_De_Resultat_Recuperation_Email != 0) { ?>

                <?php $Donnees_Recuperation_Email = $Parametres_Recuperation_Email->fetch(); ?>

                <?php

                /* ------------------------ Récupération Nom du Personnage ---------------------- */
                $Recuperation_Name = "SELECT player.name 
                              FROM player.player
                              WHERE id = :id_perso
                              AND account_id = :id_account
                              LIMIT 1";
                $Parametres_Recuperation_Name = $this->objConnection->prepare($Recuperation_Name);
                $Parametres_Recuperation_Name->execute(
                        array(
                            ':id_perso' => $Suppression_Perssonage_Envoie_Mail_ID_Personnage,
                            ':id_account' => $Suppression_Perssonage_Envoie_Mail_ID_Compte
                        )
                );
                $Parametres_Recuperation_Name->setFetchMode(\PDO::FETCH_OBJ);
                $Nombre_De_Resultat_Recuperation_Name = $Parametres_Recuperation_Name->rowCount();
                /* ------------------------------------------------------------------------------- */
                ?>
                <?php if ($Nombre_De_Resultat_Recuperation_Name != 0) { ?>

                    <?php $Donnees_Recuperation_Name = $Parametres_Recuperation_Name->fetch(); ?>

                    <?php $Destinataire = $Donnees_Recuperation_Email->email; ?>

                    <?php

                    mt_srand((float) microtime() * 1000000);
                    $Nombre_Unique = mt_rand(0, 100000000000);

                    $Sujet = 'VamosMt2 - Suppression du Personnage ' . $Donnees_Recuperation_Name->name . '';

                    $headers = "From: \"VamosMt2\" <contact@vamosmt2.fr>" . "\n";
                    $headers .= "Reply-to: \"VamosMt2\" <contact@vamosmt2.fr>" . "\r\n";
                    $headers .= 'Mime-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
                    $headers .= "\r\n";

                    $msg = 'Bonjour ' . $Donnees_Recuperation_Email->login . '' . "<br/>";
                    $msg .= 'Vous avez demandé la suppression de votre personnage ' . $Donnees_Recuperation_Name->name . '.' . "<br/>";
                    $msg .= '' . "<br/>";
                    $msg .= 'Pour valider la demande veuillez indiquez le code suivant sur le site : ' . "<br/>";
                    $msg .= '' . $Nombre_Unique . '' . "<br/>";
                    $msg .= '' . "<br/>";
                    $msg .= 'Cordialement, Vamosmt2.' . "<br/>";
                    $msg .= '' . "<br/>";
                    ?>

                    <?php if (mail($Destinataire, $Sujet, $msg, $headers)) { ?>

                        <?php

                        /* ------------------------------------- Insertion Changement Mail --------------------------------------- */
                        $Insertion_Supression_Personnage = "INSERT site.suppression_personnage 
                                                           (id_compte, id_personnage, email, numero_verif, date, ip) 
                                                    VALUES (:id_compte, :id_personnage, :email, :numero_verif, NOW(), :ip)";

                        $Parametres_Insertion_Supression_Personnage = $this->objConnection->prepare($Insertion_Supression_Personnage);
                        $Parametres_Insertion_Supression_Personnage->execute(
                                array(
                                    ':id_compte' => $Suppression_Perssonage_Envoie_Mail_ID_Compte,
                                    ':id_personnage' => $Suppression_Perssonage_Envoie_Mail_ID_Personnage,
                                    ':email' => $Destinataire,
                                    ':numero_verif' => $Nombre_Unique,
                                    ':ip' => $Ip
                                )
                        );
                        /* -------------------------------------------------------------------------------------------------------- */
                        ?>

                        <?php

                        $Tableau_Retour_Json = array(
                            'result' => "WIN"
                        );
                        ?>

                    <?php } else { ?>
                        <?php

                        $Tableau_Retour_Json = array(
                            'result' => "FAIL",
                            'reasons' => "Erreur lors de l'envoie du mail."
                        );
                        ?>
                    <?php } ?>


                <?php } else { ?>
                    <?php

                    $Tableau_Retour_Json = array(
                        'result' => "FAIL",
                        'reasons' => "Le personnage ne vous appartient pas."
                    );
                    ?>
                <?php } ?>

            <?php } else { ?>

                <?php

                $Tableau_Retour_Json = array(
                    'result' => "FAIL",
                    'reasons' => "Le compte n'existe pas."
                );
                ?>

            <?php } ?>

        <?php } else { ?>
            <?php

            $Tableau_Retour_Json = array(
                'result' => "FAIL",
                'reasons' => "Il y'as déjà une demande en attente."
            );
            ?>
        <?php } ?>

        <?php echo json_encode($Tableau_Retour_Json); ?>

        <?php

    }

}

$class = new ajaxPersonnageDeleteSendEmail();
$class->run();

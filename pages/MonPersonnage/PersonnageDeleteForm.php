<?php

namespace Pages\MonPersonnage;

require __DIR__ . '../../../core/initialize.php';

class PersonnageDeleteForm extends \PageHelper {

    public function run() {
        ?>
        <?php include '../../pages/Fonctions_Utiles.php'; ?>
        <?php if (Test_Connexion()) { ?>
            <?php
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
                        ':id_compte' => $_SESSION["ID"],
                        ':id_personnage' => $_GET["id_perso"],
                        ':ip' => $Ip
                    )
            );
            $Parametres_Vérification_Doublon->setFetchMode(\PDO::FETCH_OBJ);
            $Nombre_De_Resultat_Vérification_Doublon = $Parametres_Vérification_Doublon->rowCount();
            /* -------------------------------------------------------------------------- */
            ?>

            <?php if ($Nombre_De_Resultat_Vérification_Doublon == 0) { ?>
                <?php
                /* ------------------------ Vérification du personnage ----------------------------------------- */
                $Verification_Proprietaire = "SELECT player.name 
                                      FROM player.player
                                      WHERE id = ?
                                      AND account_id = ?
                                      LIMIT 1";
                $Parametres_Verification_Proprietaire = $this->objConnection->prepare($Verification_Proprietaire);
                $Parametres_Verification_Proprietaire->execute(array(
                    $_GET["id_perso"],
                    $_SESSION["ID"]));
                $Parametres_Verification_Proprietaire->setFetchMode(\PDO::FETCH_OBJ);
                $Nombre_De_Resultat_Verification_Proprietaire = $Parametres_Verification_Proprietaire->rowCount();
                /* ---------------------------------------------------------------------------------------------- */
                ?>

                <?php if ($Nombre_De_Resultat_Verification_Proprietaire != 0) { ?>

                    <?php
                    /* -------------- Suppression autres demande ----------------------------------------------------- */
                    $Delete_Demande_Suppresion_Persos = "DELETE 
                                                 FROM site.suppression_personnage
                                                 WHERE id_personnage = :id_personnage";

                    $Parametres_Delete_Demande_Suppresion_Persos = $this->objConnection->prepare($Delete_Demande_Suppresion_Persos);
                    $Parametres_Delete_Demande_Suppresion_Persos->execute(
                            array(
                                ':id_personnage' => $_GET["id_perso"]
                            )
                    );
                    /* ------------------------------------------------------------------------------------------------ */
                    ?>

                    <?php $Donnees_Verification_Proprietaire = $Parametres_Verification_Proprietaire->fetch(); ?>

                    <div class="box box-default flat">

                        <div class="box-header">
                            <h3 class="box-title">Suppression du personnage <?= $Donnees_Verification_Proprietaire->name; ?></h3>
                        </div>

                        <div class="box-body">
                            Grâçe à cette fonction, vous allez pouvoir supprimer votre personnage <?= $Donnees_Verification_Proprietaire->name; ?>.<br/><br/>

                            Pour effectuer cette action, ne vous demandons de bien vouloir quitter votre guilde actuel si vous en avez une,
                            ou de passer le pouvoir à un tiers membre si vous en êtes le chef.<br/><br/>

                            Pour supprimer ce personnage depuis le site, nous allons vous envoyer un e-mail pour prouver votre identité.<br/>
                            Vous recevrez un code confidentiel <b>valable 1 heure</b> qu'il faudra renseigner dans notre formulaire.<br/><br/>

                            Pour recevoir ce mail, cliquez sur le bouton "Envoyer".<br/>
                            Si vous êtes là par erreur, vous pouvez toujours annuler la demande.<br/>

                        </div>

                        <div class="box-footer">
                            <div class="pull-left">
                                <input type="button" class="btn btn-danger btn-flat" value="Annuler" onclick="Ajax('pages/_LegacyPages/Accueil.php');" />
                            </div>

                            <div class="pull-right">
                                <input type="button" class="btn btn-success btn-flat" value="Envoyer" onclick="Envoie_Mail_Supprimer_Perso();" />
                            </div>        
                        </div>

                    </div>

                    <script type="text/javascript">

                        function Envoie_Mail_Supprimer_Perso() {

                            Barre_De_Statut("Traitement de la demande...");
                            Icone_Chargement(1);

                            $.ajax({
                                type: "POST",
                                url: "pages/MonPersonnage/ajax/ajaxPersonnageDeleteSendEmail.php",
                                data: "id_compte=<?= $_SESSION["ID"]; ?>&id_personnage=<?= $_GET["id_perso"]; ?>",
                                success: function (msg) {

                                    try {
                                        Parse_Json = JSON.parse(msg);

                                        if (Parse_Json.result == "WIN") {

                                            Barre_De_Statut("Le mail a été envoyé avec succès.");
                                            Icone_Chargement(0);

                                            Ajax('pages/MonPersonnage/PersonnageDeleteVerify.php?id_personnage=<?= $_GET["id_perso"]; ?>');

                                        } else if (Parse_Json.result == "FAIL") {

                                            Barre_De_Statut(Parse_Json.reasons);
                                            Icone_Chargement(2);
                                        }

                                    } catch (e) {
                                        Barre_De_Statut("L'envoie du mail a échoué.");
                                        Icone_Chargement(2);
                                    }
                                }
                            });
                            return false;
                        }

                    </script>
                <?php } else { ?>

                    <div class="Cadre_Principal">

                        <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                            <h1>Erreur lors de la demande de suppression</h1>
                        </div>

                        <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
                            <hr class="Hr_Haut"/>
                            La demande de suppression que vous venez de demander n'as pas été accepter.<br/><br/>

                            En effet il semble, après vérification, que le personnage sélectionné ne vous appartient pas.<br/>
                            Vous ne pouvez donc pas faire cette action.<br/><br/>

                            Si vous pensez qu'il s'agit d'une erreur, nous vous prions de contacter la messagerie 
                            support de VamosMt2.<br/>
                            Elle est disponible dans le menu supérieur du site.<br/><br/>

                            Pour revenir à l'accueil, merci de cliquer sur le bouton "Accueil".<br/>
                            <hr class="Hr_Bas">

                            <input type="button" class="Bouton_Annuler_Changer_Email_Accueil Bouton_Normal" value="Accueil" onclick="Ajax('pages/_LegacyPages/Accueil.php');" />

                        </div>

                    </div>

                <?php } ?>
            <?php } else { ?>
                <div class="Cadre_Principal">

                    <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                        <h1>Erreur lors de la demande de suppression</h1>
                    </div>

                    <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
                        <hr class="Hr_Haut"/>
                        La demande de suppression que vous venez de demander n'as pas été accepter.<br/><br/>

                        En effet, une demande de suppression est valide durant une heure entière.<br/>
                        Il se trouve que nous avons pu vérifier qu'une autre de vos demande est déjà en cours.<br/>
                        Pensez à bien vérifier vos e-mail. Si vous souhaitez renouveler une tentative, vous êtes prié d'attendre
                        une heure a compté de la date de la première demande.<br/><br/>

                        Si vous pensez qu'il s'agit d'une erreur, nous vous prions de contacter la messagerie 
                        support de VamosMt2.<br/>
                        Elle est disponible dans le menu supérieur du site.<br/><br/>

                        Pour revenir à l'accueil, merci de cliquer sur le bouton "Accueil".<br/>
                        <hr class="Hr_Bas">

                        <input type="button" class="Bouton_Annuler_Changer_Email_Accueil Bouton_Normal" value="Accueil" onclick="Ajax('pages/_LegacyPages/Accueil.php');" />

                    </div>

                </div>
            <?php } ?>

        <?php } else { ?>
            <?php include '../pages/Restriction_Non_Connectes.php'; ?>
        <?php } ?>
        <?php
    }

}

$class = new PersonnageDeleteForm();
$class->run();

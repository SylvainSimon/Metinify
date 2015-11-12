<?php

namespace Pages\MonPersonnage;

require __DIR__ . '../../../core/initialize.php';

class PersonnageDeleteVerify extends \PageHelper {

    public $isProtected = true;
    
    public function run() {
        ?>

        
        <?php
        $Id_Personnage = $_GET['id_personnage'];
        $Ip = $_SERVER['REMOTE_ADDR'];
        $_SESSION["Verification_Suppression"] = 0;

        /* ------------------------ Vérifications Doublons ------------------------------ */
        $Verification_Demande = "SELECT id
                             FROM site.suppression_personnage 
                             WHERE id_personnage = :id_personnage
                             AND ip = :ip
                             AND date > (NOW() - INTERVAL 1 HOUR)
                             LIMIT 1";
        $Parametres_Verification_Demande = $this->objConnection->prepare($Verification_Demande);
        $Parametres_Verification_Demande->execute(
                array(
                    ':id_personnage' => $Id_Personnage,
                    ':ip' => $Ip
                )
        );
        $Parametres_Verification_Demande->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Verification_Demande = $Parametres_Verification_Demande->rowCount();
        /* -------------------------------------------------------------------------- */
        ?>
        <?php if ($Nombre_De_Resultat_Verification_Demande != 0) { ?>

            <div class="box box-default flat">

                <div class="box-header">
                    <h3 class="box-title">Saisie du code de confirmation</h3>
                </div>

                <div class="box-body">

                    Pour continuer il faut récupérer le code de confirmation qui a été généré et
                    envoyer à votre adresse e-mail.<br/><br/>

                    Il est indispensable pour confirmer la suppression de votre personnage et n'est valable
                    qu'une heure.<br/>
                    De la même manière, vous n'aurez plus accès à cette page si
                    vous fermez votre navigateur et il faudra générer une nouvelle demande.<br/><br/>

                    Veuillez saisir dans le champ ci-dessous votre code de confirmation unique :<br/>
                    Attention, vous n'avez le droit qu'as un seul essaie par heure.
                    <br/>
                    <br/>


                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group ">
                                <label for="Input_Saisie_Validation_Suppression">
                                    Code d'entrepôt
                                </label>

                                <div class="input-group col-xs-12">
                                    <input type="text" id="Input_Saisie_Validation_Suppression" class="form-control input-sm text" placeholder="XXXXXXXXX"><br/><br/>
                                </div>
                            </div>
                        </div>
                    </div>

                    Afin de valider votre saisie, veuillez cliquez sur le bouton "Valider".<br/>

                </div>

                <div class="box-footer">

                    <div class="pull-right">
                        <input type="button" class="btn btn-success btn-flat" value="Valider" onclick="Procedure_Effacement_Personnage()" />
                    </div>        
                </div>

            </div>
            <script type="text/javascript">
                function Procedure_Effacement_Personnage() {

                    Barre_De_Statut("Traitement de la suppression...");
                    Icone_Chargement(1);

                    if ($("#Input_Saisie_Validation_Suppression").val != "") {

                        $.ajax({
                            type: "POST",
                            url: "pages/MonPersonnage/ajax/ajaxPersonnageDeleteExecute.php",
                            data: "id_compte=<?= $this->objAccount->getId(); ?>&id_personnage=<?= $Id_Personnage; ?>&numero_verif=" + $("#Input_Saisie_Validation_Suppression").val(),
                            success: function (msg) {

                                try {
                                    Parse_Json = JSON.parse(msg);

                                    if (Parse_Json.result == "WIN") {
                                        Barre_De_Statut("Suppression effectuer");
                                        Icone_Chargement(0);

                                        Ajax("pages/PersonnageDeleteTerm.php?result=Oui");

                                    } else if (Parse_Json.result == "FAIL") {

                                        Ajax("pages/PersonnageDeleteTerm.php?result=" + Parse_Json.reasons);

                                    } else if (Parse_Json.result == "FAIL_OVER") {

                                        Ajax("pages/PersonnageDeleteTerm.php?result=Bad");

                                    } else if (Parse_Json.result == "FAIL_ONE") {

                                        Barre_De_Statut(Parse_Json.reasons);
                                        Icone_Chargement(2);

                                    } else if (Parse_Json.result == "FAIL_EXPIRE") {
                                        Ajax("pages/PersonnageDeleteTerm.php?result=Expire");
                                    }

                                } catch (e) {
                                    Barre_De_Statut("La suppression du personnage a échoué.");
                                    Icone_Chargement(2);
                                }
                            }
                        });
                        return false;

                    } else {
                        Barre_De_Statut("Vous n'avez indiqué aucun numéro.");
                        Icone_Chargement(2);
                    }


                }
            </script>
        <?php } else { ?>
            <div class="Cadre_Principal">

                <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                    <h1>Erreur lors de la demande de suppression</h1>
                </div>

                <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
                    <hr class="Hr_Haut"/>
                    La demande de suppression que vous venez de demander n'as pas pu aboutir.<br/><br/>

                    En effet il semble, après vérification, qu'aucune demande de suppression n'est valide<br/>
                    pour votre compte et pour ce personnage.<br/><br/>

                    Il est possible que vous ayez dépassé le délais et que votre demande est expiré.<br/>
                    Si vous rencontrez ce problème de manière répétitive, veuillez contacter le<br/>
                    support par messagerie de VamosMt2.<br/><br/>

                    Pour revenir à l'accueil, merci de cliquer sur le bouton "Accueil".<br/>
                    <hr class="Hr_Bas">

                    <input type="button" class="Bouton_Annuler_Changer_Email_Accueil Bouton_Normal" value="Accueil" onclick="Ajax('pages/_LegacyPages/News.php');" />

                </div>

            </div>
        <?php } ?>

        <?php
    }

}

$class = new PersonnageDeleteVerify();
$class->run();

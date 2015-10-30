<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include '../configPDO.php'; ?>
<?php include '../pages/Fonctions_Utiles.php'; ?>
<?php if (Test_Connexion()) { ?>
    <?php
    $Ip = $_SERVER['REMOTE_ADDR'];
    ?>

    <?php
    /* ------------------------ Vérification du personnage ----------------------------------------- */
    $Verification_Proprietaire = "SELECT player.name 
                                      FROM $BDD_Player.player
                                      WHERE id = ?
                                      AND account_id = ?
                                      LIMIT 1";
    $Parametres_Verification_Proprietaire = $Connexion->prepare($Verification_Proprietaire);
    $Parametres_Verification_Proprietaire->execute(array(
        $_GET["id_perso"],
        $_SESSION["ID"]));
    $Parametres_Verification_Proprietaire->setFetchMode(PDO::FETCH_OBJ);
    $Nombre_De_Resultat_Verification_Proprietaire = $Parametres_Verification_Proprietaire->rowCount();
    /* ---------------------------------------------------------------------------------------------- */
    ?>

    <?php if ($Nombre_De_Resultat_Verification_Proprietaire != 0) { ?>
        <?php $Donnees_Verification_Proprietaire = $Parametres_Verification_Proprietaire->fetch(); ?>

        <div class="Cadre_Principal">

            <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                <h1>Demande de renommage du perssonage <?= $Donnees_Verification_Proprietaire->name; ?></h1>
            </div>

            <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
                <hr class="Hr_Haut"/>
                Grâçe à cette fonction, vous allez pouvoir renommer votre personnage <?= $Donnees_Verification_Proprietaire->name; ?>.<br/><br/>

                Pour effectuer cette action, il faut debourser la somme de 1500 Vamonaies.

                <table class="Table_Modele">
                    <tr>
                        <td class="Colonne_Gauche_Formulaire">Nom actuel :</td>
                        <td>
                            <input type="texte" disabled value="<?= $Donnees_Verification_Proprietaire->name; ?>" class="Zone_Saisie_Changement_Code_Effacement"/>
                        </td>
                        <td class="Colonne_Droite_Formulaire"></td>
                    </tr>
                    <tr>
                        <td class="Colonne_Gauche_Formulaire">Nouveau nom : </td>
                        <td>
                            <input type="text" maxlength="12" autofocus="autofocus" placeholder="Nouveau nom" id="Champs_Saisie_Nouveau_Nom" class="Zone_Saisie_Changement_Code_Effacement"/>
                        </td>
                        <td class="Colonne_Droite_Formulaire">Indiquez le nouveau nom souhaité</td>
                    </tr>
                    <tr>
                        <td class="Colonne_Gauche_Formulaire">Répétez nouveau nom : </td>
                        <td>
                            <input type="text" maxlength="12" placeholder="Répétez" id="Champs_Saisie_Nouveau_Nom_Repete" class="Zone_Saisie_Changement_Code_Effacement"/>
                        </td>
                        <td class="Colonne_Droite_Formulaire">Répétez le nouveau nom souhaité</td>
                    </tr>
                </table>

                Pour valider le renommage, cliquez sur le bouton "Renommer".<br/>
                Si vous êtes là par erreur, vous pouvez toujours annuler la demande.<br/>
                <hr class="Hr_Bas">
                <input type="button" class="Bouton_Envoyer_Changer_Email Bouton_Normal" style="width: 80px;" value="Renommer" onclick="Procedure_Renommer_Personnage();" />
                <input type="button" class="Bouton_Annuler_Changer_Email Bouton_Normal" value="Annuler" onclick="Ajax('pages/Accueil.php');" />

            </div>

        </div>

        <script type="text/javascript">
                                                                                                                                                                                                                                                                                                                             
            function Procedure_Renommer_Personnage(){
                                                                                        
                if($("#Champs_Saisie_Nouveau_Nom").val() == $("#Champs_Saisie_Nouveau_Nom_Repete").val()){
                                                        
                    pseudo = $("#Champs_Saisie_Nouveau_Nom").val();
                                                        
                    for(i=0 ; i < pseudo.length ; i++) {
                                                            
                        if((pseudo.charCodeAt(i) >= 0 && pseudo.charCodeAt(i) < 45) || 
                            (pseudo.charCodeAt(i) >= 45 && pseudo.charCodeAt(i) < 48) || 
                            (pseudo.charCodeAt(i) > 57 && pseudo.charCodeAt(i) < 65) || 
                            (pseudo.charCodeAt(i) > 90 && pseudo.charCodeAt(i) < 95) || 
                            (pseudo.charCodeAt(i) >= 95 && pseudo.charCodeAt(i) < 97) || 
                            (pseudo.charCodeAt(i) > 122) && (pseudo.charCodeAt(i) < 128) ||
                            (pseudo.charCodeAt(i) > 144)) {

                            UtilisateurSyntax = 1;
                             break;                                   
                        }else{
                                                                
                            UtilisateurSyntax = 0;
                        }
                    }
                                                                 
                    if(UtilisateurSyntax == 0){
                        Barre_De_Statut("Traitement de la demande...");
                        Icone_Chargement(1);
                                                                                                                                                                                                                                                                                                                                
                        $.ajax({
                            type: "POST",
                            url: "./ajax/SQL_Renommer_Personnage.php",
                            data: "id_personnage=<?= $_GET["id_perso"]; ?>&nouveau_nom="+$("#Champs_Saisie_Nouveau_Nom").val(),
                            success: function(msg){
                                                                                                                                                                                                                                                            
                                try {
                                    Parse_Json = JSON.parse(msg);
                                                                                                                                                                                                                                                        
                                    if(Parse_Json.result == "WIN"){
                                                                                                                                                                                                                                                            
                                        Barre_De_Statut(Parse_Json.reasons);
                                        Icone_Chargement(0);
                                                
                                        $.ajax({
                                            type: "POST",
                                            url: "./ajax/Update_Vamonaies.php",
                                            success: function(msg){
                                                Fonction_Reteneuse_Vamonaies(msg);
                                            }
                                        });
                                        
                                        $.ajax({
                                            type: "POST",
                                            url: "./ajax/Update_Tananaies.php",
                                            success: function(msg){
                                                Fonction_Reteneuse_Tananaies(msg);
                                            }
                                        });
                                        
                                        Ajax('pages/Personnage_Renommer_Validation.php');
                                                                                                                                                                                                                                    
                                    }else if(Parse_Json.result == "FAIL"){
                                                                                                                                                                                                                                            
                                        Barre_De_Statut(Parse_Json.reasons);
                                        Icone_Chargement(2);
                                    }
                                                                                                                                                                                                                                                        
                                } catch (e) {
                                    Barre_De_Statut("Le renommage a échoué.");
                                    Icone_Chargement(2);
                                }
                            }
                        });
                        return false;
                                                                            
                    }else{
                        Barre_De_Statut("Les caractère employés sont invalides.");
                        Icone_Chargement(2); 
                    }
                }else{
                                                                
                    Barre_De_Statut("Les deux pseudonymes ne sont pas identiques.");
                    Icone_Chargement(2); 
                }
            }
                                                                                                                                                                                                                                                                                                                            
        </script>

    <?php } else { ?>
        <div class="Cadre_Principal">

            <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                <h1>Erreur lors de la demande de renommage</h1>
            </div>

            <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
                <hr class="Hr_Haut"/>
                La demande de renommage a été annulé.<br/><br/>

                Il se trouve que nous avons pu vérifier que ce personnage ne vous appartient pas.<br/><br/>

                Si vous pensez qu'il s'agit d'une erreur, nous vous prions de contacter la messagerie 
                support de VamosMt2.<br/>
                Elle est disponible dans le menu supérieur du site.<br/><br/>

                Pour revenir à l'accueil, merci de cliquer sur le bouton "Accueil".<br/>
                <hr class="Hr_Bas">

                <input type="button" class="Bouton_Annuler_Changer_Email_Accueil Bouton_Normal" value="Accueil" onclick="Ajax('pages/Accueil.php');" />

            </div>

        </div>
    <?php } ?>

<?php } else { ?>
    <?php include '../pages/Restriction_Non_Connectes.php'; ?>
<?php } ?>

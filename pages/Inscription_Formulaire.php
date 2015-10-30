<?php @session_write_close(); ?>
<?php @session_start(); ?>

<?php include '../configPDO.php'; ?>

<?php
$Verification_Blocage_Inscription_Ip = $_SERVER['REMOTE_ADDR'];


/* ------------------------------ Vérification Données ---------------------------------------------- */
$Verification_Blocage_Inscription = "SELECT date_de_blocage FROM site.blocage_inscription
                                                                    WHERE ip = '" . $Verification_Blocage_Inscription_Ip . "'
                                                                    AND NOW() >= (date_de_blocage + INTERVAL 5 MINUTE)
                                                                    LIMIT 1";
$Parametres_Verification_Blocage_Inscription = $Connexion->query($Verification_Blocage_Inscription);
$Parametres_Verification_Blocage_Inscription->setFetchMode(PDO::FETCH_OBJ);
$Nombre_De_Resultat = $Parametres_Verification_Blocage_Inscription->rowCount();
/* -------------------------------------------------------------------------------------------------- */

if ($Nombre_De_Resultat == 1) {

    $Donnees_Blocage = $Parametres_Verification_Blocage_Inscription->fetch();

    /* -------------------------------------- Insertion Logs Blocage Inscription --------------------------------------- */
    $Insertion_Logs_Blocage_Inscription = "INSERT INTO site.logs_blocage_inscription (date_blocage, date_deblocage, ip) 
                                                                  VALUES (:date_blocage, NOW(), :ip)";

    $Parametres_Insertion_Logs_Blocage_Inscription = $Connexion->prepare($Insertion_Logs_Blocage_Inscription);
    $Parametres_Insertion_Logs_Blocage_Inscription->execute(array(
        ':date_blocage' => $Donnees_Blocage->date_de_blocage,
        ':ip' => $Verification_Blocage_Inscription_Ip));
    /* ----------------------------------------------------------------------------------------------------------------- */

    /* ---------------------- Debloquage ------------------------- */
    $Update_Blocage = "DELETE FROM site.blocage_inscription
                                   WHERE ip = '" . $Verification_Blocage_Inscription_Ip . "' ";

    $Parametres_Update_Blocage = $Connexion->query($Update_Blocage);
    /* ----------------------------------------------------------- */
    ?>
<?php } else { ?>

    <?php
    /* ------------------------------ Vérification Données ---------------------------------------------- */
    $Verification_Blocage = "SELECT * FROM site.blocage_inscription
                                                  WHERE ip = '" . $Verification_Blocage_Inscription_Ip . "'
                                                  LIMIT 1";
    $Parametres_Verification_Blocage = $Connexion->query($Verification_Blocage);
    $Parametres_Verification_Blocage->setFetchMode(PDO::FETCH_OBJ);
    $Nombre_De_Resultat_Blocages = $Parametres_Verification_Blocage->rowCount();
    /* -------------------------------------------------------------------------------------------------- */
    ?>

    <?php if ($Nombre_De_Resultat_Blocages == 0) { ?>

    <?php } else { ?>

        <div class="Cadre_Principal">

            <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                <h1>Formulaire d'inscription</h1>
            </div>
            <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
                <hr class="Hr_Haut"/>

                Suite à plusieurs tentatives d'inscriptions ratées et pour des raisons de sécurités,<br/>
                Vous devez attendre cinq minutes avant de pouvoir de nouveau vous inscrire.

                <hr class="Hr_Bas">
                <input type="button" class="Bouton_Annuler_Changer_Email_Accueil Bouton_Normal" value="Accueil" onclick="Ajax('pages/Accueil.php');" />

            </div>
        </div>
        <?php exit(); ?>
    <?php } ?>
<?php } ?>

<script type="text/javascript">

    Type_De_Calcul = Math.ceil(Math.random() * 3);


</script>

<div class="Cadre_Principal">

    <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
        <h1>Formulaire d'inscription</h1>
    </div>
    <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
        <hr class="Hr_Haut"/>
        <script type="text/javascript" src="js/Controle_Inscription.js"></script>
        <form action="javascript:void(0)" id="FormInscription" name="FormInscription" method="POST">

            <table id="Table_Inscription">
                <tr>
                    <td class="Colonne_Gauche_Formulaire">Nom d'Utilisateur : </td>
                    <td><input maxlength="16" id="SaisieUtilisateur" class="Zone_Saisie_Inscription" type="text" name="user" onBlur="verifNomDutilisateur(this.value)"/></td>
                    <td id="ReponseDuTestNomDutilisateur">Indiquez un identifiant</td>
                </tr>

                <tr>
                    <td class="Colonne_Gauche_Formulaire">Mot de passe : </td>
                    <td><input id="SaisieMDP" class="Zone_Saisie_Inscription" type="password" name="password" onKeyUp="verifMDP()"/></td>
                    <td id="ReponseDuTestMotDePasse">Indiquez un mot de passe</td>
                </tr>

                <tr>
                    <td class="Colonne_Gauche_Formulaire">Répétez mot de passe : </td>
                    <td><input id="SaisieRepeterMDP" class="Zone_Saisie_Inscription" type="password" name="password2" onKeyUp="verifRepeterMDP()"/></td>
                    <td id="ReponseDuTestRepeterMotDePasse">Répétez le mot de passe</td>
                </tr>

                <tr>
                    <td class="Colonne_Gauche_Formulaire">Adresse E-mail : </td>
                    <td><input id="SaisieMail" class="Zone_Saisie_Inscription" type="text" name="email" onBlur="VerifSyntaxEmail()" onKeyUP="VerifSyntaxEmail()"/></td>
                    <td id="ReponseDuTestMail">Indiquez une adresse e-mail</td>
                </tr>

                <tr>
                    <td class="Colonne_Gauche_Formulaire">Résoudre l'opération : </td>
                    <td><input id="SaisieCaptcha" class="Zone_Saisie_Inscription" type="text" name="email" onfocus="if(this.value==Valeur_Temporaire) this.value='';" onkeyup="CaptchaVerif();" onblur="if(this.value=='') this.value=Valeur_Temporaire;"/></td>
                    <td id="ReponseCaptcha">Vérifions que vous êtes un humain</td>
                </tr>

            </table>
            En cliquant sur Envoyer, j'accepte les <a onclick="Ajax('pages/CDG.php');" >CGU</a> ainsi que le <a onclick="Ajax('pages/regles.php');" >règlement de jeu</a>.
            <hr class="Hr_Bas">
            <input type="button" class="Bouton_Formulaire_Inscription Bouton_Normal" onclick="VerificationFormulaire();" src="images/Bouton_Valider.png" value="Envoyer" />
            <input type="button" class="Bouton_Annuler_Changer_Email Bouton_Normal" value="Annuler" onclick="Ajax('pages/Accueil.php');" />

        </form>
    </div>
</div>

<script type="text/javascript">
                                                                                                                                        
    if(Type_De_Calcul == 1){
                                                                                                                                            
        var a = 0;
        var b = 0;
        var c = 0;
                                                                                                                                        
        var Valeur_Temporaire = "Combien font "+ a + " + " + b +" ?";
                                                                                                                                        
        function Generation1(){
                                                                                                                                            
            a = Math.ceil(Math.random() * 20);
            b = Math.ceil(Math.random() * 20);       
            c = a + b
                                                                                                                                        
            document.getElementById('SaisieCaptcha').value = "Combien font "+ a + " + " + b +" ?";
            Valeur_Temporaire = "Combien font "+ a + " + " + b +" ?";
                                                                                                                                        
        }
                                                                                                                                        
        Generation1();
                                                                                                                                        
    }else if (Type_De_Calcul == 2){
                                                                                                                                            
        var a = 0;
        var b = 0;
        var c = 0;
                                                                                                                                        
        var Valeur_Temporaire = "Combien font "+ a + " x " + b +" ?";
                                                                                                                                        
        function Generation2(){
                                                                                                                                            
            a = Math.ceil(Math.random() * 20);
            b = Math.ceil(Math.random() * 20);       
            c = a * b
                                                                                                                                        
            document.getElementById('SaisieCaptcha').value = "Combien font "+ a + " x " + b +" ?";
            Valeur_Temporaire = "Combien font "+ a + " x " + b +" ?";
                                                                                                                                        
        }
                                                                                                                                        
        Generation2();
                                                                                                                                            
    }else if (Type_De_Calcul == 3){
                                                                                                                                            
        var a = 0;
        var b = 0;
        var c = 0;
                                                                                                                                        
        var Valeur_Temporaire = "Combien font "+ a + " - " + b +" ?";
                                                                                                                                        
        function Generation3(){
                                                                                                                                            
            a = Math.ceil(Math.random() * 20);
            b = Math.ceil(Math.random() * 20);       
            c = a - b
                                                                                                                                        
            document.getElementById('SaisieCaptcha').value = "Combien font "+ a + " - " + b +" ?";
            Valeur_Temporaire = "Combien font "+ a + " - " + b +" ?";
                                                                                                                                        
        }
                                                                                                                                        
        Generation3();
    }
                                                                                                                                            
</script>
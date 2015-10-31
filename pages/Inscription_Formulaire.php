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

<div class="box box-default flat">

    <div class="box-header">
        <h3 class="box-title">Création de compte</h3>
    </div>

    <script type="text/javascript" src="js/Controle_Inscription.js"></script>
    <form action="javascript:void(0)" id="FormInscription" name="FormInscription" method="POST">

        <div class="box-body">

            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group ">
                        <label for="SaisieUtilisateur">
                            Identifiant
                        </label>

                        <div class="input-group col-xs-12">
                            <input type="text" name="user" onBlur="verifNomDutilisateur(this.value)" id="SaisieUtilisateur" class="form-control input-sm text" value="" required maxlength="16">
                        </div>

                        <span class="help-block">    
                            <ul class="list-unstyled">
                                <li id="ReponseDuTestNomDutilisateur"></li>
                            </ul>
                        </span>
                    </div>

                    <div class="form-group ">
                        <label for="SaisieMDP">
                            Mot de passe
                        </label>

                        <div class="input-group col-xs-12">
                            <input type="password" name="password" onKeyUp="verifMDP()" id="SaisieMDP" class="form-control input-sm text" value="" required>
                        </div>

                        <span class="help-block">    
                            <ul class="list-unstyled">
                                <li id="ReponseDuTestMotDePasse"></li>
                            </ul>
                        </span>
                    </div>

                    <div class="form-group" style="margin-bottom: 0px;">
                        <label for="SaisieMDP">
                            Répétez mot de passe
                        </label>

                        <div class="input-group col-xs-12">
                            <input type="password" name="password2" onKeyUp="verifRepeterMDP()" id="SaisieRepeterMDP" class="form-control input-sm text" value="" required>
                        </div>

                        <span class="help-block">    
                            <ul class="list-unstyled">
                                <li id="ReponseDuTestRepeterMotDePasse"></li>
                            </ul>
                        </span>
                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="form-group ">
                        <label for="SaisieMDP">
                            E-mail
                        </label>

                        <div class="input-group col-xs-12">
                            <input type="text" name="email" onBlur="VerifSyntaxEmail()" onKeyUP="VerifSyntaxEmail()" id="SaisieMail" class="form-control input-sm text" value="" required>
                        </div>

                        <span class="help-block">    
                            <ul class="list-unstyled">
                                <li id="ReponseDuTestMail"></li>
                            </ul>
                        </span>
                    </div>

                    <div class="form-group ">
                        <label for="SaisieMDP">
                            Résoudre l'opération
                        </label>

                        <div class="input-group col-xs-12">
                            <input type="text" onfocus="if (this.value == Valeur_Temporaire)
                                        this.value = '';" onkeyup="CaptchaVerif();" onblur="if (this.value == '')
                                                    this.value = Valeur_Temporaire;" id="SaisieCaptcha" class="form-control input-sm text" value="" required>
                        </div>

                        <span class="help-block">    
                            <ul class="list-unstyled">
                                <li id="ReponseCaptcha"></li>
                            </ul>
                        </span>
                    </div>

                </div>
            </div>
        </div>

        <div class="box-footer">

            <div class="pull-right">
                En cliquant, j'accepte les <a style="cursor: pointer;" onclick="Ajax('pages/CDG.php');" >CGU</a> ainsi que le <a style="cursor: pointer;" onclick="Ajax('pages/regles.php');" >règlement de jeu</a>.
                <input type="button" class="btn btn-success btn-flat" onclick="VerificationFormulaire();" src="images/Bouton_Valider.png" value="Envoyer" />
            </div>
    </form>

</div>

<script type="text/javascript">

    if (Type_De_Calcul == 1) {

        var a = 0;
        var b = 0;
        var c = 0;

        var Valeur_Temporaire = "Combien font " + a + " + " + b + " ?";

        function Generation1() {

            a = Math.ceil(Math.random() * 20);
            b = Math.ceil(Math.random() * 20);
            c = a + b

            document.getElementById('SaisieCaptcha').value = "Combien font " + a + " + " + b + " ?";
            Valeur_Temporaire = "Combien font " + a + " + " + b + " ?";

        }

        Generation1();

    } else if (Type_De_Calcul == 2) {

        var a = 0;
        var b = 0;
        var c = 0;

        var Valeur_Temporaire = "Combien font " + a + " x " + b + " ?";

        function Generation2() {

            a = Math.ceil(Math.random() * 20);
            b = Math.ceil(Math.random() * 20);
            c = a * b

            document.getElementById('SaisieCaptcha').value = "Combien font " + a + " x " + b + " ?";
            Valeur_Temporaire = "Combien font " + a + " x " + b + " ?";

        }

        Generation2();

    } else if (Type_De_Calcul == 3) {

        var a = 0;
        var b = 0;
        var c = 0;

        var Valeur_Temporaire = "Combien font " + a + " - " + b + " ?";

        function Generation3() {

            a = Math.ceil(Math.random() * 20);
            b = Math.ceil(Math.random() * 20);
            c = a - b

            document.getElementById('SaisieCaptcha').value = "Combien font " + a + " - " + b + " ?";
            Valeur_Temporaire = "Combien font " + a + " - " + b + " ?";

        }

        Generation3();
    }

</script>
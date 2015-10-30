<?php @session_write_close(); ?>
<?php @session_start(); ?>

<?php
if (empty($_GET['Resultat'])) {

    include './pages/restrictionsdaccees.php';
} else {

    if ($_GET['Resultat'] == "oui") {
        ?>
<!--<u>Veuillez activer le compte par E-Mail afin de jouer, il est possible que l'E-Mail soit dans vos spams. </u><br />Contactez le support en cas de soucis.<br /><br/>-->
        <div class="Cadre_Principal">

            <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                <h1>Inscription effective !</h1>
            </div>
            <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1"> 
                
                <hr class="Hr_Haut"/>
                Bienvenue <?php echo $_SESSION['NomTemporaire']; ?> ! <br/><br/>
                <u>Veuillez activer le compte par E-Mail afin de jouer, il est possible que l'E-Mail soit dans vos spams. </u><br />Gmail place l'E-Mail dans Plus > Spam et Hotmail dans Courir indésirable, contactez le support en cas de soucis.<br /><br/>
                Vous avez reçu une troisième main gratuit définitive dans les bonus de votre compte.<br/>
                Ne JAMAIS donner vos identifiants même à vos amis !<br/>
                Ne prêtez jamais vos stuffs à ceux qui disent "jte fais ci-ca" c'est du fake !<br/>
				N'hésitez pas à consulter le guide de sécurité en cliquant <a onclick="Ajax('pages/Securite.php');" >ici</a>.<br /><br/>

                Bon jeu à vous sur VamosMT2 !<br/>
                <hr class="Hr_Bas">

                <input type="button" class="Bouton_Annuler_Changer_Email_Accueil Bouton_Normal" value="Accueil" onclick="Ajax('pages/Accueil.php');" />

                
            </div>
        </div>

    <?php } else { ?>

        <div class="Cadre_Principal">

            <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                <h1>Erreur lors de l'inscription</h1>
            </div>
            <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1"> 
                <hr class="Hr_Haut"/>
                Votre inscription sur les serveurs VamosMt2 a été annulée.<br/><br/>
                Une erreur de nature inconnue a été détectée et nous vous invitons a recommencer ultérieurement.<br/><br/>

                Si vous pensez qu'il s'agit d'une erreur, nous vous prions de contacter la messagerie 
                support de VamosMt2.<br/>
                Elle est disponible dans le menu supérieur du site.<br/><br/>
                
                Pour revenir à l'accueil, merci de cliquer sur le bouton "Accueil".<br/>
                <hr class="Hr_Bas">

                <input type="button" class="Bouton_Annuler_Changer_Email_Accueil Bouton_Normal" value="Accueil" onclick="Ajax('pages/Accueil.php');" />

            </div>
        </div>

    <?php } ?>

<?php } ?>
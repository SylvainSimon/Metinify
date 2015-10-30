<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include '../configPDO.php'; ?>
<?php include '../pages/Fonctions_Utiles.php'; ?>
<?php if (!empty($_GET["result"])) { ?>

    <?php if ($_GET["result"] == "Oui") { ?>
        <div class="Cadre_Principal">

            <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                <h1>La suppression du personnage est un succès</h1>
            </div>

            <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
                <hr class="Hr_Haut"/>
                Votre personnage a été complètement effacer de nos serveurs.<br/><br/>

                Tous les items, les amis et autres données ont été supprimées également.<br/><br/>

                Si vous pensez qu'il s'agit d'une erreur, nous vous prions de contacter la messagerie 
                support de VamosMt2.<br/>
                Elle est disponible dans le menu supérieur du site.<br/><br/>

                Pour revenir à l'accueil, merci de cliquer sur le bouton "Accueil".<br/>
                <hr class="Hr_Bas">

                <input type="button" class="Bouton_Annuler_Changer_Email_Accueil Bouton_Normal" value="Accueil" onclick="Ajax('pages/Accueil.php');" />

            </div>

        </div>

    <?php } else if ($_GET["result"] == "Bad") { ?>
        <div class="Cadre_Principal">

            <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                <h1>La suppression du personnage est un échec</h1>
            </div>

            <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
                <hr class="Hr_Haut"/>
                La suppression du personnage a été annulé a cause de vos erreurs<br/><br/>

                Vous avez indiqué trois fois un mauvais numéro de vérification, ce qui entraine une annulation de la demande de suppression.<br/>
                Pour essayer de nouveau, il faut reprendre la procédure et générer une autre clés.<br/><br/>

                Si vous pensez qu'il s'agit d'une erreur, nous vous prions de contacter la messagerie 
                support de VamosMt2.<br/>
                Elle est disponible dans le menu supérieur du site.<br/><br/>

                Pour revenir à l'accueil, merci de cliquer sur le bouton "Accueil".<br/>
                <hr class="Hr_Bas">

                <input type="button" class="Bouton_Annuler_Changer_Email_Accueil Bouton_Normal" value="Accueil" onclick="Ajax('pages/Accueil.php');" />

            </div>

        </div>
    <?php } else if ($_GET["result"] == "Chef") { ?>
        <div class="Cadre_Principal">

            <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                <h1>La suppression du personnage est un échec</h1>
            </div>

            <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
                <hr class="Hr_Haut"/>
                La suppression du personnage a été annulé.<br/><br/>

                Nous avons détecté que votre personnage est Chef d'une guilde, il faut d'abord que vous transfériez votre rôle à un autre joueur et que vous quittiez la guilde.<br/>
                Pour essayer de nouveau, il faut reprendre la procédure et générer une autre clés.<br/><br/>

                Si vous pensez qu'il s'agit d'une erreur, nous vous prions de contacter la messagerie 
                support de VamosMt2.<br/>
                Elle est disponible dans le menu supérieur du site.<br/><br/>

                Pour revenir à l'accueil, merci de cliquer sur le bouton "Accueil".<br/>
                <hr class="Hr_Bas">

                <input type="button" class="Bouton_Annuler_Changer_Email_Accueil Bouton_Normal" value="Accueil" onclick="Ajax('pages/Accueil.php');" />

            </div>

        </div>
    <?php } else if ($_GET["result"] == "Membre") { ?>
        <div class="Cadre_Principal">

            <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                <h1>La suppression du personnage est un échec</h1>
            </div>

            <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
                <hr class="Hr_Haut"/>
                La suppression du personnage a été annulé.<br/><br/>

                Nous avons détecté que votre personnage est Membre d'une guilde, il faut d'abord que vous quittiez la guilde afin de ne pas générer de problème de place.<br/>
                Pour essayer de nouveau, il faut reprendre la procédure et générer une autre clés.<br/><br/>

                Si vous pensez qu'il s'agit d'une erreur, nous vous prions de contacter la messagerie 
                support de VamosMt2.<br/>
                Elle est disponible dans le menu supérieur du site.<br/><br/>

                Pour revenir à l'accueil, merci de cliquer sur le bouton "Accueil".<br/>
                <hr class="Hr_Bas">

                <input type="button" class="Bouton_Annuler_Changer_Email_Accueil Bouton_Normal" value="Accueil" onclick="Ajax('pages/Accueil.php');" />

            </div>

        </div>
    <?php } else if ($_GET["result"] == "Expire") { ?>
        <div class="Cadre_Principal">

            <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                <h1>La suppression du personnage est un échec</h1>
            </div>

            <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
                <hr class="Hr_Haut"/>
                La suppression du personnage a été annulé.<br/><br/>

                Nous avons détecté que votre demande concernait sois un compte inexistant, sois vous n'avez pas suivie les procédures réglementaires.<br/>
                Pour essayer de nouveau, il faut reprendre la procédure et générer une autre clés.<br/><br/>

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


<?php } ?>

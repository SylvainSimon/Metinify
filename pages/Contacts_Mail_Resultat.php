<?php

namespace Pages;

require __DIR__ . '../../core/initialize.php';

class Contacts_Mail_Resultat extends \PageHelper {

    public function run() {

        if (empty($_GET['Resultat'])) {

            include './pages/restrictionsdaccees.php';
        } else {

            if ($_GET['Resultat'] == "oui") {
                ?>

                <div class="Cadre_Principal">

                    <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                        <h1>E-mail envoyé !</h1>
                    </div>
                    <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1"> 

                        <hr class="Hr_Haut"/>
                        L'envoie du mail s'est bien déroulé.<br/><br/>

                        L'équipe de VamosMt2 vous répondra au plus vite.<br/>
                        Noubliez pas de surveiller votre boite mail.<br/><br/>

                        Pour revenir à l'accueil, merci de cliquer sur le bouton "Accueil".<br/>
                        <hr class="Hr_Bas">

                        <input type="button" class="Bouton_Annuler_Changer_Email_Accueil Bouton_Normal" value="Accueil" onclick="Ajax('pages/Accueil.php');" />

                    </div>
                </div>

            <?php } else { ?>

                <div class="Cadre_Principal">

                    <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                        <h1>Erreur lors de l'envoie</h1>
                    </div>
                    <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1"> 
                        <hr class="Hr_Haut"/>
                        Votre e-mail n'as pas été envoyé à l'équipe.<br/><br/>
                        Une erreur de nature inconnue a été détectée et nous vous invitons a recommencé ultérieurement.<br/><br/>

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
        <?php
    }

}

$class = new Contacts_Mail_Resultat();
$class->run();

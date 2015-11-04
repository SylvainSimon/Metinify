<?php

namespace Pages\MonCompte;

require __DIR__ . '../../../core/initialize.php';

class EmailChangeTerm extends \PageHelper {

    public $isProtected = true;
    
    public function run() {
        ?>
        <div class="Cadre_Principal">

            <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                <h1>Changement de mail effectif</h1>
            </div>
            <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
                <hr class="Hr_Haut"/>

                Votre adresse e-mail a bien été changé.<br/><br/>
                Un mail a été envoyé aux deux adresse pour information.<br/><br/>

                Pour revenir à l'accueil, merci de cliquer sur le bouton "Accueil".<br/>
                <hr class="Hr_Bas">
                <input type="button" class="Bouton_Annuler_Changer_Email_Accueil Bouton_Normal" value="Accueil" onclick="Ajax('pages/_LegacyPages/Accueil.php');" />
            </div>
        </div>
    <?php
    }

}
$class = new EmailChangeTerm();
$class->run();

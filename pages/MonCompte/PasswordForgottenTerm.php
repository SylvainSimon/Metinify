<?php

namespace Pages;

require __DIR__ . '../../../core/initialize.php';

class PasswordForgottenTerm extends \PageHelper {

    public $isProtected = true;
    
    public function run() {
        if (empty($_GET['Resultat'])) {

            include './pages/restrictionsdaccees.php';
        } else {

            if ($_GET['Resultat'] == "oui") {
                ?>

                <div class="Cadre_Principal">

                    <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                        <h1>Mot de passe réinitialisé</h1>
                    </div>
                    <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
                        <hr class="Hr_Haut"/>

                        Un nouveau mot de passe viens d'être généré aléatoirement et viens de vous<br/>
                        être envoyé par e-mail à l'adresse associée à votre compte.<br/><br/>

                        Pour revenir à l'accueil, merci de cliquer sur le bouton "Accueil".<br/>
                        <hr class="Hr_Bas">
                        <input type="button" class="Bouton_Annuler_Changer_Email_Accueil Bouton_Normal" value="Accueil" onclick="Ajax('pages/_LegacyPages/Accueil.php');" />
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
        <?php
    }

}

$class = new PasswordForgottenTerm();
$class->run();

<?php

namespace Pages;

require __DIR__ . '../../core/initialize.php';

class Bienvenue extends \PageHelper {

    public function run() {
        ?>
        <div class="Cadre_Principal">

            <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                <h1>Votre compte est activé, bon jeu !</h1>
            </div>
            <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
                <hr class="Hr_Haut"/>
                <p>
                    Félicitation, votre compte est désormais actif.<br /><br />Vous pouvez désormais vous connecter au jeu et au site.<br />
                    <br />
                    Toute l'équipe VamosMT2 vous souhaite un bon jeu !<br />
                </p>
                <hr class="Hr_Bas"/>
            </div>
        </form>
        </div>

    <?php
    }

}

$class = new Bienvenue();
$class->run();

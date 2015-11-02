<?php

namespace Pages;

require __DIR__ . '../../core/initialize.php';

class Paypal extends \PageHelper {

    public function run() {
        ?>

        <div class="Cadre_Principal">

            <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                <h1>Paiement validé, merci !</h1>
            </div>
            <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
                <hr class="Hr_Haut"/>
                <p>
                    Merci !<br />
                    <br />
                    Vous receverez vos vamonaies sous 24 heures.<br />
                </p>
                <hr class="Hr_Bas"/>
            </div>
        </div>

        <?php
    }

}

$class = new Paypal();
$class->run();

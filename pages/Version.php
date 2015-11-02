<?php

namespace Pages;

require __DIR__ . '../../core/initialize.php';

class Version extends \PageHelper {

    public function run() {
        ?>

        <div class="Cadre_Principal">

            <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                <h1>Version actuelle du jeu</h1>
            </div>
            <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
                <hr class="Hr_Haut"/>
                <p>
                    La version actuelle de VamosMT2 est la version: 5.1.9
                </p>
                <hr class="Hr_Bas"/>
            </div>
        </div>

        <?php
    }
}

$class = new Version();
$class->run();

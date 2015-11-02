<?php

namespace Pages;

require __DIR__ . '../../core/initialize.php';

class Personnage_Renommer_Validation extends \PageHelper {

    public function run() {
        ?>
        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Personnage renommé</h3>
            </div>

            <div class="box-body">
                Votre personnage a bien été renommé.<br/>
                Merci de votre confiance.
            </div>

            <div class="box-footer">
                <input type="button" class="btn btn-primary btn-flat" value="Accueil" onclick="Ajax('pages/Accueil.php');" />
            </div>
        </div>
        <?php
    }

}

$class = new Personnage_Renommer_Validation();
$class->run();

<?php

namespace Pages\MonPersonnage;

require __DIR__ . '../../../core/initialize.php';

class PersonnageRenameTerm extends \PageHelper {

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
                <input type="button" class="btn btn-primary btn-flat" value="Accueil" onclick="Ajax('pages/_LegacyPages/Accueil.php');" />
            </div>
        </div>
        <?php
    }

}

$class = new PersonnageRenameTerm();
$class->run();

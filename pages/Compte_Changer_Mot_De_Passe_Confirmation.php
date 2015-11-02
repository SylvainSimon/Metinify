<?php

namespace Pages;

require __DIR__ . '../../core/initialize.php';

class Compte_Changer_Mot_De_Passe_Confirmation extends \PageHelper {

    public function run() {
        ?>
        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Changement de mot de passe effectif</h3>
            </div>

            <div class="box-body">

                Votre mot de passe a bien été changé.<br/><br/>
                Pensez à le garder précieusement.<br/><br/>

                Pour revenir à l'accueil, merci de cliquer sur le bouton "Accueil".<br/>
            </div>

            <div class="box-footer">
                <input type="button" class="btn btn-primary btn-flat" value="Accueil" onclick="Ajax('pages/Accueil.php');" />
            </div>
        </div>
        <?php
    }

}

$class = new Compte_Changer_Mot_De_Passe_Confirmation();
$class->run();

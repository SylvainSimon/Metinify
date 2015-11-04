<?php

namespace Pages\MonCompte;

require __DIR__ . '../../../core/initialize.php';

class CodeEffacementChangeTerm extends \PageHelper {

    public $isProtected = true;
    
    public function run() {
        ?>


        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Code d'effacement changé</h3>
            </div>

            <div class="box-body">

                Votre code d'effacement a bien été changer.<br/><br/>
                Pensez à le garder précieusement.<br/><br/>

                Pour revenir à l'accueil, merci de cliquer sur le bouton "Accueil".
            </div>

            <div class="box-footer">
                <input type="button" class="btn btn-primary btn-flat" value="Accueil" onclick="Ajax('pages/_LegacyPages/Accueil.php');" />
            </div>
        </div>
        <?php
    }

}

$class = new CodeEffacementChangeTerm();
$class->run();

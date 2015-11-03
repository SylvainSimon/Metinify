<?php

namespace Pages\MonCompte;

require __DIR__ . '../../core/initialize.php';

class CodeEffacementCreateTerm extends \PageHelper {

    public function run() {
        ?>
        <div class = "box box-default flat">

            <div class = "box-header">
                <h3 class = "box-title">Code d'entrepôt crée</h3>
            </div>

            <div class="box-body">
                Votre code d'entrepot a bien été définie.<br/><br/>
                Pensez à le garder précieusement.<br/><br/>
            </div>

            <div class = "box-footer">
                <input type = "button" class = "btn btn-primary btn-flat" value = "Accueil" onclick = "Ajax('pages/Accueil.php');" />
            </div>
        </div>
        <?php
    }

}

$class = new CodeEffacementCreateTerm();
$class->run();

<?php

namespace Pages;

require __DIR__ . '../../core/initialize.php';

class Page_Introuvable extends \PageHelper {

    public function run() {
        ?>
        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Erreur 404</h3>
            </div>

            <div class="box-body">
                Cette page n'existe pas.
            </div>
        </div>
        <?php
    }

}

$class = new Page_Introuvable();
$class->run();

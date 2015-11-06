<?php

namespace Administration;

require __DIR__ . '../../core/initialize.php';

class Accueil_Seconde extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;

    public function run() {
        ?>
        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Administration du serveur</h3>
            </div>

            <div class="box-body">
                Bienvenue sur le panneau d'administration.
            </div>
        </div>
        <?php
    }

}

$class = new Accueil_Seconde();
$class->run();

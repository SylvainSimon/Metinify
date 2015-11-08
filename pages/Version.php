<?php

namespace Pages;

require __DIR__ . '../../core/initialize.php';

class Version extends \PageHelper {

    public function run() {
        ?>

        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Version du jeu</h3>
            </div>

            <div class="box-body">
                La version actuelle de VamosMT2 est la version <span class="text-green">5.1.9</span>

            </div>
        </div>

        <?php
    }

}

$class = new Version();
$class->run();

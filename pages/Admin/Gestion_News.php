<?php

namespace Administration;

require __DIR__ . '../../../core/initialize.php';

class Gestion_News extends \PageHelper {

    public function run() {
        ?>

        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Gestion des actualités</h3>
            </div>

            <div class="box-body">

                Nothing for moment...
            </div>
        </div>

        <?php
    }

}

$class = new Gestion_News();
$class->run();

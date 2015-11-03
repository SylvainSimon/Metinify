<?php

namespace Pages;

require __DIR__ . '../../../core/initialize.php';

class Contacts extends \PageHelper {

    public function run() {
        ?>


        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Support</h3>
            </div>

            <div class="box-body">
                Veuillez vous connecter au site afin de contacter le support VamosMT2.
            </div>
        </div>
        <?php
    }

}

$class = new Contacts();
$class->run();


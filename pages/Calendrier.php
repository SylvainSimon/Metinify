<?php

namespace Pages;

require __DIR__ . '../../core/initialize.php';

class Calendrier extends \PageHelper {

    public function run() {
        include 'Fonctions_Utiles.php';
        ?>
        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Calendrier des événements</h3>
            </div>

            <div class="box-body">
                <iframe src="https://calendar.google.com/calendar/embed??showTitle=0&showNav=0&showDate=0&showPrint=0&showTabs=0&showCalendars=0&showTz=0&height=600&wkst=2&hl=fr&bgcolor=%23333333&src=riv96o7mqtdj03f8vnd45u0s1k@group.calendar.google.com&color=%232952A3&ctz=Europe/Paris" width="100%" height="600" frameborder="0" scrolling="no"></iframe>
            </div>

        </div>
    <?php
    }

}

$class = new Calendrier();
$class->run();
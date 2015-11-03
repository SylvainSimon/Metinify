<?php

namespace Pages;

require __DIR__ . '../../../core/initialize.php';

class CDG extends \PageHelper {

    public $strTemplate = "CDU.html5.twig";

    public function run() {

        echo $this->template->render($this->arrayTemplate);
        
    }

}

$class = new CDG();
$class->run();

<?php

namespace pages\Marche;

require __DIR__ . '../../../core/initialize.php';

class Marche extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "Marche.html5.twig";

    public function run() {

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new Marche();
$class->run();

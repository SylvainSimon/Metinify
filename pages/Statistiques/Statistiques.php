<?php

namespace Pages\Statistiques;

require __DIR__ . '../../../core/initialize.php';

class Statistiques extends \PageHelper {

    public $strTemplate = "Statistiques.html5.twig";

    public function run() {

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new Statistiques();
$class->run();

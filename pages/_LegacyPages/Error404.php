<?php

namespace Pages;

require __DIR__ . '../../../core/initialize.php';

class Error404 extends \PageHelper {

    public $strTemplate = "Error404.html5.twig";

    public function run() {

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new Error404();
$class->run();

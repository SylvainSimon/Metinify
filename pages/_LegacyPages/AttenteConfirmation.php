<?php

namespace Pages;

require __DIR__ . '../../../core/initialize.php';

class AttenteConfirmation extends \PageHelper {

    public $arrayTemplate = [];
    public $strTemplate = "AttenteConfirmation.html5.twig";

    public function run() {

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new AttenteConfirmation();
$class->run();

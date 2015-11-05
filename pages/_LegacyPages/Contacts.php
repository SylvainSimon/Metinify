<?php

namespace Pages;

require __DIR__ . '../../../core/initialize.php';

class Contacts extends \PageHelper {

    public $strTemplate = "Contacts.html5.twig";

    public function run() {

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new Contacts();
$class->run();


<?php

namespace Pages;

require __DIR__ . '../../../core/initialize.php';

class PasswordForgottenTerm extends \PageHelper {

    public $strTemplate = "PasswordForgottenTerm.html5.twig";

    public function run() {

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new PasswordForgottenTerm();
$class->run();

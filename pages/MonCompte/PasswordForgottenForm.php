<?php

namespace Pages;

require __DIR__ . '../../../core/initialize.php';

class PasswordForgottenForm extends \PageHelper {

    public $strTemplate = "PasswordForgottenForm.html5.twig";

    public function run() {

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new PasswordForgottenForm();
$class->run();

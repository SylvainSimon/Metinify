<?php

namespace Pages\MonCompte;

require __DIR__ . '../../../core/initialize.php';

class PasswordChangeTerm extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "PasswordChangeTerm.html5.twig";

    public function run() {

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new PasswordChangeTerm();
$class->run();

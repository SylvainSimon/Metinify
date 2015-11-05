<?php

namespace Pages;

require __DIR__ . '../../../core/initialize.php';

class AccountActivationTerm extends \PageHelper {

    public $arrayTemplate = [];
    public $strTemplate = "AccountActivationTerm.html5.twig";

    public function run() {

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new AccountActivationTerm();
$class->run();

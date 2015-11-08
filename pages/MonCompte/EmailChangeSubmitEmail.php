<?php

namespace Pages\MonCompte;

require __DIR__ . '../../../core/initialize.php';

class EmailChangeSubmitEmail extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "EmailChangeSubmitEmail.html5.twig";

    public function run() {

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new EmailChangeSubmitEmail();
$class->run();

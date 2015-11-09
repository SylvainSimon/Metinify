<?php

namespace Pages\MonCompte;

require __DIR__ . '../../../../core/initialize.php';

class EmailChangeSendEmail extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "EmailChangeSendEmail.html5.twig";

    public function run() {

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new EmailChangeSendEmail();
$class->run();

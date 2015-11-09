<?php

namespace Pages\MonCompte;

require __DIR__ . '../../../../core/initialize.php';

class CodeEntrepotChangeTerm extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "CodeEntrepotChangeTerm.html5.twig";

    public function run() {

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new CodeEntrepotChangeTerm();
$class->run();

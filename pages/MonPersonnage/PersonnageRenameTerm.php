<?php

namespace Pages\MonPersonnage;

require __DIR__ . '../../../core/initialize.php';

class PersonnageRenameTerm extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "PersonnageRenameTerm.html5.twig";

    public function run() {
        
        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }
}

$class = new PersonnageRenameTerm();
$class->run();

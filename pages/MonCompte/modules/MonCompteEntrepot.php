<?php

namespace Pages\MonCompte;

require __DIR__ . '../../../../core/initialize.php';

class MonCompteEntrepot extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "MonCompteEntrepot.html5.twig";

    public function run() {

        $this->arrayTemplate["objAccount"] = $this->objAccount;
        
        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new MonCompteEntrepot();
$class->run();

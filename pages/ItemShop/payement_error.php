<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class payement_error extends \PageHelper {

    public $strTemplate = "payement_error.html5.twig";

    public function run() {
        
        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new payement_error();
$class->run();

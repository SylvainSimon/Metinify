<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class payement_false extends \PageHelper {

    public $strTemplate = "payement_false.html5.twig";

    public function run() {
        
        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new payement_false();
$class->run();

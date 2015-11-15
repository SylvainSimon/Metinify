<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class MarchePlace extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "MarchePlace.html5.twig";

    public function run() {
        
        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new MarchePlace();
$class->run();

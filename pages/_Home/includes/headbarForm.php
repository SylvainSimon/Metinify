<?php

namespace Home;

require __DIR__ . '../../../../core/initialize.php';

class headbarConnected extends \PageHelper {
    
    public $strTemplate = "headbarForm.html5.twig";

    public function run() {

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new headbarConnected();
$class->run();

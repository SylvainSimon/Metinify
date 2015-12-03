<?php

namespace Pages\Inscription;

require __DIR__ . '../../../core/initialize.php';

class InscriptionForm extends \PageHelper {
    
    public $strTemplate = "InscriptionForm.html5.twig";

    public function __construct() {
        parent::__construct();

        global $config;
        parent::moduleIsActivated($config->register["activate"]);
    }
    
    public function run() {
        
        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();

    }

}

$class = new InscriptionForm();
$class->run();

<?php

require __DIR__ . '../../../../../core/initialize.php';

class homeStarpass extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "homeStarpass.html5.twig";

    public function __construct() {
        parent::__construct();
        global $config;
        parent::moduleIsActivated($config->item_shop["rechargement"]["starpass"]["activate"]);
    }

    public function run() {

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new homeStarpass();
$class->run();

<?php

require __DIR__ . '../../../../../core/initialize.php';

class homeHipay extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "homeHipay.html5.twig";

    public function __construct() {
        parent::__construct();
        global $config;
        parent::moduleIsActivated($config["item_shop"]["rechargement"]["hipay"]["activate"]);
    }

    public function run() {

        $this->arrayTemplate["idAccount"] = $this->objAccount->getId();

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new homeHipay();
$class->run();

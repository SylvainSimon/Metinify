<?php

namespace Pages\Marche\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxGetSaleForm extends \ScriptHelper {

    public $isProtected = true;
    public $strTemplate = "ajaxGetSaleForm.html5.twig";
    public $objPlayer;

    public function __construct() {
        parent::__construct();

        global $request;
        $this->objPlayer = parent::VerifMonJoueur(\Encryption::decrypt($request->query->get("idPlayer")));
    }

    public function run() {

        $arrDevises = \DeviseHelper::getAll(false);

        $this->arrayTemplate["objPlayer"] = $this->objPlayer;
        $this->arrayTemplate["arrDevises"] = $arrDevises;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new ajaxGetSaleForm();
$class->run();

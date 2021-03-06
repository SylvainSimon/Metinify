<?php

namespace Pages\MonPersonnage;

require __DIR__ . '../../../core/initialize.php';

class PersonnageRenameForm extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "PersonnageRenameForm.html5.twig";
    public $objPlayer;

    public function __construct() {
        parent::__construct();

        global $config;
        parent::moduleIsActivated($config["mod_player"]["rename"]["activate"]);

        global $request;
        $this->objPlayer = parent::VerifMonJoueur(\Encryption::decrypt($request->query->get("idPlayer")));
    }

    public function run() {

        $this->arrayTemplate["objPlayer"] = $this->objPlayer;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new PersonnageRenameForm();
$class->run();

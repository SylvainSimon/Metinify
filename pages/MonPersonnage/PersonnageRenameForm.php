<?php

namespace Pages\MonPersonnage;

require __DIR__ . '../../../core/initialize.php';

class PersonnageRenameForm extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "PersonnageRenameForm.html5.twig";
    public $objPlayer;

    public function __construct() {
        parent::__construct();

        global $request;
        $this->objPlayer = parent::VerifMonJoueur($request->query->get("id_perso"));
    }

    public function run() {

        $this->arrayTemplate["objPlayer"] = $this->objPlayer;
        $this->arrayTemplate["idPlayer"] = \Encryption::encrypt($this->objPlayer->getId());

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new PersonnageRenameForm();
$class->run();

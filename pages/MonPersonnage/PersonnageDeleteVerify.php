<?php

namespace Pages\MonPersonnage;

require __DIR__ . '../../../core/initialize.php';

class PersonnageDeleteVerify extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "PersonnageDeleteVerify.html5.twig";
    public $objPlayer;

    public function __construct() {
        parent::__construct();
        global $request;
        $this->objPlayer = parent::VerifMonJoueur(\Encryption::decrypt($request->query->get("idPlayer")));
    }

    public function run() {

        $this->arrayTemplate["idPlayer"] = $this->objPlayer->getId();
        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new PersonnageDeleteVerify();
$class->run();

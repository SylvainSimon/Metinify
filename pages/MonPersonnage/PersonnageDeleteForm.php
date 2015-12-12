<?php

namespace Pages\MonPersonnage;

require __DIR__ . '../../../core/initialize.php';

class PersonnageDeleteForm extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "PersonnageDeleteForm.html5.twig";
    public $objPlayer;

    public function __construct() {
        parent::__construct();
        
        global $config;
        parent::moduleIsActivated($config["mod_player"]["delete"]["activate"]);
        
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

$class = new PersonnageDeleteForm();
$class->run();

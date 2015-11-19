<?php

namespace Pages\MonPersonnage;

require __DIR__ . '../../../core/initialize.php';

class PersonnageDeleteVerify extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "PersonnageDeleteVerify.html5.twig";

    public function run() {

        global $request;

        $idPlayer = $request->request->get("id_personnage");
        
        $this->arrayTemplate["idPlayer"] = $idPlayer;
        $this->arrayTemplate["idCompte"] = $this->objAccount->getId();

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new PersonnageDeleteVerify();
$class->run();

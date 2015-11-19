<?php

namespace Pages\MonPersonnage;

require __DIR__ . '../../../core/initialize.php';

class PersonnageDeleteForm extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "PersonnageDeleteForm.html5.twig";

    public function run() {

        global $request;

        $idPlayer = $request->request->get("id_perso");
        $objPlayer = Player\PlayerHelper::getPlayerRepository()->find($idPlayer);

        $this->arrayTemplate["idPlayer"] = $idPlayer;
        $this->arrayTemplate["objPlayer"] = $objPlayer;

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new PersonnageDeleteForm();
$class->run();

<?php

namespace Pages\Inscription;

require __DIR__ . '../../../core/initialize.php';

class InscriptionTerm extends \PageHelper {

    public $strTemplate = "InscriptionTerm.html5.twig";

    public function run() {

        global $request;
        global $session;

        $this->arrayTemplate["result"] = $request->query->get("Resultat");
        $this->arrayTemplate["NomTemporaire"] = $session->get("NomTemporaire");

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new InscriptionTerm();
$class->run();

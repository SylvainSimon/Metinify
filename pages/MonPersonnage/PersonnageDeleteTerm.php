<?php

namespace Pages\MonPersonnage;

require __DIR__ . '../../../core/initialize.php';

class PersonnageDeleteTerm extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "PersonnageDeleteTerm.html5.twig";

    public function run() {

        global $request;

        $result = $request->query->get("result");
        $this->arrayTemplate["result"] = $result;

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new PersonnageDeleteTerm();
$class->run();

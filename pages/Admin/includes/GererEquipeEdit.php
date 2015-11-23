<?php

namespace Administration;

require __DIR__ . '../../../../core/initialize.php';

class GererNews extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    public $strTemplate = "GererEquipeEdit.html5.twig";

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::GERER_EQUIPE);
    }

    public function run() {

        global $request;
        $mode = $request->query->get("mode");

        if ($mode == "create") {
            $objGmList = new \Common\Entity\Gmlist();
        } else if ($mode == "mod") {
            $id = $request->query->get("idMembre");
            $objGmList = \Common\CommonHelper::getGmlistRepository()->find($id);
        }

        $this->arrayTemplate["objGmList"] = $objGmList;
        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new GererNews();
$class->run();

<?php

namespace Administration;

require __DIR__ . '../../../core/initialize.php';

class GererNews extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    public $strTemplate = "GererNewsEdit.html5.twig";

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::GERER_NEWS);
    }

    public function run() {

        global $request;
        $mode = $request->query->get("mode");

        if ($mode == "create") {
            $objActualites = new \Site\Entity\Actualites();
        } else if ($mode == "mod") {
            $id = $request->query->get("idNews");
            $objActualites = \Site\SiteHelper::getActualitesRepository()->find($id);
        }

        $this->arrayTemplate["objActualites"] = $objActualites;
        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new GererNews();
$class->run();

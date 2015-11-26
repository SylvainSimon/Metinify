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
            $objAdminNews = new \Site\Entity\AdminNews();
        } else if ($mode == "mod") {
            $id = $request->query->get("idNews");
            $objAdminNews = \Site\SiteHelper::getAdminNewsRepository()->find($id);
        }

        $this->arrayTemplate["objAdminNews"] = $objAdminNews;
        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new GererNews();
$class->run();

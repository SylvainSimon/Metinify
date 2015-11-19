<?php

namespace Pages;

require __DIR__ . '../../../../core/initialize.php';

class HistoryConnexion extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "HistoryConnexion.html5.twig";

    public function run() {

        $arrObjLogsConnexion = \Site\SiteHelper::getLogsConnexionRepository()->findByIdCompteAndCompte($this->objAccount->getId(), $this->objAccount->getLogin(), 20);
        
        $this->arrayTemplate["arrObjLogsConnexion"] = $arrObjLogsConnexion;
        
        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new HistoryConnexion();
$class->run();

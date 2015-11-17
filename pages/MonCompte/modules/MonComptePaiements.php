<?php

namespace Pages\MonCompte;

require __DIR__ . '../../../../core/initialize.php';

class MonComptePaiements extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "MonComptePaiements.html5.twig";

    public function run() {

        $totalMonnaie = \Site\SiteHelper::getLogsRechargementsRepository()->findTotalMonnaieByIdACcount($this->objAccount->getId());
        $arrObjLogsRechargement = \Site\SiteHelper::getLogsRechargementsRepository()->findByIdAccount($this->objAccount->getId());
        
        $this->arrayTemplate["arrObjLogsRechargement"] = $arrObjLogsRechargement;
        $this->arrayTemplate["totalMonnaie"] = $totalMonnaie;
        
        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new MonComptePaiements();
$class->run();

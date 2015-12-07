<?php

namespace Pages\MonCompte;

require __DIR__ . '../../../../core/initialize.php';

class MonCompteEntrepotIS extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "MonCompteEntrepotIS.html5.twig";

    public function run() {

        $arrObjItems = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(0, 45, $this->objAccount->getId(), "MALL");
        $templateEntrepotIs = $this->objTwig->loadTemplate("ajaxEntrepotIS.html5.twig");
        $viewEntrepotIs = $templateEntrepotIs->render(["arrObjItems" => $arrObjItems, "iDepart" => 0]);

        $arrObjLogAchats = \Site\SiteHelper::getLogAchatsRepository()->findByIdAccount($this->objAccount->getId());
        
        $this->arrayTemplate["viewEntrepotIs"] = $viewEntrepotIs;
        $this->arrayTemplate["arrObjLogAchats"] = $arrObjLogAchats;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new MonCompteEntrepotIS();
$class->run();

<?php

namespace Pages\MonCompte;

require __DIR__ . '../../../../core/initialize.php';

class MonCompteEntrepot extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "MonCompteEntrepot.html5.twig";

    public function run() {

        $arrObjItems = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(0, 135, $this->objAccount->getId(), "SAFEBOX");
        $arrObjItemsPage1 = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(0, 44, $this->objAccount->getId(), "SAFEBOX");
        $templateEntrepotPage1 = $this->objTwig->loadTemplate("ajaxEntrepotIS.html5.twig");
        $viewEntrepotPage1 = $templateEntrepotPage1->render(["arrObjItems" => $arrObjItemsPage1, "iDepart" => 0]);
        
        $this->arrayTemplate["objAccount"] = $this->objAccount;
        $this->arrayTemplate["viewEntrepotPage1"] = $viewEntrepotPage1;
        $this->arrayTemplate["arrObjItems"] = $arrObjItems;
        
        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new MonCompteEntrepot();
$class->run();

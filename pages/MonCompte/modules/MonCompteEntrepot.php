<?php

namespace Pages\MonCompte;

require __DIR__ . '../../../../core/initialize.php';

class MonCompteEntrepot extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "MonCompteEntrepot.html5.twig";

    public function run() {

        $arrObjItemsPage1 = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(0, 44, $this->objAccount->getId(), "SAFEBOX");
        $templateEntrepotPage1 = $this->objTwig->loadTemplate("ajaxEntrepotPage.html5.twig");
        $viewEntrepotPage1 = $templateEntrepotPage1->render(["arrObjItems" => $arrObjItemsPage1, "iDepart" => 0]);
        
        $this->arrayTemplate["objAccount"] = $this->objAccount;
        $this->arrayTemplate["viewEntrepotPage1"] = $viewEntrepotPage1;
        
        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new MonCompteEntrepot();
$class->run();

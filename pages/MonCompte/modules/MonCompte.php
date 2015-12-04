<?php

namespace Pages\MonCompte;

require __DIR__ . '../../../../core/initialize.php';

class MonCompte extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "MonCompte.html5.twig";

    public function run() {

        $templateGenerale = $this->objTwig->loadTemplate("MonCompteGenerale.html5.twig");
        $arrObjPlayers = \Player\PlayerHelper::getPlayerRepository()->findPlayers($this->objAccount->getId());
        $objAccount = $this->objAccount;
        $objPlayerIndex = \Player\PlayerHelper::getPlayerIndexRepository()->find($this->objAccount->getId());
        $objSafebox = \Player\PlayerHelper::getSafeboxRepository()->findByIdCompte($this->objAccount->getId());
        
        $arrObjItemsPage1 = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(0, 44, $this->objAccount->getId(), "SAFEBOX");
        $templateEntrepotPage1 = $this->objTwig->loadTemplate("ajaxEntrepotPage.html5.twig");
        $viewEntrepotPage1 = $templateEntrepotPage1->render(["arrObjItems" => $arrObjItemsPage1, "iDepart" => 0]);

        $templateEntrepot = $this->objTwig->loadTemplate("MonCompteEntrepot.html5.twig");
        $viewEntrepot = $templateEntrepot->render([
            "objAccount" => $this->objAccount,
            "viewEntrepotPage1" => $viewEntrepotPage1,
        ]);
        
        $viewGenerale = $templateGenerale->render([
            "arrObjPlayers" => $arrObjPlayers,
            "objAccount" => $objAccount,
            "viewEntrepot" => $viewEntrepot,
            "objPlayerIndex" => $objPlayerIndex,
            "objSafebox" => $objSafebox
        ]);

        $this->arrayTemplate["viewGenerale"] = $viewGenerale;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new MonCompte();
$class->run();

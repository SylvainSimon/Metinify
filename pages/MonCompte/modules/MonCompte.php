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
        
        $viewGenerale = $templateGenerale->render([
            "arrObjPlayers" => $arrObjPlayers,
            "objAccount" => $objAccount,
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

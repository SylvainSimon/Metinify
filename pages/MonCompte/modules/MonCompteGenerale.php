<?php

namespace Pages\MonCompte;

require __DIR__ . '../../../../core/initialize.php';

class MonCompteGenerale extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "MonCompteGenerale.html5.twig";

    public function run() {

        $arrObjPlayers = \Player\PlayerHelper::getPlayerRepository()->findPlayers($this->objAccount->getId());
        $objAccount = $this->objAccount;
        $objPlayerIndex = \Player\PlayerHelper::getPlayerIndexRepository()->find($this->objAccount->getId());
        $objSafebox = \Player\PlayerHelper::getSafeboxRepository()->findByIdCompte($this->objAccount->getId());

        $this->arrayTemplate["objAccount"] = $objAccount;
        $this->arrayTemplate["objPlayerIndex"] = $objPlayerIndex;
        $this->arrayTemplate["objSafebox"] = $objSafebox;
        $this->arrayTemplate["arrObjPlayers"] = $arrObjPlayers;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new MonCompteGenerale();
$class->run();

<?php

namespace Pages\MonCompte;

require __DIR__ . '../../../core/initialize.php';

class MonPersonnageGenerale extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "MonPersonnageGenerale.html5.twig";

    public function run() {

        global $request;
        $idPlayer = $request->query->get("id");
        
        $objPlayer = \Player\PlayerHelper::getPlayerRepository()->find($idPlayer);
        $objPlayerIndex = \Player\PlayerHelper::getPlayerIndexRepository()->find($objPlayer->getId());
        $calculateGrade = \Player\PlayerHelper::calculateGrade($objPlayer->getAlignment());
        $isConnected = \Player\PlayerHelper::isConnected($objPlayer, 30);
        $haveGuild = \Player\PlayerHelper::haveGuild($objPlayer->getId());
        $localisation = json_decode(\Localisation::localize(0, $objPlayer, $isConnected));
        
        $this->arrayTemplate["objPlayer"] = $objPlayer;
        $this->arrayTemplate["objPlayerIndex"] = $objPlayerIndex;
        $this->arrayTemplate["localisation"] = $localisation;
        $this->arrayTemplate["isConnected"] = $isConnected;
        $this->arrayTemplate["calculateGrade"] = $calculateGrade;
        $this->arrayTemplate["objAccount"] = $this->objAccount;
        $this->arrayTemplate["haveGuild"] = $haveGuild;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new MonPersonnageGenerale();
$class->run();

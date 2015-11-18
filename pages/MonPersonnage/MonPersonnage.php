<?php

namespace Pages\MonPersonnage;

require __DIR__ . '../../../core/initialize.php';

class MonPersonnage extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "MonPersonnage.html5.twig";

    public function __construct() {
        parent::__construct();

        global $request;
        parent::VerifMonJoueur($request->query->get("id"));
    }

    public function run() {

        global $request;
        $idPlayer = $request->query->get("id");

        $templateGenerale = $this->objTwig->loadTemplate("MonPersonnageGenerale.html5.twig");
        $objPlayer = \Player\PlayerHelper::getPlayerRepository()->find($idPlayer);
        $objPlayerIndex = \Player\PlayerHelper::getPlayerIndexRepository()->find($objPlayer->getId());
        $calculateGrade = \Player\PlayerHelper::calculateGrade($objPlayer->getAlignment());
        $haveGuild = \Player\PlayerHelper::haveGuild($objPlayer->getId());
        $isConnected = \Player\PlayerHelper::isConnected($objPlayer, 30);

        $localisation = json_decode(\Localisation::localize(0, $objPlayer, $isConnected));

        $viewGenerale = $templateGenerale->render([
            "objAccount" => $this->objAccount,
            "objPlayer" => $objPlayer,
            "objPlayerIndex" => $objPlayerIndex,
            "localisation" => $localisation,
            "isConnected" => $isConnected,
            "calculateGrade" => $calculateGrade,
            "haveGuild" => $haveGuild,
        ]);

        $this->arrayTemplate["viewGenerale"] = $viewGenerale;
        $this->arrayTemplate["idPlayer"] = $idPlayer;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new MonPersonnage();
$class->run();

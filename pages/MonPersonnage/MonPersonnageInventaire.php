<?php

namespace Pages\MonPersonnage;

require __DIR__ . '../../../core/initialize.php';

class MonPersonnageInventaire extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "playerInventaire.html5.twig";

    public function run() {

        global $request;
        $idPlayer = $request->query->get("id");
        
        $arrObjItems = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(0, 180, $idPlayer, "INVENTORY");
        $arrObjItemsPage1 = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(0, 44, $idPlayer, "INVENTORY");
        $templateEntrepotPage1 = $this->objTwig->loadTemplate("ajaxEntrepotIS.html5.twig");
        $viewEntrepotPage1 = $templateEntrepotPage1->render(["arrObjItems" => $arrObjItemsPage1, "iDepart" => 0]);
        
        $this->arrayTemplate["objAccount"] = $this->objAccount;
        $this->arrayTemplate["viewInventairePage1"] = $viewEntrepotPage1;
        $this->arrayTemplate["arrObjItems"] = $arrObjItems;
        $this->arrayTemplate["idPlayer"] = $idPlayer;
        
        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new MonPersonnageInventaire();
$class->run();

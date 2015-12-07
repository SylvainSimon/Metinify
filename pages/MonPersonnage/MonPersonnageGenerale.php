<?php

namespace Pages\MonCompte;

require __DIR__ . '../../../core/initialize.php';

class MonPersonnageGenerale extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "MonPersonnageGenerale.html5.twig";

    public function run() {

        global $request;
        $idPlayer = $request->query->get("id");

        $templateEquipement = $this->objTwig->loadTemplate("playerEquipement.html5.twig");
        $tailleImageEquipement = getimagesize("../../images/equipement.png");
        $objItemArme = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(4, 4, $idPlayer, "EQUIPMENT", true);
        $objItemArmure = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(0, 0, $idPlayer, "EQUIPMENT", true);
        $objItemCasque = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(1, 1, $idPlayer, "EQUIPMENT", true);
        $objItemBouclier = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(10, 10, $idPlayer, "EQUIPMENT", true);
        $objItemBracelet = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(3, 3, $idPlayer, "EQUIPMENT", true);
        $objItemBoucle = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(6, 6, $idPlayer, "EQUIPMENT", true);
        $objItemCollier = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(5, 5, $idPlayer, "EQUIPMENT", true);
        $objItemChaussure = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(2, 2, $idPlayer, "EQUIPMENT", true);
        $objItemFleche = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(9, 9, $idPlayer, "EQUIPMENT", true);
        $objItemSpecial1 = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(7, 7, $idPlayer, "EQUIPMENT", true);
        $objItemSpecial2 = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(8, 8, $idPlayer, "EQUIPMENT", true);
        $viewEquipement = $templateEquipement->render([
            "tailleImageEquipementWidth" => $tailleImageEquipement[0],
            "tailleImageEquipementHeight" => $tailleImageEquipement[1],
            "objItemArme" => $objItemArme,
            "objItemArmure" => $objItemArmure,
            "objItemCasque" => $objItemCasque,
            "objItemBouclier" => $objItemBouclier,
            "objItemBracelet" => $objItemBracelet,
            "objItemBoucle" => $objItemBoucle,
            "objItemCollier" => $objItemCollier,
            "objItemChaussure" => $objItemChaussure,
            "objItemFleche" => $objItemFleche,
            "objItemSpecial1" => $objItemSpecial1,
            "objItemSpecial2" => $objItemSpecial2
        ]);
        

        $arrObjItems = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(0, 180, $idPlayer, "INVENTORY");
        $arrObjItemsPage1 = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(0, 44, $idPlayer, "INVENTORY");
        $templateEntrepotPage1 = $this->objTwig->loadTemplate("ajaxInventairePage.html5.twig");
        $viewEntrepotPage1 = $templateEntrepotPage1->render(["arrObjItems" => $arrObjItemsPage1, "iDepart" => 0]);
        
        $templateInventaire = $this->objTwig->loadTemplate("playerInventaire.html5.twig");
        $viewInventaire = $templateInventaire->render([
            "objAccount" => $this->objAccount,
            "viewInventairePage1" => $viewEntrepotPage1,
            "arrObjItems" => $arrObjItems,
            "idPlayer" => $idPlayer
        ]);


        $objPlayer = \Player\PlayerHelper::getPlayerRepository()->find($idPlayer);
        $objPlayerIndex = \Player\PlayerHelper::getPlayerIndexRepository()->find($objPlayer->getId());
        $calculateGrade = \Player\PlayerHelper::calculateGrade($objPlayer->getAlignment());
        $isConnected = \Player\PlayerHelper::isConnected($objPlayer, 30);
        $haveGuild = \Player\PlayerHelper::haveGuild($objPlayer->getId());
        $localisation = json_decode(\Localisation::localize(0, $objPlayer, $isConnected));
        $objMarriage = \Player\PlayerHelper::getMarriageRepository()->findMariageByIdPlayer($objPlayer->getId());

        $this->arrayTemplate["viewEquipement"] = $viewEquipement;
        $this->arrayTemplate["viewInventaire"] = $viewInventaire;
        $this->arrayTemplate["objPlayer"] = $objPlayer;
        $this->arrayTemplate["objPlayerIndex"] = $objPlayerIndex;
        $this->arrayTemplate["localisation"] = $localisation;
        $this->arrayTemplate["isConnected"] = $isConnected;
        $this->arrayTemplate["calculateGrade"] = $calculateGrade;
        $this->arrayTemplate["objAccount"] = $this->objAccount;
        $this->arrayTemplate["haveGuild"] = $haveGuild;
        $this->arrayTemplate["objMarriage"] = $objMarriage;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new MonPersonnageGenerale();
$class->run();

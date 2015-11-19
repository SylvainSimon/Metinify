<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class MarchePlayerInfo extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "MarchePlayerInfo.html5.twig";

    public function run() {

        global $request;
        $idMarchePersonnage = $request->query->get("id_marche_perso");
        $objMarchePersonnage = \Site\SiteHelper::getMarchePersonnagesRepository()->find($idMarchePersonnage);
        $objPlayer = \Player\PlayerHelper::getPlayerRepository()->find($objMarchePersonnage->getIdPersonnage());

        $objItemArme = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(4, 4, $objPlayer->getId(), "EQUIPMENT", true);
        $objItemArmure = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(0, 0, $objPlayer->getId(), "EQUIPMENT", true);
        $objItemCasque = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(1, 1, $objPlayer->getId(), "EQUIPMENT", true);
        $objItemBouclier = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(10, 10, $objPlayer->getId(), "EQUIPMENT", true);
        $objItemBracelet = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(3, 3, $objPlayer->getId(), "EQUIPMENT", true);
        $objItemBoucle = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(6, 6, $objPlayer->getId(), "EQUIPMENT", true);
        $objItemCollier = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(5, 5, $objPlayer->getId(), "EQUIPMENT", true);
        $objItemChaussure = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(2, 2, $objPlayer->getId(), "EQUIPMENT", true);
        $objItemFleche = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(9, 9, $objPlayer->getId(), "EQUIPMENT", true);
        $objItemSpecial1 = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(7, 7, $objPlayer->getId(), "EQUIPMENT", true);
        $objItemSpecial2 = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(8, 8, $objPlayer->getId(), "EQUIPMENT", true);

        $arrObjItemsPage1 = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(0, 44, $objPlayer->getId(), "INVENTORY");
        $templateEntrepotPage1 = $this->objTwig->loadTemplate("ajaxEntrepotIS.html5.twig");
        $viewEntrepotPage1 = $templateEntrepotPage1->render(["arrObjItems" => $arrObjItemsPage1, "iDepart" => 0]);

        $this->arrayTemplate["viewInventairePage1"] = $viewEntrepotPage1;
        $this->arrayTemplate["objItemArme"] = $objItemArme;
        $this->arrayTemplate["objItemArmure"] = $objItemArmure;
        $this->arrayTemplate["objItemCasque"] = $objItemCasque;
        $this->arrayTemplate["objItemBouclier"] = $objItemBouclier;
        $this->arrayTemplate["objItemBracelet"] = $objItemBracelet;
        $this->arrayTemplate["objItemBoucle"] = $objItemBoucle;
        $this->arrayTemplate["objItemCollier"] = $objItemCollier;
        $this->arrayTemplate["objItemChaussure"] = $objItemChaussure;
        $this->arrayTemplate["objItemFleche"] = $objItemFleche;
        $this->arrayTemplate["objItemSpecial1"] = $objItemSpecial1;
        $this->arrayTemplate["objItemSpecial2"] = $objItemSpecial2;
        $this->arrayTemplate["objPlayer"] = $objPlayer;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new MarchePlayerInfo();
$class->run();

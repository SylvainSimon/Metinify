<?php

namespace Pages\MonPersonnage;

require __DIR__ . '../../../core/initialize.php';

class MonPersonnageEquipement extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "playerEquipement.html5.twig";

    public function run() {

        global $request;
        $idPlayer = $request->query->get("id");
        
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

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new MonPersonnageEquipement();
$class->run();

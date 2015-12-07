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
        $calculateGrade = \Player\PlayerHelper::calculateGrade($objPlayer->getAlignment());
        $localisation = json_decode(\Localisation::localize(0, $objPlayer, false));
        
        $templateEquipement = $this->objTwig->loadTemplate("playerEquipement.html5.twig");
        $tailleImageEquipement = getimagesize("../../images/equipement.png");
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
        
        $arrObjItemsInventairePage1 = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(0, 44, $objPlayer->getId(), "INVENTORY");
        $templateInventairePage1 = $this->objTwig->loadTemplate("ajaxInventairePage.html5.twig");
        $viewInventairePage1 = $templateInventairePage1->render(["arrObjItems" => $arrObjItemsInventairePage1, "iDepart" => 0]);
        
        $templateInventaire = $this->objTwig->loadTemplate("playerInventaire.html5.twig");
        $viewInventaire = $templateInventaire->render([
            "objAccount" => $this->objAccount,
            "viewInventairePage1" => $viewInventairePage1,
            "idPlayer" => $objPlayer->getId()
        ]);

        $this->arrayTemplate["viewInventaire"] = $viewInventaire;
        $this->arrayTemplate["viewEquipement"] = $viewEquipement;
        $this->arrayTemplate["calculateGrade"] = $calculateGrade;
        $this->arrayTemplate["objPlayer"] = $objPlayer;
        $this->arrayTemplate["localisation"] = $localisation;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new MarchePlayerInfo();
$class->run();

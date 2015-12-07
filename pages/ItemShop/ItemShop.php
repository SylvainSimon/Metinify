<?php

namespace Pages\ItemShop;

require __DIR__ . '../../../core/initialize.php';

class ItemShop extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "ItemShop.html5.twig";

    public function __construct() {
        parent::__construct();
        global $config;
        parent::moduleIsActivated($config->item_shop["activate"]);
    }

    public function run() {

        $idCategorie = 8;
        
        $arrObjItemshop = \Site\SiteHelper::getItemshopRepository()->findItemsByCategorie($idCategorie, true);
        $templateTop = $this->objTwig->loadTemplate("ajaxCategorieGetArticles.html5.twig");
        $viewItemshopDefault = $templateTop->render(["arrObjItemshop" => $arrObjItemshop]);

        $arrObjItemshopCategoriesCache = \Site\SiteHelper::getItemshopCategoriesRepository()->findCategoriesNotEmpty();
        $this->arrayTemplate["arrObjItemshopCategories"] = $arrObjItemshopCategoriesCache;
        $this->arrayTemplate["viewItemshopDefault"] = $viewItemshopDefault;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new ItemShop();
$class->run();

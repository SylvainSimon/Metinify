<?php

namespace Pages\ItemShop;

require __DIR__ . '../../../core/initialize.php';

class ItemShop extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "ItemShop.html5.twig";

    public function run() {

        $arrObjItemshop = \Site\SiteHelper::getItemshopRepository()->findItemsByCategorie(8, true);
        $templateTop = $this->objTwig->loadTemplate("ajaxCategorieGetArticles.html5.twig");
        $viewItemshopDefault = $templateTop->render(["arrObjItemshop" => $arrObjItemshop]);

        $arrObjItemshopCategories = \Site\SiteHelper::getItemshopCategoriesRepository()->findCategoriesNotEmpty();
        $this->arrayTemplate["arrObjItemshopCategories"] = $arrObjItemshopCategories;
        $this->arrayTemplate["viewItemshopDefault"] = $viewItemshopDefault;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new ItemShop();
$class->run();

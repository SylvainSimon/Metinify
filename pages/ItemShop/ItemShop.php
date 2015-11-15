<?php

namespace Pages\ItemShop;

require __DIR__ . '../../../core/initialize.php';

class ItemShop extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "ItemShop.html5.twig";

    public function run() {

        $idCategorie = 8;
        $cacheManager = \CacheHelper::getCacheManager();
        if ($cacheManager->isExisting("isArrObjItemshopCat" . $idCategorie)) {
            $arrObjItemshop = $cacheManager->get("isArrObjItemshopCat" . $idCategorie);
        } else {
            $arrObjItemshop = \Site\SiteHelper::getItemshopRepository()->findItemsByCategorie($idCategorie, true);
            $cacheManager->set("isArrObjItemshopCat" . $idCategorie, $arrObjItemshop, 3600);
        }
        $templateTop = $this->objTwig->loadTemplate("ajaxCategorieGetArticles.html5.twig");
        $viewItemshopDefault = $templateTop->render(["arrObjItemshop" => $arrObjItemshop]);

        
        if ($cacheManager->isExisting("isArrObjItemshopCategories")) {
            $arrObjItemshopCategoriesCache = $cacheManager->get("isArrObjItemshopCategories");
        } else {
            $arrObjItemshopCategoriesCache = \Site\SiteHelper::getItemshopCategoriesRepository()->findCategoriesNotEmpty();
            $cacheManager->set("isArrObjItemshopCategories", $arrObjItemshopCategoriesCache, 3600);
        }

        $this->arrayTemplate["arrObjItemshopCategories"] = $arrObjItemshopCategoriesCache;
        $this->arrayTemplate["viewItemshopDefault"] = $viewItemshopDefault;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new ItemShop();
$class->run();

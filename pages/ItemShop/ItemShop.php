<?php

namespace Pages\ItemShop;

require __DIR__ . '../../../core/initialize.php';

class ItemShop extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "ItemShop.html5.twig";

    public function run() {

        $arrObjItemshopCategories = \Site\SiteHelper::getItemshopCategoriesRepository()->findCategoriesNotEmpty();
        $this->arrayTemplate["arrObjItemshopCategories"] = $arrObjItemshopCategories;
        
        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();

    }

}

$class = new ItemShop();
$class->run();

<?php

namespace Administration;

require __DIR__ . '../../../../../core/initialize.php';

class GererItemShopCategoriesEdit extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    public $strTemplate = "GererItemShopCategoriesEdit.html5.twig";

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::GERER_ITEMSHOP_CATEGORIE);
    }

    public function run() {

        global $request;
        $mode = $request->query->get("mode");

        if ($mode == "create") {
            $objItemshopCategories = new \Site\Entity\ItemshopCategories();
        } else if ($mode == "mod") {
            $id = $request->query->get("idCategorie");
            $objItemshopCategories = \Site\SiteHelper::getItemshopCategoriesRepository()->findByCat($id);
        }
        
        $this->arrayTemplate["objItemshopCategories"] = $objItemshopCategories;

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new GererItemShopCategoriesEdit();
$class->run();

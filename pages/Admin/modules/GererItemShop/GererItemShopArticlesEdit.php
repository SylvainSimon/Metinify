<?php

namespace Administration;

require __DIR__ . '../../../../../core/initialize.php';

class GererItemShopArticlesEdit extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    public $strTemplate = "GererItemShopArticlesEdit.html5.twig";

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::GERER_ITEMSHOP);
    }

    public function run() {

        global $request;
        $mode = $request->query->get("mode");

        if ($mode == "create") {
            $objItemshop = new \Site\Entity\Itemshop();
        } else if ($mode == "mod") {
            $id = $request->query->get("idArticle");
            $objItemshop = \Site\SiteHelper::getItemshopRepository()->find($id);

            if ($objItemshop->getType() != "2") {
                $objItemProto = \Player\PlayerHelper::getItemProtoRepository()->find($objItemshop->getIdItem());
                $this->arrayTemplate["objItemProto"] = $objItemProto;
            }
        }
        
        $arrObjItemShopCategorie = \Site\SiteHelper::getItemshopCategoriesRepository()->findAll();

        $this->arrayTemplate["objItemshop"] = $objItemshop;
        $this->arrayTemplate["arrObjItemShopCategorie"] = $arrObjItemShopCategorie;

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new GererItemShopArticlesEdit();
$class->run();

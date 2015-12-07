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

        //$objPlayer = null;
        //$objAccount = null;

        if ($mode == "create") {
            $objItemshop = new \Site\Entity\Itemshop();
        } else if ($mode == "mod") {
            $id = $request->query->get("idArticle");
            $objItemshop = \Site\SiteHelper::getItemshopRepository()->find($id);

            if ($objItemshop->getType() != "2") {
                $objItemProto = \Player\PlayerHelper::getItemProtoRepository()->find($objItemshop->getIdItem());
                $this->arrayTemplate["objItemProto"] = $objItemProto;
            }
            //$objPlayer = \Player\PlayerHelper::getPlayerRepository()->findByName($objItemshop->getMname());
            //$objAccount = \Account\AccountHelper::getAccountRepository()->findAccountByLogin($objItemshop->getMaccount());
        }
        
        $arrObjItemShopCategorie = \Site\SiteHelper::getItemshopCategoriesRepository()->findAll();

        //$this->arrayTemplate["arrAuthority"] = \AuthorityHelper::getAll();
        $this->arrayTemplate["objItemshop"] = $objItemshop;
        $this->arrayTemplate["arrObjItemShopCategorie"] = $arrObjItemShopCategorie;
        //$this->arrayTemplate["objPlayer"] = $objPlayer;
        //$this->arrayTemplate["objAccount"] = $objAccount;

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new GererItemShopArticlesEdit();
$class->run();

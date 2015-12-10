<?php

namespace Administration;

require __DIR__ . '../../../../../core/initialize.php';

class GererItemShop extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    public $strTemplate = "GererItemShop.html5.twig";

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::GERER_ITEMSHOP);
    }

    public function run() {

        $sColumns = '';
        $sColumns .= '{ "mData": "article", "bSortable": true },';
        $sColumns .= '{ "mData": "nombre", "bSortable": true, "sWidth": "50px" },';
        $sColumns .= '{ "mData": "categorie", "bSortable": true, "sWidth": "140px" },';
        $sColumns .= '{ "mData": "prix", "bSortable": true, "sWidth": "80px" },';
        $sColumns .= '{ "mData": "actions", "bSortable": false, "sWidth": "55px" },';

        $sFilterColumns = '';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "select", values: [' . $this->getCategoriesForDatatable() . '] },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= 'null,';

        $templateItemShopArticles = $this->objTwig->loadTemplate("GererItemShopArticles.html5.twig");        
        $viewItemShopArticles = $templateItemShopArticles->render([
            "dtColumns" => rtrim($sColumns, ','),
            "dtFilterColumns" => rtrim($sFilterColumns, ','),
            "ajaxSource" => "pages/Admin/modules/GererItemShop/ajax/listGererItemShopArticles.php?sEcho=1",
        ]);
        
        $this->arrayTemplate["rightGererITemShopCategorie"] = $this->HaveTheRight(\DroitsHelper::GERER_ITEMSHOP_CATEGORIE);
        $this->arrayTemplate["rightGererITemShopLogsAchats"] = $this->HaveTheRight(\DroitsHelper::GERER_ITEMSHOP_LOGS_ACHATS);
        $this->arrayTemplate["viewItemShopArticles"] = $viewItemShopArticles;
        
        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }
    
    protected function getCategoriesForDatatable() {

        $return = "";
        $arrObjItemshopCategorie = \Site\SiteHelper::getItemshopCategoriesRepository()->findAll();

        if (count($arrObjItemshopCategorie) > 0) {
            foreach ($arrObjItemshopCategorie AS $objItemshopCategorie) {
                $return .= '"' . $objItemshopCategorie->getNom() . '",';
            }
        }

        return rtrim($return, ',');
    }

}

$class = new GererItemShop();
$class->run();

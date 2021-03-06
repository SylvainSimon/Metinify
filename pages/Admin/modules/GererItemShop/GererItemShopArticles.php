<?php

namespace Administration;

require __DIR__ . '../../../../../core/initialize.php';

class GererItemShopArticles extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    public $strTemplate = "GererItemShopArticles.html5.twig";

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::GERER_ITEMSHOP);
    }

    public function run() {

        $sColumns = '';
        $sColumns .= '{ "mData": "article", "bSortable": true },';
        $sColumns .= '{ "mData": "nombre", "className": "min-desktop", "bSortable": true, "sWidth": "50px" },';
        $sColumns .= '{ "mData": "categorie", "className": "min-desktop", "bSortable": true, "sWidth": "140px" },';
        $sColumns .= '{ "mData": "prix", "className": "min-desktop", "bSortable": true, "sWidth": "80px" },';
        $sColumns .= '{ "mData": "actions", "className": "all", "bSortable": false, "sWidth": "55px" },';

        $sFilterColumns = '';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "select", values: [' . $this->getCategoriesForDatatable() . '] },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= 'null,';

        $this->arrayTemplate["dtColumns"] = rtrim($sColumns, ',');
        $this->arrayTemplate["dtFilterColumns"] = rtrim($sFilterColumns, ',');
        $this->arrayTemplate["ajaxSource"] = "pages/Admin/modules/GererItemShop/ajax/listGererItemShopArticles.php?sEcho=1";

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

$class = new GererItemShopArticles();
$class->run();

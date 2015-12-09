<?php

namespace Administration;

require __DIR__ . '../../../../../core/initialize.php';

class GererItemShopCategories extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    public $strTemplate = "GererItemShopCategories.html5.twig";

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::GERER_ITEMSHOP_CATEGORIE);
    }

    public function run() {

        $sColumns = '';
        $sColumns .= '{ "mData": "categorie", "bSortable": true, "sWidth": "150px" },';
        $sColumns .= '{ "mData": "description", "bSortable": true },';
        $sColumns .= '{ "mData": "actions", "bSortable": false, "sWidth": "55px" },';

        $sFilterColumns = '';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= 'null,';

        $this->arrayTemplate["dtColumns"] = rtrim($sColumns, ',');
        $this->arrayTemplate["dtFilterColumns"] = rtrim($sFilterColumns, ',');
        $this->arrayTemplate["ajaxSource"] = "pages/Admin/modules/GererItemShop/ajax/listGererItemShopCategories.php?sEcho=1";
        
        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new GererItemShopCategories();
$class->run();

<?php

namespace Administration;

require __DIR__ . '../../../../../core/initialize.php';

class GererItemShopLogsAchats extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    public $strTemplate = "GererItemShopLogsAchats.html5.twig";

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::GERER_ITEMSHOP_LOGS_ACHATS);
    }

    public function run() {

        $sColumns = '';
        $sColumns .= '{ "mData": "date", "bSortable": true },';
        $sColumns .= '{ "mData": "article", "bSortable": true },';
        $sColumns .= '{ "mData": "quantite", "bSortable": true },';
        $sColumns .= '{ "mData": "prix", "bSortable": true },';
        $sColumns .= '{ "mData": "compte", "bSortable": true },';
        $sColumns .= '{ "mData": "result", "bSortable": true },';

        $sFilterColumns = '';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';

        $this->arrayTemplate["dtColumns"] = rtrim($sColumns, ',');
        $this->arrayTemplate["dtFilterColumns"] = rtrim($sFilterColumns, ',');
        $this->arrayTemplate["ajaxSource"] = "pages/Admin/modules/GererItemShop/ajax/listGererItemShopLogsAchats.php?sEcho=1";
        
        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new GererItemShopLogsAchats();
$class->run();

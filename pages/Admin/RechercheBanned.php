<?php

namespace Administration;

require __DIR__ . '../../../core/initialize.php';

class RechercheBanned extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    public $strTemplate = "RechercheBanned.html5.twig";

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::RECHERCHE_BANNISSEMENT);
    }

    public function run() {

        $sColumns = '';
        $sColumns .= '{ "mData": "compte", "bSortable": true },';
        $sColumns .= '{ "mData": "names", "bSortable": false },';
        $sColumns .= '{ "mData": "raison", "bSortable": true },';
        $sColumns .= '{ "mData": "empire", "bSortable": true, "sClass": "text-center lineIcon", "sWidth": "80px" },';

        if ($this->HaveTheRight(\DroitsHelper::RECHERCHE_IP)) {
            $sColumns .= '{ "mData": "ip", "bSortable": true, "sWidth": "100px" },';
        }

        $sFilterColumns = '';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "select", values: [' . \EmpireHelper::getForDatatableSelect() . '] },';

        if ($this->HaveTheRight(\DroitsHelper::RECHERCHE_IP)) {
            $sFilterColumns .= '{ type: "text", placeholder: "" },';
        }

        $this->arrayTemplate["dtColumns"] = rtrim($sColumns, ',');
        $this->arrayTemplate["dtFilterColumns"] = rtrim($sFilterColumns, ',');
        $this->arrayTemplate["rightRechercheIp"] = $this->HaveTheRight(\DroitsHelper::RECHERCHE_IP);
        $this->arrayTemplate["ajaxSource"] = "pages/Admin/ajax/listRechercheBanned.php";

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new RechercheBanned();
$class->run();

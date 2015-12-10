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
        $sColumns .= '{ "mData": "compte", "bSortable": true, "className": "all" },';
        $sColumns .= '{ "mData": "names", "bSortable": false, "className": "all" },';
        $sColumns .= '{ "mData": "raison", "bSortable": true, "className": "min-tablet" },';
        $sColumns .= '{ "mData": "duree", "bSortable": true, "className": "min-desktop", "sWidth": "80px" },';
        $sColumns .= '{ "mData": "empire", "bSortable": true, "className": "text-center lineIcon min-tablet", "sWidth": "80px" },';

        if ($this->HaveTheRight(\DroitsHelper::RECHERCHE_IP)) {
            $sColumns .= '{ "mData": "ip", "bSortable": true, "className": "min-desktop", "sWidth": "100px" },';
        }

        if ($this->HaveTheRight(\DroitsHelper::DEBANNISSEMENT)) {
            $sColumns .= '{ "mData": "actions", "bSortable": false, "className": "all", "sWidth": "40px" },';
        }

        $sFilterColumns = '';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "select", values: [' . \EmpireHelper::getForDatatableSelect() . '] },';

        if ($this->HaveTheRight(\DroitsHelper::RECHERCHE_IP)) {
            $sFilterColumns .= '{ type: "text", placeholder: "" },';
        }

        if ($this->HaveTheRight(\DroitsHelper::DEBANNISSEMENT)) {
            $sFilterColumns .= 'null,';
        }

        $this->arrayTemplate["dtColumns"] = rtrim($sColumns, ',');
        $this->arrayTemplate["dtFilterColumns"] = rtrim($sFilterColumns, ',');
        $this->arrayTemplate["rightRechercheIp"] = $this->HaveTheRight(\DroitsHelper::RECHERCHE_IP);
        $this->arrayTemplate["rightDebannissement"] = $this->HaveTheRight(\DroitsHelper::DEBANNISSEMENT);
        $this->arrayTemplate["ajaxSource"] = "pages/Admin/ajax/listRechercheBanned.php";

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new RechercheBanned();
$class->run();

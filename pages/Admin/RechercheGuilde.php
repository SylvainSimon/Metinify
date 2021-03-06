<?php

namespace Administration;

require __DIR__ . '../../../core/initialize.php';

class RechercheGuilde extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    public $strTemplate = "RechercheGuilde.html5.twig";

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::RECHERCHE_GUILDE);
    }

    public function run() {

        $sColumns = '';
        $sColumns .= '{ "mData": "name", "bSortable": true },';
        $sColumns .= '{ "mData": "chef", "bSortable": true },';
        $sColumns .= '{ "mData": "level", "bSortable": true, "className": "min-tablet", "sWidth": "50px" },';
        $sColumns .= '{ "mData": "scores", "bSortable": true, "sWidth": "50px" },';
        $sColumns .= '{ "mData": "empire", "bSortable": true, "className": "text-center lineIcon min-tablet", "sWidth": "80px" },';
        $sColumns .= '{ "mData": "status", "bSortable": true, "className": "text-center lineIcon min-tablet", "sWidth": "68px" },';

        $sFilterColumns = '';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "select", values: [' . \EmpireHelper::getForDatatableSelect() . '] },';
        $sFilterColumns .= '{ type: "select", values: [' . \StatusHelper::getForDatatableSelect(true) . '], selected: "' . \StatusHelper::ACTIF . '" },';

        $this->arrayTemplate["dtColumns"] = rtrim($sColumns, ',');
        $this->arrayTemplate["dtFilterColumns"] = rtrim($sFilterColumns, ',');
        $this->arrayTemplate["ajaxSource"] = "pages/Admin/ajax/listRechercheGuilde.php";

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new RechercheGuilde();
$class->run();

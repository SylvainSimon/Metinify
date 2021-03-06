<?php

namespace Administration;

require __DIR__ . '../../../core/initialize.php';

class GererMonnaies extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    public $strTemplate = "GererMonnaies.html5.twig";

    public function __construct() {
        parent::__construct();

        $this->VerifyTheRight(\DroitsHelper::GERER_MONNAIES);
    }

    public function run() {

        $arrDevise = \DeviseHelper::getAll(false);

        $sColumns = '';
        $sColumns .= '{ "mData": "date", "bSortable": true, "sWidth": "120px" },';
        $sColumns .= '{ "mData": "emetteur", "bSortable": true, "sWidth": "90px" },';
        $sColumns .= '{ "mData": "operation", "bSortable": true, "sWidth": "65px" },';
        $sColumns .= '{ "mData": "montant", "bSortable": true },';
        $sColumns .= '{ "mData": "devise", "bSortable": true, "sWidth": "90px" },';
        $sColumns .= '{ "mData": "recepteur", "bSortable": true, "sWidth": "90px" },';

        $sFilterColumns = '';
        $sFilterColumns .= '{ type: "date-range"},';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "select", values: [{value:"1", label:"Ajoute"}, {value:"2", label:"Enlève"}] },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "select", values: [' . \DeviseHelper::getForDatatableSelect(false) . '] },';
        $sFilterColumns .= '{ type: "text", placeholder: "" }';

        $this->arrayTemplate["dtColumns"] = rtrim($sColumns, ',');
        $this->arrayTemplate["dtFilterColumns"] = rtrim($sFilterColumns, ',');
        $this->arrayTemplate["ajaxSource"] = "pages/Admin/ajax/listHistoGererMonnaies.php?sEcho=1";

        $this->arrayTemplate["arrDevise"] = $arrDevise;
        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new GererMonnaies();
$class->run();

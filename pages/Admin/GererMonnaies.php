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

        $arrDevise = \DeviseHelper::getAll();

        $sColumns = '';
        $sColumns .= '{ "mData": "emetteur", "bSortable": true, "sWidth": "100px" },';
        $sColumns .= '{ "mData": "operation", "bSortable": true, "sWidth": "65px" },';
        $sColumns .= '{ "mData": "montant", "bSortable": true },';
        $sColumns .= '{ "mData": "devise", "bSortable": true, "sWidth": "60px" },';
        $sColumns .= '{ "mData": "recepteur", "bSortable": true, "sWidth": "100px" },';

        $sFilterColumns = '';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
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

<?php

namespace Administration;

require __DIR__ . '../../../core/initialize.php';

class GererNews extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    public $strTemplate = "GererNews.html5.twig";

    public function __construct() {
        parent::__construct();

        $this->VerifyTheRight(\DroitsHelper::GERER_NEWS);
    }

    public function run() {

        $sColumns = '';
        $sColumns .= '{ "mData": "date", "bSortable": true, "className": "min-desktop", "sWidth": "130px" },';
        $sColumns .= '{ "mData": "titre", "bSortable": true, "sWidth": "250px" },';
        $sColumns .= '{ "mData": "message", "className": "min-desktop", "bSortable": true },';
        $sColumns .= '{ "mData": "compte", "bSortable": true, "className": "min-desktop", "sWidth": "90px" },';
        $sColumns .= '{ "mData": "actions", "bSortable": false, "className": "all", "sWidth": "55px" },';

        $sFilterColumns = '';
        $sFilterColumns .= '{ type: "date-range"},';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= 'null,';
        
        $this->arrayTemplate["dtColumns"] = rtrim($sColumns, ',');
        $this->arrayTemplate["dtFilterColumns"] = rtrim($sFilterColumns, ',');
        $this->arrayTemplate["ajaxSource"] = "pages/Admin/ajax/listGererNews.php?sEcho=1";

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new GererNews();
$class->run();

<?php

namespace Administration;

require __DIR__ . '../../../core/initialize.php';

class RechercheGuilde extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    public $strTemplate = "RechercheGuildeWar.html5.twig";

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::RECHERCHE_GUILDE_GUERRE);
    }

    public function run() {

        $sColumns = '';
        $sColumns .= '{ "mData": "date", "bSortable": true, "sWidth": "130px" },';
        $sColumns .= '{ "mData": "firstGuild", "bSortable": true, "sWidth": "130px" },';
        $sColumns .= '{ "mData": "firstChef", "bSortable": true },';
        $sColumns .= '{ "mData": "secondGuild", "bSortable": true, "sWidth": "130px" },';
        $sColumns .= '{ "mData": "secondChef", "bSortable": true },';
        $sColumns .= '{ "mData": "winner", "bSortable": true, "sWidth": "100px" },';

        $sFilterColumns = '';
        $sFilterColumns .= '{ type: "date-range"},';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';

        $this->arrayTemplate["dtColumns"] = rtrim($sColumns, ',');
        $this->arrayTemplate["dtFilterColumns"] = rtrim($sFilterColumns, ',');
        $this->arrayTemplate["ajaxSource"] = "pages/Admin/ajax/listRechercheGuildeWar.php";

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new RechercheGuilde();
$class->run();

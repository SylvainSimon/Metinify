<?php

namespace Administration;

require __DIR__ . '../../../../../core/initialize.php';

class GererEquipeJeu extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    public $strTemplate = "GererEquipeJeu.html5.twig";

    public function __construct() {
        parent::__construct();

        $this->VerifyTheRight(\DroitsHelper::GERER_EQUIPE_JEU);
    }

    public function run() {

        $sColumns = '';
        $sColumns .= '{ "mData": "name", "bSortable": true },';
        $sColumns .= '{ "mData": "compte", "bSortable": true, "className": "min-tablet", "sWidth": "80px" },';
        $sColumns .= '{ "mData": "authority", "bSortable": true, "className": "min-tablet", "sWidth": "100px" },';
        $sColumns .= '{ "mData": "playtime", "bSortable": true, "className": "min-desktop", "sWidth": "200px" },';
        $sColumns .= '{ "mData": "lastPlay", "bSortable": true, "className": "min-desktop", "sWidth": "120px" },';
        $sColumns .= '{ "mData": "status", "bSortable": true, "className": "text-center lineIcon min-desktop", "sWidth": "68px" },';
        $sColumns .= '{ "mData": "actions", "bSortable": false, "className": "all", "sWidth": "55px" },';

        $sFilterColumns = '';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "select", values: [' . \AuthorityHelper::getForDatatableSelect() . '] },';
        $sFilterColumns .= 'null,';
        $sFilterColumns .= '{ type: "date-range"},';
        $sFilterColumns .= '{ type: "select", values: [' . \StatusHelper::getForDatatableSelect(true) . '] },';
        $sFilterColumns .= 'null,';

        $this->arrayTemplate["dtColumns"] = rtrim($sColumns, ',');
        $this->arrayTemplate["dtFilterColumns"] = rtrim($sFilterColumns, ',');
        $this->arrayTemplate["ajaxSource"] = "pages/Admin/modules/GererEquipeJeu/ajax/listGererEquipeJeu.php?sEcho=1";

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new GererEquipeJeu();
$class->run();

<?php

namespace Administration;

require __DIR__ . '../../../core/initialize.php';

class Recherche_Joueurs extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    public $strTemplate = "RecherchePlayer.html5.twig";

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::RECHERCHE_JOUEUR);
    }

    public function run() {

        $sColumns = '';
        $sColumns .= '{ "mData": "name", "bSortable": true },';

        if ($this->HaveTheRight(\DroitsHelper::RECHERCHE_COMPTE)) {
            $sColumns .= '{ "mData": "compte", "bSortable": true, "sWidth": "80px" },';
        }

        $sColumns .= '{ "mData": "level", "bSortable": true, "sWidth": "50px" },';
        $sColumns .= '{ "mData": "yangs", "bSortable": true, "sWidth": "90px" },';
        $sColumns .= '{ "mData": "empire", "bSortable": true, "sClass": "text-center lineIcon", "sWidth": "80px" },';
        $sColumns .= '{ "mData": "status", "bSortable": true, "sClass": "text-center lineIcon", "sWidth": "68px" },';

        if ($this->HaveTheRight(\DroitsHelper::RECHERCHE_IP)) {
            $sColumns .= '{ "mData": "ip", "bSortable": true, "sWidth": "100px" },';
        }
        
        if ($this->HaveTheRight(\DroitsHelper::BANNISSEMENT)) {
            $sColumns .= '{ "mData": "actions", "bSortable": false, "sWidth": "40px" },';
        }

        $sFilterColumns = '';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';

        if ($this->HaveTheRight(\DroitsHelper::RECHERCHE_COMPTE)) {
            $sFilterColumns .= '{ type: "text", placeholder: "" },';
        }

        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "select", values: [' . \EmpireHelper::getForDatatableSelect() . '] },';
        $sFilterColumns .= '{ type: "select", values: [' . \StatusHelper::getForDatatableSelect(true) . '], selected: "' . \StatusHelper::ACTIF . '" },';

        if ($this->HaveTheRight(\DroitsHelper::RECHERCHE_IP)) {
            $sFilterColumns .= '{ type: "text", placeholder: "" },';
        }
        
        if ($this->HaveTheRight(\DroitsHelper::BANNISSEMENT)) {
            $sFilterColumns .= 'null,';
        }

        $this->arrayTemplate["dtColumns"] = rtrim($sColumns, ',');
        $this->arrayTemplate["dtFilterColumns"] = rtrim($sFilterColumns, ',');
        $this->arrayTemplate["rightRechercheIp"] = $this->HaveTheRight(\DroitsHelper::RECHERCHE_IP);
        $this->arrayTemplate["rightRechercheCompte"] = $this->HaveTheRight(\DroitsHelper::RECHERCHE_COMPTE);
        $this->arrayTemplate["rightBannissement"] = $this->HaveTheRight(\DroitsHelper::BANNISSEMENT);
        $this->arrayTemplate["ajaxSource"] = "pages/Admin/ajax/listRecherchePlayer.php";

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new Recherche_Joueurs();
$class->run();

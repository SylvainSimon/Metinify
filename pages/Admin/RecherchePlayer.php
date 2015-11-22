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
        $sColumns .= '{ "mData": "name", "bSortable": true, "sWidth": "120px" },';
        $sColumns .= '{ "mData": "level", "bSortable": true }';
        
        $sFilterColumns = '';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" }';

        $this->arrayTemplate["dtColumns"] = rtrim($sColumns, ',');
        $this->arrayTemplate["dtFilterColumns"] = rtrim($sFilterColumns, ',');
        $this->arrayTemplate["ajaxSource"] = "pages/Admin/ajax/listRecherchePlayer.php?sEcho=1";
        
        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new Recherche_Joueurs();
$class->run();

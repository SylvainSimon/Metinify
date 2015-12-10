<?php

namespace Administration;

require __DIR__ . '../../../../../core/initialize.php';

class GererEquipeSite extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    public $strTemplate = "GererEquipeSite.html5.twig";

    public function __construct() {
        parent::__construct();

        $this->VerifyTheRight(\DroitsHelper::GERER_EQUIPE_SITE);
    }

    public function run() {

        $sColumns = '';
        $sColumns .= '{ "mData": "compte", "bSortable": true },';
        $sColumns .= '{ "mData": "actions", "bSortable": false, "sWidth": "55px" },';

        $sFilterColumns = '';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= 'null,';

        $this->arrayTemplate["dtColumns"] = rtrim($sColumns, ',');
        $this->arrayTemplate["dtFilterColumns"] = rtrim($sFilterColumns, ',');
        $this->arrayTemplate["ajaxSource"] = "pages/Admin/modules/GererEquipeSite/ajax/listGererEquipeSite.php?sEcho=1";

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new GererEquipeSite();
$class->run();

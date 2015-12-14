<?php

namespace pages\Messagerie;

require __DIR__ . '../../../core/initialize.php';

class MessagerieArchive extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;
    public $strTemplate = "MessagerieArchive.html5.twig";

    public function run() {

        $sColumns = '';
        $sColumns .= '{ "mData": "date", "bSortable": true, "className": "min-tablet", "sWidth": "80px" },';
        $sColumns .= '{ "mData": "compte", "bSortable": true, "className": "all", "sWidth": "130px"  },';
        $sColumns .= '{ "mData": "objet", "className": "min-tablet", "bSortable": true },';
        $sColumns .= '{ "mData": "actions", "className": "all", "bSortable": false, "sWidth": "60px" },';

        $sFilterColumns = '';
        $sFilterColumns .= '{ type: "date-range", withoutCalendar: "1"},';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= 'null,';

        $this->arrayTemplate["dtColumns"] = rtrim($sColumns, ',');
        $this->arrayTemplate["dtFilterColumns"] = rtrim($sFilterColumns, ',');
        $this->arrayTemplate["ajaxSource"] = "pages/Messagerie/ajax/listMessagerieArchive.php?sEcho=1";

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();

    }

}

$class = new MessagerieArchive();
$class->run();

<?php

namespace pages\Messagerie;

require __DIR__ . '../../../core/initialize.php';

class MessagerieInbox extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;
    public $strTemplate = "MessagerieInbox.html5.twig";

    public function run() {

        $sColumns = '';
        $sColumns .= '{ "mData": "compte", "bSortable": true, "className": "all", "sWidth": "130px"  },';
        $sColumns .= '{ "mData": "objet", "className": "min-tablet", "bSortable": true },';
        $sColumns .= '{ "mData": "date", "bSortable": true, "className": "min-tablet", "sWidth": "80px" },';
        $sColumns .= '{ "mData": "lastMessage", "bSortable": true, "sWidth": "120px" },';
        $sColumns .= '{ "mData": "actions", "className": "all", "bSortable": false, "sWidth": "60px" },';

        $sFilterColumns = '';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "date-range", withoutCalendar: "1"},';
        $sFilterColumns .= 'null,';
        $sFilterColumns .= 'null,';

        $this->arrayTemplate["dtColumns"] = rtrim($sColumns, ',');
        $this->arrayTemplate["dtFilterColumns"] = rtrim($sFilterColumns, ',');
        $this->arrayTemplate["ajaxSource"] = "pages/Messagerie/ajax/listMessagerieInbox.php?sEcho=1";
        $this->arrayTemplate["isAdmin"] = $this->isAdmin;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new MessagerieInbox();
$class->run();

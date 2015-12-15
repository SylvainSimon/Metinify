<?php

namespace pages\Messagerie;

require __DIR__ . '../../../core/initialize.php';

class Messagerie extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;
    public $strTemplate = "Messagerie.html5.twig";

    public function run() {

        $templateTop = $this->objTwig->loadTemplate("MessagerieInbox.html5.twig");
        $sColumns = '';
        $sColumns .= '{ "mData": "compte", "bSortable": true, "className": "all", "sWidth": "130px"  },';
        $sColumns .= '{ "mData": "objet", "className": "min-tablet", "bSortable": true },';
        $sColumns .= '{ "mData": "date", "bSortable": true, "sWidth": "80px" },';
        $sColumns .= '{ "mData": "lastMessage", "className": "min-desktop", "bSortable": true, "sWidth": "120px" },';
        $sColumns .= '{ "mData": "actions", "className": "all", "bSortable": false, "sWidth": "60px" },';
        $sFilterColumns = '';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "text", placeholder: "" },';
        $sFilterColumns .= '{ type: "date-range", withoutCalendar: "1"},';
        $sFilterColumns .= '{ type: "date-range", withoutCalendar: "1"},';
        $sFilterColumns .= 'null,';
        $viewInbox = $templateTop->render([
            "dtColumns" => rtrim($sColumns, ','),
            "dtFilterColumns" => rtrim($sFilterColumns, ','),
            "ajaxSource" => "pages/Messagerie/ajax/listMessagerieInbox.php?sEcho=1",
            "isAdmin" => $this->isAdmin
        ]);

        if ($this->HaveTheRight(\DroitsHelper::SUPPORT_TICKET)) {
            $this->arrayTemplate["isModerateurTicket"] = true;
        } else {
            $this->arrayTemplate["isModerateurTicket"] = false;
        }

        $this->arrayTemplate["viewInbox"] = $viewInbox;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new Messagerie();
$class->run();

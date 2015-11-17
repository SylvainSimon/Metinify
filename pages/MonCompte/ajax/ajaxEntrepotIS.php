<?php

namespace Pages\MonCompte\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxEntrepotIS extends \ScriptHelper {

    public $isProtected = true;
    public $strTemplate = "ajaxEntrepotIS.html5.twig";

    public function run() {

        $arrObjItems = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId(0, 44, $this->objAccount->getId(), "MALL");
        $this->arrayTemplate["arrObjItems"] = $arrObjItems;
        $this->arrayTemplate["iDepart"] = 0;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new ajaxEntrepotIS();
$class->run();

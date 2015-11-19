<?php

namespace Pages\MonPersonnage\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxInventairePage extends \ScriptHelper {

    public $isProtected = true;
    public $strTemplate = "ajaxEntrepotPage.html5.twig";

    public function run() {

        global $request;
        $idPlayer = $request->request->get("id");
        $page = $request->request->get("page");

        if ($page == 1) {
            $iDepart = 0;
            $iMax = 44;
        } else if ($page == 2) {
            $iDepart = 45;
            $iMax = 90;
        } else if ($page == 3) {
            $iDepart = 90;
            $iMax = 135;
        } else if ($page == 4) {
            $iDepart = 135;
            $iMax = 180;
        }
        
        $arrObjItems = \Player\PlayerHelper::getItemRepository()->findByPosIntervalAndOwnerId($iDepart, $iMax, $idPlayer, "INVENTORY");

        $this->arrayTemplate["arrObjItems"] = $arrObjItems;
        $this->arrayTemplate["iDepart"] = $iDepart;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new ajaxInventairePage();
$class->run();

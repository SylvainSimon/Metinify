<?php

namespace Pages\Marche\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxGetSaleForm extends \ScriptHelper {

    public $isProtected = true;
    public $strTemplate = "ajaxGetSaleForm.html5.twig";

    public function run() {

        global $request;
        $idPlayer = $request->request->get("idPlayer");

        $objPlayer = \Player\PlayerHelper::getPlayerRepository()->findPlayerByIdPlayerAndIdAccount($idPlayer, $this->objAccount->getId());

        if ($objPlayer !== null) {
            $arrObjMarcheDevises = \Site\SiteHelper::getMarcheDevisesRepository()->findAll();

            $this->arrayTemplate["objPlayer"] = $objPlayer;
            $this->arrayTemplate["arrObjMarcheDevises"] = $arrObjMarcheDevises;

            $view = $this->template->render($this->arrayTemplate);
            $this->response->setContent($view);
            $this->response->send();
        }
    }

}

$class = new ajaxGetSaleForm();
$class->run();

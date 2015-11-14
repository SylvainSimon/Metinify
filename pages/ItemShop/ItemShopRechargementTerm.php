<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class ItemShopRechargementTerm extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "ItemShopRechargementTerm.html5.twig";

    public function run() {

        global $request;

        $result = $request->query->get("Resultat");
        $compteur = $request->query->get("compteur");
        $idTransaction = $request->query->get("id");

        $this->arrayTemplate["result"] = $result;
        $this->arrayTemplate["compteur"] = $compteur;
        $this->arrayTemplate["idTransaction"] = $idTransaction;
        
        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new ItemShopRechargementTerm();
$class->run();

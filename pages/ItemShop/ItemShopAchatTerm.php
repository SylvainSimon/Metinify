<?php

namespace Pages\ItemShop;

require __DIR__ . '../../../core/initialize.php';

class ItemShopAchatTerm extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "ItemShopAchatTerm.html5.twig";

    public function run() {
        
        global $request;
        
        $this->arrayTemplate["idTransaction"] = $request->query->get("idTransaction");
        $this->arrayTemplate["isBonusCompte"] = $request->query->get("isBonusCompte");
        $this->arrayTemplate["objAccount"] = $this->objAccount;
        
        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();

    }

}

$class = new ItemShopAchatTerm();
$class->run();

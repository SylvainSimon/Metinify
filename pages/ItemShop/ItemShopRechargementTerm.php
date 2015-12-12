<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class ItemShopRechargementTerm extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "ItemShopRechargementTerm.html5.twig";

    public function run() {

        global $request;

        $result = $request->query->get("result");
        $isConnected = $request->query->get("isConnected");
        $idTransaction = $request->query->get("id");
        
        $objLogRechargement = \Site\SiteHelper::getLogsRechargementsRepository()->find($idTransaction);

        $this->arrayTemplate["result"] = $result;
        $this->arrayTemplate["isConnected"] = $isConnected;
        $this->arrayTemplate["idTransaction"] = $idTransaction;
        $this->arrayTemplate["objLogRechargement"] = $objLogRechargement;
        
        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new ItemShopRechargementTerm();
$class->run();

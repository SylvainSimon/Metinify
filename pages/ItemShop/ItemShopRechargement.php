<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class ItemShopRechargement extends \PageHelper {

    public $isProtected = true;
    public $strTemplate = "ItemShopRechargement.html5.twig";

    public function __construct() {
        parent::__construct();
        global $config;
        parent::moduleIsActivated($config["item_shop"]["rechargement"]["activate"]);
    }
    
    public function run() {

        if (!$this->isConnected) {
            global $request;
            $idAccount = $request->request->get("idcompte");
            $loginAccount = $request->request->get("nomCompte");
        } else {
            $idAccount = $this->objAccount->getId();
            $loginAccount = $this->objAccount->getLogin();
        }

        $this->arrayTemplate["idAccount"] = $idAccount;
        $this->arrayTemplate["loginAccount"] = $loginAccount;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new ItemShopRechargement();
$class->run();

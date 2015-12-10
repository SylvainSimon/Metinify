<?php

namespace Administration;

require __DIR__ . '../../../../../core/initialize.php';

class GererEquipeJeuEdit extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    public $strTemplate = "GererEquipeJeuEdit.html5.twig";

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::GERER_EQUIPE_JEU);
    }

    public function run() {

        global $request;
        $mode = $request->query->get("mode");
        
        $objPlayer = null;
        $objAccount = null;

        if ($mode == "create") {
            $objGmList = new \Common\Entity\Gmlist();
        } else if ($mode == "mod") {
            $id = $request->query->get("idMembre");
            $objGmList = \Common\CommonHelper::getGmlistRepository()->find($id);
            $objPlayer = \Player\PlayerHelper::getPlayerRepository()->findByName($objGmList->getMname());
            $objAccount = \Account\AccountHelper::getAccountRepository()->findAccountByLogin($objGmList->getMaccount());
        }

        $this->arrayTemplate["arrAuthority"] = \AuthorityHelper::getAll();
        $this->arrayTemplate["objGmList"] = $objGmList;
        $this->arrayTemplate["objPlayer"] = $objPlayer;
        $this->arrayTemplate["objAccount"] = $objAccount;
        
        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new GererEquipeJeuEdit();
$class->run();

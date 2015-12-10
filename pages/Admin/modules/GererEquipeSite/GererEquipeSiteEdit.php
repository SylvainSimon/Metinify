<?php

namespace Administration;

require __DIR__ . '../../../../../core/initialize.php';

class GererEquipeJeuEdit extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;
    public $strTemplate = "GererEquipeSiteEdit.html5.twig";

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::GERER_EQUIPE_SITE);
    }

    public function run() {

        global $request;
        $mode = $request->query->get("mode");

        $objAccount = null;

        if ($mode == "create") {
            $objAdministrationUsers = new \Site\Entity\AdministrationUsers();
            $arrDroits = $objAdministrationUsers->getDroits();
        } else if ($mode == "mod") {
            $id = $request->query->get("idAdministrationUsers");
            $objAdministrationUsers = \Site\SiteHelper::getAdministrationUsersRepository()->find($id);
            $arrDroits = $objAdministrationUsers->getDroits();
            $objAccount = \Account\AccountHelper::getAccountRepository()->find($objAdministrationUsers->getIdCompte());
        }

        $this->arrayTemplate["objAdministrationUsers"] = $objAdministrationUsers;
        $this->arrayTemplate["arrDroits"] = $arrDroits;
        $this->arrayTemplate["objAccount"] = $objAccount;

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new GererEquipeJeuEdit();
$class->run();

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
            $objAdmins = new \Site\Entity\Admins();
            $arrDroits = $objAdmins->getDroits();
        } else if ($mode == "mod") {
            $id = $request->query->get("idAdmins");
            $objAdmins = \Site\SiteHelper::getAdminsRepository()->find($id);
            $arrDroits = $objAdmins->getDroits();
            $objAccount = \Account\AccountHelper::getAccountRepository()->find($objAdmins->getIdCompte());
        }

        $this->arrayTemplate["objAdmins"] = $objAdmins;
        $this->arrayTemplate["arrDroits"] = $arrDroits;
        $this->arrayTemplate["objAccount"] = $objAccount;

        $view = $this->template->render($this->arrayTemplate);

        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new GererEquipeJeuEdit();
$class->run();

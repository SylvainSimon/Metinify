<?php

namespace pages\Messagerie;

require __DIR__ . '../../../core/initialize.php';

class DiscussionTransfert extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;
    public $strTemplate = "DiscussionTransfert.html5.twig";

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::SUPPORT_TICKET);
    }

    public function run() {

        global $request;
        $idDiscussion = \Encryption::decrypt($request->query->get("idDiscussion"));

        $arrObjAdministrationUsers = \Site\SiteHelper::getAdministrationUsersRepository()->findAll();
        $arrUsers = [];
        foreach ($arrObjAdministrationUsers AS $objAdministrationUsers) {

            $arrDroits = $objAdministrationUsers->getDroits();

            if (in_array(\DroitsHelper::SUPPORT_TICKET, $arrDroits)) {

                $objAccount = \Account\AccountHelper::getAccountRepository()->find($objAdministrationUsers->getIdCompte());
                if ($objAccount !== null) {
                    $arrUsers[] = $objAccount;
                }
            }
        }

        $this->arrayTemplate["idDiscussion"] = $idDiscussion;
        $this->arrayTemplate["arrObjAdministrationUsers"] = $arrUsers;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new DiscussionTransfert();
$class->run();

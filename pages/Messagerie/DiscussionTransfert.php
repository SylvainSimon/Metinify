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

        $arrObjAdmins = \Site\SiteHelper::getAdminsRepository()->findAll();
        $arrUsers = [];
        foreach ($arrObjAdmins AS $objAdmins) {

            $arrDroits = $objAdmins->getDroits();

            if (in_array(\DroitsHelper::SUPPORT_TICKET, $arrDroits)) {

                $objAccount = \Account\AccountHelper::getAccountRepository()->find($objAdmins->getIdCompte());
                if ($objAccount !== null) {
                    $arrUsers[] = $objAdmins;
                }
            }
        }

        $this->arrayTemplate["idDiscussion"] = $idDiscussion;
        $this->arrayTemplate["arrObjAdmins"] = $arrUsers;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new DiscussionTransfert();
$class->run();

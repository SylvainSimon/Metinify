<?php

namespace pages\Messagerie;

require __DIR__ . '../../../core/initialize.php';

class MessagerieView extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;
    public $strTemplate = "MessagerieView.html5.twig";

    public function run() {

        global $request;

        $idSupportDiscussion = \Encryption::decrypt($request->request->get("idSupportDiscussion"));
        
        $objSupportDiscussion = \Site\SiteHelper::getSupportDiscussionsRepository()->find($idSupportDiscussion);
        $objAccount = \Account\AccountHelper::getAccountRepository()->find($objSupportDiscussion->getIdCompte());
        $objAccountAdmin = \Account\AccountHelper::getAccountRepository()->find($objSupportDiscussion->getIdAdmin());
        
        $arrObjSupportMessages = \Site\SiteHelper::getSupportMessagesRepository()->findMessages($this->objAccount->getId(), $idSupportDiscussion);
        
        $this->arrayTemplate["objSupportDiscussion"] = $objSupportDiscussion;
        $this->arrayTemplate["objAccount"] = $objAccount;
        $this->arrayTemplate["objAccountAdmin"] = $objAccountAdmin;
        $this->arrayTemplate["arrObjSupportMessages"] = $arrObjSupportMessages;
        $this->arrayTemplate["currentAccount"] = $this->objAccount;
        $this->arrayTemplate["etatLu"] = \SupportEtatMessageHelper::LU;
        $this->arrayTemplate["isAdmin"] = $this->isAdmin;

        $view = $this->template->render($this->arrayTemplate);
        $this->response->setContent($view);
        $this->response->send();
    }

}

$class = new MessagerieView();
$class->run();

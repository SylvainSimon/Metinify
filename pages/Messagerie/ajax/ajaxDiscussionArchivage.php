<?php

namespace Pages\Messagerie\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxDiscussionArchivage extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $idDiscussion = \Encryption::decrypt($request->request->get("idDiscussion"));
        $objSupportDiscussion = \Site\SiteHelper::getSupportDiscussionsRepository()->find($idDiscussion);
        $objSupportObjet = \Site\SiteHelper::getSupportObjetsRepository()->find($objSupportDiscussion->getIdObjet());
        $objAccount = \Account\AccountHelper::getAccountRepository()->find($objSupportDiscussion->getIdCompte());

        if ($objSupportDiscussion !== null) {

            if ($objSupportDiscussion->getIdCompte() == $this->objAccount->getId() OR $objSupportDiscussion->getIdAdmin() == $this->objAccount->getId()) {

                $objSupportDiscussion->setEstArchive(1);
                $em->persist($objSupportDiscussion);
                $em->flush();

                $template = $this->objTwig->loadTemplate("MessagerieDiscussionCloture.html5.twig");
                $result = $template->render(["compte" => $objAccount->getLogin(), "objet" => $objSupportObjet->getObjet()]);
                $subject = 'VamosMT2 - Clôture de votre ticket';
                \EmailHelper::sendEmail($objAccount->getEmail(), $subject, $result);

                echo json_encode(["result" => true]);
            } else {
                echo json_encode(["result" => false, "message" => "Le ticket est introuvable."]);
            }
        }
    }

}

$class = new ajaxDiscussionArchivage();
$class->run();

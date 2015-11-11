<?php

namespace Pages\Messagerie\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxDiscussionArchivage extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $idDiscussion = $request->request->get("idDiscussion");
        $objDiscussion = \Site\SiteHelper::getSupportDiscussionsRepository()->find($idDiscussion);

        if ($objDiscussion !== null) {

            if ($objDiscussion->getIdCompte == $this->objAccount->getId() OR $objDiscussion->getIdAdmin() == $this->objAccount->getId()) {

                $objDiscussion->setEstArchive(1);
                $em->persist($objDiscussion);
                $em->flush();

                echo "1";
            } else {
                echo "NON";
            }
        }
    }

}

$class = new ajaxDiscussionArchivage();
$class->run();

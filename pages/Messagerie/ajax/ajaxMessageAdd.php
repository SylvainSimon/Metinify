<?php

namespace Pages\Messagerie\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxMessageAdd extends \PageHelper {

    public $isProtected = true;
    public $isAllowForBlock = true;

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $idCompte = $request->request->get("idCompte");
        $idDiscussion = $request->request->get("idDiscussion");

        $message = $request->request->get("message");

        $objSupportMessage = new \Site\Entity\SupportMessages();
        $objSupportMessage->setIdCompte($idCompte);
        $objSupportMessage->setIdDiscussion($idDiscussion);
        $objSupportMessage->setMessage($message);
        $objSupportMessage->setDate(new \DateTime(date("Y-m-d H:i:s")));
        $objSupportMessage->setEtat(\Site\SupportEtatMessageHelper::NON_LU);
        $objSupportMessage->setDatechangementEtat(new \DateTime(date("Y-m-d H:i:s")));
        $objSupportMessage->setIp($this->ipAdresse);

        try {

            $objSupportDiscussion = \Site\SiteHelper::getSupportDiscussionsRepository()->find($idDiscussion);
            $objSupportDiscussion->setDateDernierMessage(new \DateTime(date("Y-m-d H:i:s")));
            $em->persist($objSupportDiscussion);

            $em->persist($objSupportMessage);
            $em->flush();


            if ($idCompte == $objSupportDiscussion->getIdAdmin()) {
                $objSupportObjet = \Site\SiteHelper::getSupportObjetsRepository()->find($objSupportDiscussion->getIdObjet());
                $objAccountJoueur = \Account\AccountHelper::getAccountRepository()->find($objSupportDiscussion->getIdCompte());

                if ($objAccountJoueur !== null) {
                    $template = $this->objTwig->loadTemplate("MessagerieMessageAdd.html5.twig");
                    $result = $template->render(["compte" => $objAccountJoueur->getLogin(), "objet" => $objSupportObjet->getObjet()]);
                    $subject = 'VamosMT2 - Réponse à votre ticket';
                    \EmailHelper::sendEmail($objAccountJoueur->getEmail(), $subject, $result);
                }
            }

            echo json_encode([
                "id" => $objSupportMessage->getId(),
                "date" => \DateTimeHelper::dateTimeToFormatedString($objSupportMessage->getDate()),
                "message" => nl2br($objSupportMessage->getMessage())
            ]);
        } catch (Exception $ex) {
            
        }
    }

}

$class = new ajaxMessageAdd();
$class->run();

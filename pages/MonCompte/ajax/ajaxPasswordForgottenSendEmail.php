<?php

namespace Pages\MonCompte\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxPasswordForgottenSendEmail extends \ScriptHelper {

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $loginCompte = $request->request->get("Mot_De_Passe_Oublie_Compte");
        $emailCompte = $request->request->get("Mot_De_Passe_Oublie_Email");
        $passwordNew = \FonctionsUtiles::GenerateString(8);

        $objLogsOublieMotDePasse = new \Site\Entity\LogsOublieMotDePasse();
        $objLogsOublieMotDePasse->setCompteEssaye($loginCompte);
        $objLogsOublieMotDePasse->setEmailEssaye($emailCompte);
        $objLogsOublieMotDePasse->setIp($this->ipAdresse);
        $objLogsOublieMotDePasse->setDateEssai(new \DateTime(date("Y-m-d H:i:s")));

        $objAccount = \Account\AccountHelper::getAccountRepository()->findAccountByEmailAndLogin($emailCompte, $loginCompte);

        if ($objAccount !== null) {

            \Account\AccountHelper::getAccountRepository()->updateAccountPassword($objAccount->getId(), $passwordNew);

            $template = $this->objTwig->loadTemplate("PasswordForgottenEmail.html5.twig");
            $result = $template->render(["newMDP" => $passwordNew]);
            $subject = 'VamosMT2 - Nouveau mot de passe';
            \EmailHelper::sendEmail($emailCompte, $subject, $result);
            
            $objLogsOublieMotDePasse->setResultatDemande("1");

            echo "1";
        } else {
            $objLogsOublieMotDePasse->setResultatDemande("2");
            echo "2";
        }

        $em->persist($objLogsOublieMotDePasse);
        $em->flush();
    }

}

$class = new ajaxPasswordForgottenSendEmail();
$class->run();

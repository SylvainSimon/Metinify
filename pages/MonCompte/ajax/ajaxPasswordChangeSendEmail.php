<?php

namespace Pages\MonCompte\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxPasswordChangeSendEmail extends \ScriptHelper {

    public $isProtected = true;

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $passwordOld = $request->request->get("Ancien_Mot_De_Passe");
        $passwordNew = $request->request->get("Nouveau_Mot_De_Passe");

        $objAccount = \Account\AccountHelper::getAccountRepository()->findAccountByLoginAndPassword($this->objAccount->getLogin(), $passwordOld);

        if ($objAccount !== null) {

            //Suppression des autres demandes
            \Site\SiteHelper::getControleChangementMotDePasseRepository()->deleteByAccountId($objAccount->getId());

            $Nombre_Unique = \FonctionsUtiles::GenerateString(8, "INT");

            $objControleChangementMotDePasse = new \Site\Entity\ControleChangementMotDePasse();
            $objControleChangementMotDePasse->setIdCompte($objAccount->getId());
            $objControleChangementMotDePasse->setCompte($objAccount->getLogin());
            $objControleChangementMotDePasse->setNouveauMotDePasse($passwordNew);
            $objControleChangementMotDePasse->setNumeroVerif($Nombre_Unique);
            $objControleChangementMotDePasse->setIp($this->ipAdresse);

            $em->persist($objControleChangementMotDePasse);
            $em->flush();
            
            $template = $this->objTwig->loadTemplate("PasswordChangeEmail.html5.twig");
            $result = $template->render([
                "account" => $objAccount->getLogin(),
                "key" => $Nombre_Unique,
            ]);

            $subject = 'VamosMT2 - Changement de mot de passe';
            \EmailHelper::sendEmail($objAccount->getEmail(), $subject, $result);

            echo '1';
        } else {
            echo '2';
        }
    }

}

$class = new ajaxPasswordChangeSendEmail();
$class->run();

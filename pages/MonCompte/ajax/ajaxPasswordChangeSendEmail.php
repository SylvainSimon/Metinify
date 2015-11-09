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
            \Site\SiteHelper::getChangementMotDePasseRepository()->deleteByAccountId($objAccount->getId());

            $Nombre_Unique = \FonctionsUtiles::GenerateString(8, "INT");

            $objChangementMotDePasse = new \Site\Entity\ChangementMotDePasse();
            $objChangementMotDePasse->setIdCompte($objAccount->getId());
            $objChangementMotDePasse->setCompte($objAccount->getLogin());
            $objChangementMotDePasse->setNouveauMotDePasse($passwordNew);
            $objChangementMotDePasse->setNumeroVerif($Nombre_Unique);
            $objChangementMotDePasse->setIp($this->ipAdresse);

            $em->persist($objChangementMotDePasse);
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

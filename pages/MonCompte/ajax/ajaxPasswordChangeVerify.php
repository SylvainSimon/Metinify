<?php

namespace Pages\MonCompte\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxPasswordChangeVerify extends \ScriptHelper {

    public $isProtected = true;

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $numeroVerif = $request->request->get("code");
        $objControleChangementMotDePasse = \Site\SiteHelper::getControleChangementMotDePasseRepository()->findByIdCompteAndNumeroVerif($this->objAccount->getId(), $numeroVerif);

        if ($objControleChangementMotDePasse !== null) {

            //Application du mot de passe
            $this->objAccount->setPassword($objControleChangementMotDePasse->getNouveauMotDePasse());
            $em->persist($this->objAccount);

            //Suppression des demandes
            \Site\SiteHelper::getControleChangementMotDePasseRepository()->deleteByAccountId($objControleChangementMotDePasse->getIdCompte());

            //Ajout dans les logs
            $objLogsChangementPassword = new \Site\Entity\LogsChangementPassword();
            $objLogsChangementPassword->setIdCompte($this->objAccount->getId());
            $objLogsChangementPassword->setEmail($this->objAccount->getEmail());
            $objLogsChangementPassword->setDate(new \DateTime(date("Y-m-d H:i:s")));
            $objLogsChangementPassword->setIp($this->ipAdresse);
            $em->persist($objLogsChangementPassword);
            
            $em->flush();
            
            //Envoi de l'email
            $template = $this->objTwig->loadTemplate("PasswordChangeTermEmail.html5.twig");
            $result = $template->render(["account" => $this->objAccount->getLogin()]);
            $subject = 'VamosMT2 - Changement du mot de passe terminé';
            \EmailHelper::sendEmail($this->objAccount->getEmail(), $subject, $result);

            echo "1";
        } else {
            echo "2";
        }

    }

}

$class = new ajaxPasswordChangeVerify();
$class->run();

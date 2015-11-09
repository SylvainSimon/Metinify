<?php

namespace Pages\MonCompte\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxPasswordChangeVerify extends \ScriptHelper {

    public $isProtected = true;

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $numeroVerif = $request->request->get("code");
        $objChangementMotDePasse = \Site\SiteHelper::getChangementMotDePasseRepository()->findByIdCompteAndNumeroVerif($this->objAccount->getId(), $numeroVerif);

        if ($objChangementMotDePasse !== null) {

            //Application du mot de passe
            $this->objAccount->setPassword($objChangementMotDePasse->getNouveauMotDePasse());
            $em->persist($this->objAccount);

            //Suppression des demandes
            \Site\SiteHelper::getChangementMotDePasseRepository()->deleteByAccountId($objChangementMotDePasse->getIdCompte());

            //Ajout dans les logs
            $objLogsChangementMotDePasse = new \Site\Entity\LogsChangementMotDePasse();
            $objLogsChangementMotDePasse->setIdCompte($this->objAccount->getId());
            $objLogsChangementMotDePasse->setCompte($this->objAccount->getLogin());
            $objLogsChangementMotDePasse->setEmail($this->objAccount->getEmail());
            $objLogsChangementMotDePasse->setDate(new \DateTime(date("Y-m-d H:i:s")));
            $objLogsChangementMotDePasse->setIp($this->ipAdresse);
            $em->persist($objLogsChangementMotDePasse);
            
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

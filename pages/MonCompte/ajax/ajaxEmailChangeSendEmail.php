<?php

namespace Pages\MonCompte\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxEmailChangeSendEmail extends \ScriptHelper {

    public $isProtected = true;
    
    public function run() {
        
        $em = \Shared\DoctrineHelper::getEntityManager();

        $Nombre_Unique = \FonctionsUtiles::GenerateString(8, "INT");

        //Suppression des autres entrées de vérification
        \Site\SiteHelper::getControleChangementMailRepository()->deleteByAccountId($this->objAccount->getId());

        //Insertion de la clés de vérification
        $objControleChangementMail = new \Site\Entity\ControleChangementMail();
        $objControleChangementMail->setIdCompte($this->objAccount->getId());
        $objControleChangementMail->setEmail($this->objAccount->getEmail());
        $objControleChangementMail->setNumeroVerif($Nombre_Unique);
        $objControleChangementMail->setIp($this->ipAdresse);
        $objControleChangementMail->setDate(new \DateTime(date("Y-m-d H:i:s")));
        $em->persist($objControleChangementMail);

        $em->flush();

        //Envoi de l'email avec la clés
        $templateOld = $this->objTwig->loadTemplate("EmailChangeEmailVerify.html5.twig");
        $resultOld = $templateOld->render(["compte" => $this->objAccount->getLogin(), "key" => $Nombre_Unique]);
        $subject = 'VamosMt2 - Changement de mail de ' . $this->objAccount->getLogin() . '';
        \EmailHelper::sendEmail($this->objAccount->getEmail(), $subject, $resultOld);
        
        echo '1';

    }

}

$class = new ajaxEmailChangeSendEmail();
$class->run();

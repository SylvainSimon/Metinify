<?php

namespace Pages\Inscription\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class InscriptionSubmit extends \PageHelper {

    public function run() {

        global $request;
        global $session;
        global $config;

        $em = \Shared\DoctrineHelper::getEntityManager();

        $login = $request->request->get("Utilisateur");
        $password = $request->request->get("Mot_De_Passe");
        $email = $request->request->get("Email");

        $objIpToCountry = \Site\SiteHelper::getIpToCountryRepository()->findCountryBetween(ip2long($this->ipAdresse));
        if ($objIpToCountry !== null) {
            $Langue = $objIpToCountry->getCntry();
        } else {
            $Langue = "Inconnu";
        }

        $passwordEncrypted = \FonctionsUtiles::myPasswordToDoubleSha1($password);

        $objAccount = new \Account\Entity\Account();
        $objAccount->setLogin(trim($login));
        $objAccount->setPassword($passwordEncrypted);
        $objAccount->setEmail($email);
        $objAccount->setCash($config->defaultCash);
        $objAccount->setMileage($config->defaultMileage);
        $objAccount->setIpCreation($this->ipAdresse);
        $objAccount->setLangue($Langue);
        $objAccount->setCreateTime(new \DateTime(date("Y-m-d H:i:s")));
        
        $objAccount->setMarriageFastExpire(new \DateTime(date("Y-m-d H:i:s")));
        $objAccount->setMoneyDropRateExpire(new \DateTime(date("Y-m-d H:i:s")));
        $objAccount->setGoldExpire(new \DateTime(date("Y-m-d H:i:s")));
        $objAccount->setSilverExpire(new \DateTime(date("Y-m-d H:i:s")));
        $objAccount->setAutolootExpire(new \DateTime(date("Y-m-d H:i:s")));
        $objAccount->setFishMindExpire(new \DateTime(date("Y-m-d H:i:s")));
        $objAccount->setSafeboxExpire(new \DateTime(date("Y-m-d H:i:s")));

        if ($config->manualActivation) {
            $objAccount->setStatus(".");
        } else {
            $objAccount->setStatus("OK");
        }
        
        $em->persist($objAccount);
        $em->flush();

        if ($config->manualActivation) {
            $template = $this->objTwig->loadTemplate("InscriptionSubmitVerif.html5.twig");
            $result = $template->render([
                "account" => $objAccount->getLogin(),
                "accountId" => $objAccount->getId()
            ]);
            $subject = 'VamosMT2 - Activation de votre compte ' . $objAccount->getLogin();
            \EmailHelper::sendEmail($objAccount->getEmail(), $subject, $result);
        }

        $session->set("NomTemporaire", trim($login));
        echo "1";
    }

}

$class = new InscriptionSubmit();
$class->run();

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
        $objAccount->setCash($config["register"]["initCash"]);
        $objAccount->setMileage($config["register"]["initMileage"]);
        $objAccount->setIpCreation($this->ipAdresse);
        $objAccount->setLangue($Langue);
        $objAccount->setCreateTime(new \DateTime(date("Y-m-d H:i:s")));
        
        $anneeRestantMysql = (2037 - date("Y"));
        $dateActuel = \Carbon\Carbon::now();
        $dateBonusNew = $dateActuel->addYear($anneeRestantMysql);
        
        $objAccount->setMarriageFastExpire(new \DateTime(date("Y-m-d H:i:s")));
        $objAccount->setMoneyDropRateExpire(new \DateTime(date("Y-m-d H:i:s")));
        $objAccount->setGoldExpire(new \DateTime(date("Y-m-d H:i:s")));
        $objAccount->setSilverExpire(new \DateTime(date("Y-m-d H:i:s")));
        $objAccount->setAutolootExpire($dateBonusNew);
        $objAccount->setFishMindExpire(new \DateTime(date("Y-m-d H:i:s")));
        $objAccount->setSafeboxExpire($dateBonusNew);

        if ($config["register"]["emailActivation"]) {
            $objAccount->setStatus(\StatusHelper::NON_CONFIRME);
        } else {
            $objAccount->setStatus(\StatusHelper::ACTIF);
        }
        
        $em->persist($objAccount);
        $em->flush();

        if ($config["register"]["emailActivation"]) {
            $template = $this->objTwig->loadTemplate("InscriptionSubmitVerif.html5.twig");
            $result = $template->render([
                "account" => $objAccount->getLogin(),
                "accountId" => $objAccount->getId()
            ]);
            $subject = 'VamosMT2 - Activez votre compte ' . $objAccount->getLogin();
            \EmailHelper::sendEmail($objAccount->getEmail(), $subject, $result);
        }

        $session->set("NomTemporaire", trim($login));
        echo "1";
    }

}

$class = new InscriptionSubmit();
$class->run();

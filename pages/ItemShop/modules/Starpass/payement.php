<?php

namespace Includes;

require __DIR__ . '../../../../../core/initialize.php';

class payement extends \PageHelper {

    public function run() {

        global $request;
        global $config;
        global $session;
        $em = \Shared\DoctrineHelper::getEntityManager();
        $paymentResult = false;

        $ident = $idp = $ids = $idd = $codes = $code1 = $code2 = $code3 = $code4 = $code5 = $datas = '';
        $idp = 196161;
        $idd = 337955;
        $ident = $idp . ";" . $ids . ";" . $idd;

        if (isset($_POST['code1']))
            $code1 = $_POST['code1'];
        if (isset($_POST['code2']))
            $code2 = ";" . $_POST['code2'];
        if (isset($_POST['code3']))
            $code3 = ";" . $_POST['code3'];
        if (isset($_POST['code4']))
            $code4 = ";" . $_POST['code4'];
        if (isset($_POST['code5']))
            $code5 = ";" . $_POST['code5'];
        $codes = $code1 . $code2 . $code3 . $code4 . $code5;

        if (isset($_POST['DATAS'])) {
            $datas = $_POST['DATAS'];
        }

        $ident = urlencode($ident);
        $codes = urlencode($codes);
        $datas = urlencode($datas);

        /* Envoi de la requête vers le serveur StarPass
          Dans la variable tab[0] on récupère la réponse du serveur
          Dans la variable tab[1] on récupère l'URL d'accès ou d'erreur suivant la réponse du serveur */
        $get_f = @file("http://script.starpass.fr/check_php.php?ident=$ident&codes=$codes&DATAS=$datas");
        if (!$get_f) {
            exit("Votre serveur n'a pas accès au serveur de StarPass, merci de contacter votre hébergeur. ");
        }
        
        $tab = explode("|", $get_f[0]);

        if (!$tab[1])
            $url = "http://script.starpass.fr/error.php";
        else
            $url = $tab[1];

        $pays = $tab[2];
        $palier = urldecode($tab[3]);
        $id_palier = urldecode($tab[4]);
        $type = urldecode($tab[5]);

        if (substr($tab[0], 0, 3) != "OUI") {
            $paymentResult = false;
        } else {
            $paymentResult = true;
        }

        $objAccount = \Account\AccountHelper::getAccountRepository()->find($datas);
        
        if ($paymentResult) {

            $codeResult = "Réussi";

            if ($config["item_shop"]["rechargement"]["starpass"]["devise"] == \DeviseHelper::CASH) {
                $objAccount->setCash($objAccount->getCash() + $config["item_shop"]["rechargement"]["starpass"]["cash"]);
            } else if ($config["item_shop"]["rechargement"]["starpass"]["devise"] == \DeviseHelper::MILEAGE) {
                $objAccount->setMileage($objAccount->getMileage() + $config["item_shop"]["rechargement"]["starpass"]["cash"]);
            }
            $em->persist($objAccount);

            $session->set("Cash", $objAccount->getCash());
            $session->set("Mileage", $objAccount->getMileage());

            $objLogsRechargement = new \Site\Entity\LogsRechargements();
            $objLogsRechargement->setIdCompte($objAccount->getId());
            $objLogsRechargement->setCompte($objAccount->getLogin());
            $objLogsRechargement->setEmailCompte($objAccount->getEmail());
            $objLogsRechargement->setCode($request->query->get("RECALL"));
            $objLogsRechargement->setNombreVamonaies($config["item_shop"]["rechargement"]["starpass"]["cash"]);
            $objLogsRechargement->setResultat($codeResult);
            $objLogsRechargement->setDate(new \DateTime(date("Y-m-d H:i:s")));
            $objLogsRechargement->setIp($this->ipAdresse);
            $em->persist($objLogsRechargement);
            $em->flush();
            
            $template = $this->objTwig->loadTemplate("emailItemShopRechargement.html5.twig");
            $result = $template->render([
                "compte" => $objAccount->getLogin(),
                "system" => "StarPass",
                "nombre" => $config["item_shop"]["rechargement"]["starpass"]["cash"],
                "devise" => $config["item_shop"]["rechargement"]["starpass"]["devise"],
                "identifiantRechargement" => $objLogsRechargement->getId()
            ]);
            $subject = 'VamosMT2 - Rechargement de compte';
            \EmailHelper::sendEmail($objAccount->getEmail(), $subject, $result);

            if ($this->isConnected) {
                header('Location: ../../ItemShopRechargementTerm.php?result=1&id=' . $objLogsRechargement->getId() . '&isConnected=1');
                exit;
            } else {
                header('Location: ../../ItemShopRechargementTerm.php?result=1&id=' . $objLogsRechargement->getId() . '&isConnected=0');
                exit;
            }
        } else {

            $codeResult = "Mauvaise clès";

            $objLogsRechargement = new \Site\Entity\LogsRechargements();
            $objLogsRechargement->setIdCompte($objAccount->getId());
            $objLogsRechargement->setCompte($objAccount->getLogin());
            $objLogsRechargement->setEmailCompte($objAccount->getEmail());
            $objLogsRechargement->setCode($request->query->get("RECALL"));
            $objLogsRechargement->setResultat($codeResult);
            $objLogsRechargement->setDate(new \DateTime(date("Y-m-d H:i:s")));
            $objLogsRechargement->setIp($this->ipAdresse);
            $em->persist($objLogsRechargement);

            $em->flush();

            header('Location: ../../ItemShopRechargementTerm.php?result=0&Raison=ClesMauvaise&id=' . $objLogsRechargement->getId() . '');
            exit;
        }
    }

}

$class = new payement();
$class->run();

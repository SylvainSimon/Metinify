<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class payement extends \PageHelper {

    public function run() {

        global $request;
        global $config;
        global $session;
        $em = \Shared\DoctrineHelper::getEntityManager();
        $paymentResult = false;

        if ($request->query->get("RECALL") !== null) {

            $RECALL = urlencode($_GET['RECALL']);
            $r = @file("http://payment.allopass.com/api/checkcode.apu?code=$RECALL&auth=227909/898935/4188626");
            if (substr($r[0], 0, 2) == "OK") {
                $paymentResult = true;
            } else {
                $codeResult = "Raté";
            }
        }

        $objAccount = \Account\AccountHelper::getAccountRepository()->find($request->query->get("data"));

        if ($paymentResult) {

            $codeResult = "Réussi";

            $objAccount->setCash($objAccount->getCash() + $config->itemShopReloadCash);
            $em->persist($objAccount);

            $session->set("VamoNaies", $objAccount->getCash());

            $objLogsRechargement = new \Site\Entity\LogsRechargements();
            $objLogsRechargement->setIdCompte($objAccount->getId());
            $objLogsRechargement->setCompte($objAccount->getLogin());
            $objLogsRechargement->setEmailCompte($objAccount->getEmail());
            $objLogsRechargement->setCode($request->query->get("RECALL"));
            $objLogsRechargement->setNombreVamonaies($config->itemShopReloadCash);
            $objLogsRechargement->setResultat($codeResult);
            $objLogsRechargement->setDate(new \DateTime(date("Y-m-d H:i:s")));
            $objLogsRechargement->setIp($this->ipAdresse);
            $em->persist($objLogsRechargement);

            $em->flush();

            if ($this->isConnected) {
                header('Location: ItemShopRechargementTerm.php?Resultat=Reussi&id_compte=' . $request->query->get("data") . '&id=' . $objLogsRechargement->getId() . '&compteur=oui');
                exit;
            } else {
                header('Location: ItemShopRechargementTerm.php?Resultat=Reussi&id_compte=' . $request->query->get("data") . '&id=' . $objLogsRechargement->getId() . '&compteur=non');
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

            header('Location: ItemShopRechargementTerm.php?Resultat=Rate&Raison=ClesMauvaise&id_compte=' . $request->query->get("data") . '&id=' . $objLogsRechargement->getId() . '');
            exit;
        }
    }

}

$class = new payement();
$class->run();

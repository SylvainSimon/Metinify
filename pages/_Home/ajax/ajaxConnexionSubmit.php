<?php

namespace Pages\Home\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxConnexionSubmit extends \ScriptHelper {

    public function run() {

        global $session;
        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $login = $request->request->get("Utilisateur");
        $password = $request->request->get("Mot_De_Passe");

        $objAccount = \Account\AccountHelper::getAccountRepository()->findAccountByLoginAndPassword($login, $password);

        if ($objAccount !== null) {

            $session->set("ID", $objAccount->getId());
            $session->set("Utilisateur", $objAccount->getLogin());
            $session->set("Email", $objAccount->getEmail());
            $session->set("Cash", $objAccount->getCash());
            $session->set("Mileage", $objAccount->getMileage());

            $objAdministrationUser = \Site\SiteHelper::getAdminsRepository()->findAdministrationUser($objAccount->getId());

            if ($objAdministrationUser !== null) {

                $session->set("estAdmin", true);

                $Tableau_Retour_Json = array(
                    'result' => "1",
                    'reasons' => "",
                    'isUnconfimed' => $objAccount->getStatus() == \StatusHelper::NON_CONFIRME,
                    'isBanned' => $objAccount->getStatus() == \StatusHelper::BANNI,
                    'withRefresh' => 1,
                    'data' => '<div style="position: relative;top: 45%;width: 431px; margin: 0 auto 0 auto;"><h2>Chargement de l\'administration...</h2></div>'
                );
            } else {
                $Tableau_Retour_Json = array(
                    'result' => "1",
                    'reasons' => "",
                    'isUnconfimed' => $objAccount->getStatus() == \StatusHelper::NON_CONFIRME,
                    'isBanned' => $objAccount->getStatus() == \StatusHelper::BANNI,
                    'withRefresh' => 0,
                    'id' => \Encryption::encryptForUrl($objAccount->getId()),
                    'data' => ''
                );
            }
        } else {

            $Tableau_Retour_Json = array(
                'result' => "2",
                'reasons' => "Vous avez indiqué de mauvaises informations."
            );
        }


        $objLogConnexion = new \Site\Entity\LogsConnexion();
        $objLogConnexion->setCompte($login);
        $objLogConnexion->setIp($this->ipAdresse);
        $objLogConnexion->setDate(new \DateTime(date("Y-m-d H:i:s")));

        if ($session->get("ID") !== null) {
            $objLogConnexion->setResultat(1);
            $objLogConnexion->setIdCompte($session->get("ID"));
        } else {
            $objLogConnexion->setResultat(0);
        }
        
        $em->persist($objLogConnexion);
        $em->flush();

        echo json_encode($Tableau_Retour_Json);
    }

}

$class = new ajaxConnexionSubmit();
$class->run();

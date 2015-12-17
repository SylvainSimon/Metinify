<?php

namespace Administration\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxGererMonnaieExecute extends \ScriptHelper {

    public $isProtected = true;
    public $isAdminProtected = true;

    public function __construct() {
        parent::__construct();
        $this->VerifyTheRight(\DroitsHelper::GERER_MONNAIES);
    }

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $compte = $request->request->get("compte");
        $typeTransaction = $request->request->get("transaction");
        $ammount = $request->request->get("nombre_monnaies");
        $devise = $request->request->get("devise");

        $objLogsAdminGererMonnaie = new \Site\Entity\LogsAdminGererMonnaie();

        $objLogsAdminGererMonnaie->setMontant($ammount);
        $objLogsAdminGererMonnaie->setDevise($devise);
        $objLogsAdminGererMonnaie->setOperation($typeTransaction);
        $objLogsAdminGererMonnaie->setIdGm($this->objAccount->getId());
        $objLogsAdminGererMonnaie->setDate(new \DateTime(date("Y-m-d H:i:s")));
        $objLogsAdminGererMonnaie->setIp($this->ipAdresse);

        if ($compte == "*") {

            \Account\AccountHelper::getAccountRepository()->updateMonnaiesByLogin("", $typeTransaction, $ammount, $devise);
            $objLogsAdminGererMonnaie->setIdCompte(0);

            $Tableau_Retour_Json = array(
                'result' => true,
                'reasons' => ""
            );
            
        } else {

            $objAccount = \Account\AccountHelper::getAccountRepository()->findAccountByLogin($compte);
            if ($objAccount !== null) {

                \Account\AccountHelper::getAccountRepository()->updateMonnaiesByLogin($compte, $typeTransaction, $ammount, $devise);
                $objLogsAdminGererMonnaie->setIdCompte($objAccount->getId());

                $Tableau_Retour_Json = array(
                    'result' => true,
                    'reasons' => ""
                );
                
            } else {

                $Tableau_Retour_Json = array(
                    'result' => false,
                    'reasons' => "Ce compte n'existe pas."
                );
            }
        }
        
        $em->persist($objLogsAdminGererMonnaie);
        $em->flush();
        
        echo json_encode($Tableau_Retour_Json);
    }

}

$class = new ajaxGererMonnaieExecute();
$class->run();

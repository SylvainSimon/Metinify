<?php

namespace Pages\MonPersonnage\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxPersonnageRenameExecute extends \ScriptHelper {

    public $isProtected = true;
    public $objPlayer;

    public function __construct() {
        parent::__construct();
        global $request;
        $this->objPlayer = parent::VerifMonJoueur(\Encryption::decrypt($request->request->get("idPlayer")));
    }

    public function run() {

        global $request;
        global $session;
        global $config;

        $em = \Shared\DoctrineHelper::getEntityManager();

        $playerNameOld = $this->objPlayer->getName();
        $playerNameNew = $request->request->get("newName");
        $devise = $config["mod_player"]["rename"]["devise"];
        $price = $config["mod_player"]["rename"]["price"];
        
        $monnaie = 0;

        if ($devise == \DeviseHelper::CASH) {
            $monnaie = $this->objAccount->getCash();
        } elseif ($devise == \DeviseHelper::MILEAGE) {
            $monnaie = $this->objAccount->getMileage();
        }

        $countPlayerByName = \Player\PlayerHelper::getPlayerRepository()->countPlayerByName($playerNameNew);

        if ($countPlayerByName == 0) {

            if ($monnaie >= $price) {

                $this->objPlayer->setName($playerNameNew);
                $em->persist($this->objPlayer);

                $objLogsPlayerRename = new \Site\Entity\LogsPlayerRename();
                $objLogsPlayerRename->setIdCompte($this->objAccount->getId());
                $objLogsPlayerRename->setOld($playerNameOld);
                $objLogsPlayerRename->setNew($playerNameNew);
                $objLogsPlayerRename->setPrix($config["mod_player"]["rename"]["price"]);
                $objLogsPlayerRename->setDevise($config["mod_player"]["rename"]["devise"]);
                $objLogsPlayerRename->setDate(new \DateTime(date("Y-m-d H:i:s")));
                $objLogsPlayerRename->setIp($this->ipAdresse);
                $em->persist($objLogsPlayerRename);

                if ($devise == \DeviseHelper::CASH) {
                    $this->objAccount->setCash($this->objAccount->getCash() - $price);
                    $this->objAccount->setMileage($this->objAccount->getMileage() + $price);
                } elseif ($devise == \DeviseHelper::MILEAGE) {
                    $this->objAccount->setMileage($this->objAccount->getMileage() - $price);
                }
                
                $em->persist($this->objAccount);

                $session->set("Cash", $this->objAccount->getCash());
                $session->set("TanaNaies", $this->objAccount->getMileage());

                $em->flush();

                $Tableau_Retour_Json = array(
                    'result' => true,
                    'reasons' => "Personnage renommé avec succès."
                );
            } else {
                $Tableau_Retour_Json = array(
                    'result' => false,
                    'reasons' => "Vous n'avez pas assez de monnaies."
                );
            }
        } else {
            $Tableau_Retour_Json = array(
                'result' => false,
                'reasons' => "Ce nom est déjà pris."
            );
        }

        echo json_encode($Tableau_Retour_Json);
    }

}

$class = new ajaxPersonnageRenameExecute();
$class->run();

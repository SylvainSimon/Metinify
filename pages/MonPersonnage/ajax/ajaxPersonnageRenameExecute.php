<?php

namespace Pages\MonPersonnage\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxPersonnageRenameExecute extends \ScriptHelper {

    public $isProtected = true;

    public function run() {

        global $request;
        global $session;
        
        $em = \Shared\DoctrineHelper::getEntityManager();
        $Suppression_Perssonage_Procedure_ID_Personnage = $request->request->get("id_personnage");

        $objPlayer = parent::VerifMonJoueur($Suppression_Perssonage_Procedure_ID_Personnage);
        $playerNameOld = $objPlayer->getName();
        $playerNameNew = $request->request->get("nouveau_nom");

        $countPlayerByName = \Player\PlayerHelper::getPlayerRepository()->countPlayerByName($playerNameNew);

        if ($countPlayerByName == 0) {

            if ($this->objAccount->getCash() >= 1500) {

                $objPlayer->setName($playerNameNew);
                $em->persist($objPlayer);

                $objLogRename = new \Site\Entity\LogsRename();
                $objLogRename->setIdCompte($this->objAccount->getId());
                $objLogRename->setAncienNom($playerNameOld);
                $objLogRename->setNouveauNom($playerNameNew);
                $objLogRename->setDate(new \DateTime(date("Y-m-d H:i:s")));
                $objLogRename->setIp($this->ipAdresse);
                $em->persist($objLogRename);

                $this->objAccount->setCash($this->objAccount->getCash() - 1500);
                $this->objAccount->setMileage($this->objAccount->getMileage() + 1500);

                $session->set("VamoNaies", $this->objAccount->getCash());
                $session->set("TanaNaies", $this->objAccount->getMileage());
                
                $em->flush();

                $Tableau_Retour_Json = array(
                    'result' => "WIN",
                    'cash' => "1500",
                    'reasons' => "Personnage renommé avec succès."
                );
            } else {
                $Tableau_Retour_Json = array(
                    'result' => "FAIL",
                    'reasons' => "Vous n'avez pas assez de VamoNaies."
                );
            }
        } else {
            $Tableau_Retour_Json = array(
                'result' => "FAIL",
                'reasons' => "Ce nom est déjà pris."
            );
        }

        echo json_encode($Tableau_Retour_Json);
    }

}

$class = new ajaxPersonnageRenameExecute();
$class->run();

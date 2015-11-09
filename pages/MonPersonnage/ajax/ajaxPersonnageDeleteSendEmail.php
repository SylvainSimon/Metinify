<?php

namespace Pages\MonPersonnage\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxPersonnageDeleteSendEmail extends \ScriptHelper {

    public $isProtected = true;

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $idCompte = $request->request->get("id_compte");
        $idPersonnage = $request->request->get("id_personnage");
        $objPlayer = \Player\PlayerHelper::getPlayerRepository()->find($idPersonnage);

        if ($objPlayer !== null) {

            //Suppression des autres demandes
            \Site\SiteHelper::getSuppressionPersonnageRepository()->deleteByPlayerId($idPersonnage);

            $objAccount = \Account\AccountHelper::getAccountRepository()->find($idCompte);

            if ($objAccount !== null) {

                $numeroVerif = \FonctionsUtiles::GenerateString(8, "INT");

                //Envoie de l'email de vérification
                $template = $this->objTwig->loadTemplate("PersonnageDeleteEmailVerify.html5.twig");
                $result = $template->render(["account" => $objAccount->getLogin(), "player" => $objPlayer->getName(), "key" => $numeroVerif]);
                $subject = 'VamosMt2 - Suppression du personnage ' . $objPlayer->getName() . '';
                \EmailHelper::sendEmail($objAccount->getEmail(), $subject, $result);

                //Insertion de la demande
                $objSuppressionPersonnage = new \Site\Entity\SuppressionPersonnage();
                $objSuppressionPersonnage->setIdCompte($idCompte);
                $objSuppressionPersonnage->setIdPersonnage($idPersonnage);
                $objSuppressionPersonnage->setEmail($objAccount->getEmail());
                $objSuppressionPersonnage->setNumeroVerif($numeroVerif);
                $objSuppressionPersonnage->setDate(new \DateTime(date("Y-m-d H:i:s")));
                $objSuppressionPersonnage->setIp($this->ipAdress);

                $em->persist($objSuppressionPersonnage);
                $em->flush();

                $Tableau_Retour_Json = array(
                    'result' => "WIN"
                );
            } else {
                $Tableau_Retour_Json = array(
                    'result' => "FAIL",
                    'reasons' => "Le compte n'existe pas."
                );
            }
            echo json_encode($Tableau_Retour_Json);
        }
    }

}

$class = new ajaxPersonnageDeleteSendEmail();
$class->run();

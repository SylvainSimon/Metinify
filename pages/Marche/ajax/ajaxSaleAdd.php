<?php

namespace Pages\Marche\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxSaleAdd extends \ScriptHelper {

    public $isProtected = true;

    public function run() {

        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $playerId = $request->request->get("id_personnage");
        $titre = $request->request->get("texte_titre");
        $description = $request->request->get("texte_description");
        $prix = trim($request->request->get("prix"));
        $idDevise = $request->request->get("id_devise");

        if (is_numeric($prix)) {

            $objPlayer = parent::VerifMonJoueur($playerId);

            if (\Player\PlayerHelper::haveGuild($objPlayer->getId()) === false) {

                $objPlayerIndex = \Player\PlayerHelper::getPlayerIndexRepository()->find($this->objAccount->getId());

                $playerIndexPid = 0;

                if ($objPlayerIndex->getPid1() == $objPlayer->getId()) {
                    $playerIndexPid = 1;
                } else if ($objPlayerIndex->getPid2() == $objPlayer->getId()) {
                    $playerIndexPid = 2;
                } else if ($objPlayerIndex->getPid3() == $objPlayer->getId()) {
                    $playerIndexPid = 3;
                } else if ($objPlayerIndex->getPid4() == $objPlayer->getId()) {
                    $playerIndexPid = 4;
                }
                
                if ($playerIndexPid != 0) {

                    $objMarchePersonnage = new \Site\Entity\MarchePersonnages();
                    $objMarchePersonnage->setIdProprietaire($this->objAccount->getId());
                    $objMarchePersonnage->setIdPersonnage($objPlayer->getId());
                    $objMarchePersonnage->setPid($playerIndexPid);
                    
                    $em->persist($objMarchePersonnage);
                    $em->flush();

                    $func = "setPid" . $playerIndexPid;
                    $objPlayerIndex->$func("9999999");
                    $em->persist($objPlayerIndex);

                    $objPlayer->setIdAccount(0);
                    $em->persist($objPlayer);

                    $objMarcheArticles = new \Site\Entity\MarcheArticles();
                    $objMarcheArticles->setDesignation($titre);
                    $objMarcheArticles->setDescription($description);
                    $objMarcheArticles->setCategorie(1);
                    $objMarcheArticles->setIdentifiantArticle($objMarchePersonnage->getId());
                    $objMarcheArticles->setPrix($prix);
                    $objMarcheArticles->setDevise($idDevise);
                    $objMarcheArticles->setDateAjout(new \DateTime(date("Y-m-d H:i:s")));
                    $objMarcheArticles->setIp($this->ipAdresse);
                    $em->persist($objMarcheArticles);
                    
                    $objLogsMarcheMiseEnVente = new \Site\Entity\LogsMarcheMiseEnVente();
                    $objLogsMarcheMiseEnVente->setIdCompte($this->objAccount->getId());
                    $objLogsMarcheMiseEnVente->setIdPersonnage($playerId);
                    $objLogsMarcheMiseEnVente->setPrix($prix);
                    $objLogsMarcheMiseEnVente->setDevise($idDevise);
                    $objLogsMarcheMiseEnVente->setDate(new \DateTime(date("Y-m-d H:i:s")));
                    $objLogsMarcheMiseEnVente->setIp($this->ipAdresse);
                    $em->persist($objLogsMarcheMiseEnVente);

                    $em->flush();
                    
                    $Tableau_Retour_Json = array(
                        'result' => true,
                        'reasons' => ""
                    );
                } else {
                    $Tableau_Retour_Json = array(
                        'result' => false,
                        'reasons' => "Ce personnage n'existe pas."
                    );
                }
            } else {
                $Tableau_Retour_Json = array(
                    'result' => false,
                    'reasons' => "Le perso ne doit pas avoir de guilde."
                );
            }
        } else {
            $Tableau_Retour_Json = array(
                'result' => false,
                'reasons' => "Vous n'avez pas indiquer un chiffre."
            );
        }
        echo json_encode($Tableau_Retour_Json);
    }

}

$class = new ajaxSaleAdd();
$class->run();

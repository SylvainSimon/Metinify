<?php

namespace Pages\Marche\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ajaxBuyPlayer extends \ScriptHelper {

    public $isProtected = true;

    public function run() {

        global $session;
        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $idMarchePersonnage = $request->request->get("idMarchePersonnage");
        $objMarchePersonnage = \Site\SiteHelper::getMarchePersonnagesRepository()->find($idMarchePersonnage);

        if ($objMarchePersonnage !== null) {

            $idVendeur = $objMarchePersonnage->getIdProprietaire();
            $idPlayer = $objMarchePersonnage->getIdPersonnage();
            $pidVendeur = $objMarchePersonnage->getPid();

            $objMarcheArticle = \Site\SiteHelper::getMarcheArticlesRepository()->findByIdentifiantArticle($idMarchePersonnage);

            if ($objMarcheArticle !== null) {

                $prixMarcheArticle = $objMarcheArticle->getPrix();
                $deviseMarcheArticle = $objMarcheArticle->getDevise();

                $asserDeMonnaies = false;
                if ($deviseMarcheArticle == 1) {
                    if ($this->objAccount->getCash() >= $prixMarcheArticle) {
                        $asserDeMonnaies = true;
                    }
                } else if ($deviseMarcheArticle == 2) {
                    if ($this->objAccount->getMileage() >= $prixMarcheArticle) {
                        $asserDeMonnaies = true;
                    }
                }

                if ($asserDeMonnaies) {

                    $objPlayerIndex = \Player\PlayerHelper::getPlayerIndexRepository()->find($this->objAccount->getId());

                    if ($objPlayerIndex !== null) {

                        $pidDisponible = false;
                        if ($objPlayerIndex->getPid1() == "0") {
                            $pidDisponible = "1";
                        } else if ($objPlayerIndex->getPid2() == "0") {
                            $pidDisponible = "2";
                        } else if ($objPlayerIndex->getPid3() == "0") {
                            $pidDisponible = "3";
                        } else if ($objPlayerIndex->getPid4() == "0") {
                            $pidDisponible = "4";
                        }

                        if ($pidDisponible != false) {

                            $objAccountProprietaire = \Account\AccountHelper::getAccountRepository()->find($idVendeur);

                            if ($objAccountProprietaire !== null) {
                                if ($deviseMarcheArticle == 1) {
                                    $objAccountProprietaire->setCash($objAccountProprietaire->getCash() + $prixMarcheArticle);
                                    $this->objAccount->setCash($this->objAccount->getCash() - $prixMarcheArticle);
                                } else if ($deviseMarcheArticle == 2) {
                                    $objAccountProprietaire->setMileage($objAccountProprietaire->getMileage() + $prixMarcheArticle);
                                    $this->objAccount->setMileage($this->objAccount->getMileage() - $prixMarcheArticle);
                                }

                                $em->persist($objAccountProprietaire);
                                $em->persist($this->objAccount);

                                $session->set("Cash", $this->objAccount->getCash());
                                $session->set("Mileage", $this->objAccount->getMileage());

                                $objLogsMarcheAchats = new \Site\Entity\LogsMarcheAchats();
                                $objLogsMarcheAchats->setIdVendeur($idVendeur);
                                $objLogsMarcheAchats->setIdAcheteur($this->objAccount->getId());
                                $objLogsMarcheAchats->setIdPersonnage($idPlayer);
                                $objLogsMarcheAchats->setPrix($prixMarcheArticle);
                                $objLogsMarcheAchats->setDate(\Carbon\Carbon::now());
                                $objLogsMarcheAchats->setDevise($deviseMarcheArticle);
                                $objLogsMarcheAchats->setIp($this->ipAdresse);
                                $em->persist($objLogsMarcheAchats);

                                //Ajout du personnage sur le compte acheteur
                                $funcAcheteur = "setPid" . $pidDisponible;
                                $objPlayerIndex->$funcAcheteur($idPlayer);
                                $em->persist($objPlayerIndex);

                                //Rajout du compte acheteur sur le personnage
                                $objPlayer = \Player\PlayerHelper::getPlayerRepository()->find($idPlayer);
                                $objPlayer->setIdAccount($this->objAccount->getId());
                                $objPlayer->setIp("");
                                $em->persist($objPlayer);

                                //Suppression du personnage fictif du compte vendeur
                                $objPlayerIndexVendeur = \Player\PlayerHelper::getPlayerIndexRepository()->find($idVendeur);
                                $funcVendeur = "setPid" . $pidVendeur;
                                $objPlayerIndexVendeur->$funcVendeur(0);
                                $em->persist($objPlayerIndexVendeur);

                                //Suppression de l'article de la vente
                                $em->remove($objMarcheArticle);

                                //Suppression du personnage de la vente
                                $em->remove($objMarchePersonnage);

                                $em->flush();
                                
                                //Email vendeur
                                $template = $this->objTwig->loadTemplate("ajaxBuyPlayerVendeur.html5.twig");
                                $result = $template->render([
                                    "compte" => $objAccountProprietaire->getLogin(),
                                    "player" => $objPlayer->getName(),
                                    "prix" => $prixMarcheArticle,
                                    "devise" => $deviseMarcheArticle,
                                ]);
                                $subject = 'VamosMT2 - Vente du joueur ' . $objPlayer->getName();
                                \EmailHelper::sendEmail($objAccountProprietaire->getEmail(), $subject, $result);
                                
                                //Email acheteur
                                $templateAcheteur = $this->objTwig->loadTemplate("ajaxBuyPlayerAcheteur.html5.twig");
                                $resultAcheteur = $templateAcheteur->render([
                                    "compte" => $this->objAccount->getLogin(),
                                    "player" => $objPlayer->getName(),
                                    "prix" => $prixMarcheArticle,
                                    "devise" => $deviseMarcheArticle,
                                ]);
                                $subjectAcheteur = 'VamosMT2 - Achat du joueur ' . $objPlayer->getName();
                                \EmailHelper::sendEmail($this->objAccount->getEmail(), $subjectAcheteur, $resultAcheteur);

                                $Tableau_Retour_Json = array(
                                    'result' => true,
                                    'cash' => $this->objAccount->getCash(),
                                    'mileage' => $this->objAccount->getMileage(),
                                    'idPlayer' => \Encryption::encryptForUrl($idPlayer)
                                );
                            } else {
                                $Tableau_Retour_Json = array(
                                    'result' => false,
                                    'reasons' => "Le proprietaire n'existe pas."
                                );
                            }
                        } else {
                            $Tableau_Retour_Json = array(
                                'result' => false,
                                'reasons' => "Vous n'avez pas d'emplacement pour mettre ce joueur."
                            );
                        }
                    } else {
                        $Tableau_Retour_Json = array(
                            'result' => false,
                            'reasons' => "Votre compte n'existe pas."
                        );
                    }
                } else {
                    $Tableau_Retour_Json = array(
                        'result' => false,
                        'reasons' => "Vous n'avez pas assez de monnaies."
                    );
                }
            } else {
                $Tableau_Retour_Json = array(
                    'result' => false,
                    'reasons' => "L'article n'existe plus."
                );
            }
        } else {
            $Tableau_Retour_Json = array(
                'result' => false,
                'reasons' => "Ce personnage n'est plus en vente."
            );
        }
        echo json_encode($Tableau_Retour_Json);
    }

}

$class = new ajaxBuyPlayer();
$class->run();

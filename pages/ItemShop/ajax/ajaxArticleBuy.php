<?php

namespace Includes;

require __DIR__ . '../../../../core/initialize.php';

class ajaxArticleBuy extends \ScriptHelper {

    public $isProtected = true;

    public function checkEntrepotIS() {
        $countSafebox = \Player\PlayerHelper::getSafeboxRepository()->findByIdCompte($this->objAccount->getId());
        if ($countSafebox !== null) {
            return true;
        } else {
            return false;
        }
    }

    public function checkFieldEntrepotIS($nombreItem = 1) {
        $nextFreePosition = 0;
        $out = false;
        while ($out == false) {
            $objItem = \Player\PlayerHelper::getItemRepository()->countByOwnerIdPosAndWindow($this->objAccount->getId(), $nextFreePosition, "MALL");
            if ($objItem > 0) {
                $nextFreePosition++;
            } else {
                $out = true;
            }
        }
        if ($nextFreePosition > (44 - $nombreItem)) {
            return false;
        } else {
            return $nextFreePosition;
        }
    }

    public function run() {

        global $session;
        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $arrResult["result"] = 1;
        $arrResult["isBonusCompte"] = 0;

        $idItem = $request->request->get("id_item");
        $nombreItem = $request->request->get("nombre_item");
        $objItemshop = \Site\SiteHelper::getItemshopRepository()->findItem($idItem, true);

        if (!$this->checkEntrepotIS()) {
            $arrResult["result"] = 0;
            $arrResult["code"] = 8;
            echo json_encode($arrResult);
            die();
        }

        if ($objItemshop !== null) {

            /* ------- Si l'item est de type Simple 1 -------- */
            if ($objItemshop->getType() == 1) {

                //Si le Membre a assez de Vamonaies
                if ($session->get("VamoNaies") >= ($objItemshop->getPrix() * $nombreItem)) {

                    $flagItem = \Player\PlayerHelper::getItemProtoRepository()->findFlagByVnum($objItemshop->getIdItem());

                    //Si empilable
                    if ($flagItem == 4 || $flagItem == 20 || $flagItem == 132 || $flagItem == 2052 || $flagItem == 8212) {

                        //Si l'entrepot n'est pas plein
                        if ($this->checkFieldEntrepotIS() !== false) {

                            $nextFreePosition = $this->checkFieldEntrepotIS();

                            $objItem = new \Player\Entity\Item();
                            $objItem->setOwnerId($this->objAccount->getId());
                            $objItem->setWindow("MALL");
                            $objItem->setPos($nextFreePosition);
                            $objItem->setCount($nombreItem);
                            $objItem->setVnum($objItemshop->getIdItem());
                            $em->persist($objItem);

                            $prixTotal = ($objItemshop->getPrix() * $nombreItem);

                            $this->objAccount->setCash($this->objAccount->getCash() - $prixTotal);
                            $this->objAccount->setMileage($this->objAccount->getMileage() + $prixTotal);
                            $em->persist($this->objAccount);

                            $em->flush();

                            $session->set("VamoNaies", $this->objAccount->getCash());
                            $session->set("TanaNaies", $this->objAccount->getMileage());
                        } else {
                            $arrResult = ["result" => 0, "code" => 5];
                        }
                    } else {
                        //Si l'entrepot n'est pas plein
                        if ($this->checkFieldEntrepotIS() !== false) {

                            for ($i = 1; $i <= $nombreItem; $i++) {
                                $nextFreePosition = $this->checkFieldEntrepotIS();

                                $objItem = new \Player\Entity\Item();
                                $objItem->setOwnerId($this->objAccount->getId());
                                $objItem->setWindow("MALL");
                                $objItem->setPos($nextFreePosition);
                                $objItem->setCount("1");
                                $objItem->setVnum($objItemshop->getIdItem());
                                $objItem->setSocket0("1");
                                $objItem->setSocket1("1");
                                $objItem->setSocket2("1");
                                $em->persist($objItem);
                            }

                            $prixTotal = ($objItemshop->getPrix() * $nombreItem);
                            if (($objItemshop->getIdItem() == "2613") || ($objItemshop->getIdItem() == "2614")) {
                                $this->objAccount->setCash($this->objAccount->getCash() - $prixTotal);
                            } else {
                                $this->objAccount->setCash($this->objAccount->getCash() - $prixTotal);
                                $this->objAccount->setMileage($this->objAccount->getMileage() + $prixTotal);
                            }

                            $em->persist($this->objAccount);
                            $em->flush();

                            $session->set("VamoNaies", $this->objAccount->getCash());
                            $session->set("TanaNaies", $this->objAccount->getMileage());
                        } else {
                            $arrResult = ["result" => 0, "code" => 5];
                        }
                    }
                } else {
                    $arrResult = ["result" => 0, "code" => 3];
                }

                /* ----------- Si l'item est de type durée ------------ */
            } elseif ($objItemshop->getType() == 2) {

                //Si le membre a assez de cash
                if ($session->get("VamoNaies") >= $objItemshop->getPrix()) {

                    $anneeRestantMysql = (2037 - date("Y"));
                    $dateActuel = \Carbon\Carbon::now();

                    switch ($objItemshop->getIdItem()) {
                        case 1:
                            $dateBonusActuel = \Carbon\Carbon::createFromTimestamp($this->objAccount->getGoldExpire()->getTimestamp());
                            break;
                        case 2:
                            $dateBonusActuel = \Carbon\Carbon::createFromTimestamp($this->objAccount->getSilverExpire()->getTimestamp());
                            break;
                        case 3:
                            $dateBonusActuel = \Carbon\Carbon::createFromTimestamp($this->objAccount->getSafeboxExpire()->getTimestamp());
                            break;
                        case 4:
                            $dateBonusActuel = \Carbon\Carbon::createFromTimestamp($this->objAccount->getAutolootExpire()->getTimestamp());
                            break;
                        case 5:
                            $dateBonusActuel = \Carbon\Carbon::createFromTimestamp($this->objAccount->getFishMindExpire()->getTimestamp());
                            break;
                        case 6:
                            $dateBonusActuel = \Carbon\Carbon::createFromTimestamp($this->objAccount->getMarriageFastExpire()->getTimestamp());
                            break;
                        case 7:
                            $dateBonusActuel = \Carbon\Carbon::createFromTimestamp($this->objAccount->getMoneyDropRateExpire()->getTimestamp());
                            break;
                    }

                    if ($objItemshop->getNbItem() == 9999) {
                        $dateBonusNew = $dateActuel->addYear($anneeRestantMysql);
                    } else {
                        if ($dateBonusActuel->gt($dateActuel)) {
                            $dateBonusNew = $dateBonusActuel->addDay($objItemshop->getNbItem());
                        } else {
                            $dateBonusNew = $dateActuel->addDay($objItemshop->getNbItem());
                        }
                    }

                    switch ($objItemshop->getIdItem()) {
                        case 1 : $this->objAccount->setGoldExpire($dateBonusNew);
                            break;
                        case 2 : $this->objAccount->setSilverExpire($dateBonusNew);
                            break;
                        case 3 : $this->objAccount->setSafeboxExpire($dateBonusNew);
                            break;
                        case 4 : $this->objAccount->setAutolootExpire($dateBonusNew);
                            break;
                        case 5 : $this->objAccount->setFishMindExpire($dateBonusNew);
                            break;
                        case 6 : $this->objAccount->setMarriageFastExpire($dateBonusNew);
                            break;
                        case 7 : $this->objAccount->setMoneyDropRateExpire($dateBonusNew);
                            break;
                    }

                    $prixTotal = ($objItemshop->getPrix() * $nombreItem);
                    $this->objAccount->setCash($this->objAccount->getCash() - $prixTotal);
                    $this->objAccount->setMileage($this->objAccount->getMileage() + $prixTotal);
                    $em->persist($this->objAccount);

                    $em->flush();

                    $session->set("VamoNaies", $this->objAccount->getCash());
                    $session->set("TanaNaies", $this->objAccount->getMileage());

                    $arrResult["isBonusCompte"] = 1;
                } else {
                    $arrResult = ["result" => 0, "code" => 3];
                }

                /* -------------- Si l'item est de type TanaNaies -------------- */
            } elseif ($objItemshop->getType() == 3) {
                //Si le membre a assez de marques
                if ($session->get("TanaNaies") >= ($objItemshop->getPrix() * $nombreItem)) {

                    $flagItem = \Player\PlayerHelper::getItemProtoRepository()->findFlagByVnum($objItemshop->getIdItem());

                    //Si empilable
                    if ($flagItem == 4 || $flagItem == 20 || $flagItem == 132 || $flagItem == 2052 || $flagItem == 8212) {

                        //Si l'entrepot n'est pas plein
                        if ($this->checkFieldEntrepotIS() !== false) {

                            $nextFreePosition = $this->checkFieldEntrepotIS();

                            $objItem = new \Player\Entity\Item();
                            $objItem->setOwnerId($this->objAccount->getId());
                            $objItem->setWindow("MALL");
                            $objItem->setPos($nextFreePosition);
                            $objItem->setCount($nombreItem);
                            $objItem->setVnum($objItemshop->getIdItem());
                            $em->persist($objItem);

                            $prixTotal = ($objItemshop->getPrix() * $nombreItem);

                            $this->objAccount->setMileage($this->objAccount->getMileage() - $prixTotal);
                            $em->persist($this->objAccount);

                            $em->flush();

                            $session->set("TanaNaies", $this->objAccount->getMileage());
                        } else {
                            $arrResult = ["result" => 0, "code" => 5];
                        }
                    } else {
                        //Si l'entrepot n'est pas plein
                        if ($this->checkFieldEntrepotIS() !== false) {

                            for ($i = 1; $i <= $nombreItem; $i++) {
                                $nextFreePosition = $this->checkFieldEntrepotIS();

                                $objItem = new \Player\Entity\Item();
                                $objItem->setOwnerId($this->objAccount->getId());
                                $objItem->setWindow("MALL");
                                $objItem->setPos($nextFreePosition);
                                $objItem->setCount("1");
                                $objItem->setVnum($objItemshop->getIdItem());
                                $objItem->setSocket0("1");
                                $objItem->setSocket1("1");
                                $objItem->setSocket2("1");
                                $em->persist($objItem);
                            }

                            $prixTotal = ($objItemshop->getPrix() * $nombreItem);
                            $this->objAccount->setMileage($this->objAccount->getMileage() - $prixTotal);
                            $em->persist($this->objAccount);

                            $em->flush();

                            $session->set("TanaNaies", $this->objAccount->getMileage());
                        } else {
                            $arrResult = ["result" => 0, "code" => 5];
                        }
                    }
                } else {
                    $arrResult = ["result" => 0, "code" => 6];
                }
            } else {
                $arrResult = ["result" => 0, "code" => 4];
            }
        }

        if ($objItemshop->getType() == 1) {
            $ID_Monnaie = "1";
        } else if ($objItemshop->getType() == 3) {
            $ID_Monnaie = "2";
        } else if ($objItemshop->getType() == 2) {
            $ID_Monnaie = "1";
        }

        if ($arrResult["result"] == 1) {
            $Resultat_Achat = "Réussi";
        } else {
            $Resultat_Achat = "Erreur";
        }

        $objLogAchats = new \Site\Entity\LogAchats();
        $objLogAchats->setIdCompte($this->objAccount->getId());
        $objLogAchats->setCompte($this->objAccount->getLogin());
        $objLogAchats->setVnumItem($objItemshop->getIdItem());
        $objLogAchats->setItem($objItemshop->getNameItem());
        $objLogAchats->setQuantite($nombreItem);
        $objLogAchats->setPrix($objItemshop->getPrix() * $nombreItem);
        $objLogAchats->setMonnaie($ID_Monnaie);
        $objLogAchats->setIp($this->ipAdresse);
        $objLogAchats->setDate(\Carbon\Carbon::now());
        $objLogAchats->setResultat($Resultat_Achat);

        $em->persist($objLogAchats);
        $em->flush();

        $arrResult["idTransaction"] = $objLogAchats->getId();
        echo json_encode($arrResult);
    }

}

$class = new ajaxArticleBuy();
$class->run();

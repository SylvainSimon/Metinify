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

    public function checkFieldEntrepotIS($nextFreePosition = 0) {

        $objItem = \Player\PlayerHelper::getItemRepository()->countByOwnerIdPosAndWindow($this->objAccount->getId(), $nextFreePosition, "MALL");
        if ($objItem > 0 || $nextFreePosition > 44) {
            if ($nextFreePosition > 44) {
                return false;
            } else {
                return $this->checkFieldEntrepotIS($nextFreePosition + 1);
            }
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
        $nombreItemBuy = 0;
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
                    $socketPct = \Player\PlayerHelper::getItemProtoRepository()->findSocketPctByVnum($objItemshop->getIdItem());

                    //Si empilable
                    if ($flagItem == 4 || $flagItem == 20 || $flagItem == 132 || $flagItem == 2052 || $flagItem == 8212) {

                        $nombreItemTotal = $nombreItem * $objItemshop->getNbItem();
                        $nombreItemPendingTotal = $nombreItemTotal;
                        $nombreItemOkTotal = 0;
                        $nombreCase = round($nombreItemTotal / 200);

                        for ($iModulo = 0; $iModulo <= $nombreCase; $iModulo++) {
                            if ($nombreItemTotal > 0) {
                                if ($this->checkFieldEntrepotIS() !== false) {

                                    $nextFreePosition = $this->checkFieldEntrepotIS();

                                    $objItem = new \Player\Entity\Item();
                                    $objItem->setOwnerId($this->objAccount->getId());
                                    $objItem->setWindow("MALL");
                                    $objItem->setPos($nextFreePosition);

                                    if ($nombreItemTotal > 200) {
                                        $objItem->setCount(200);
                                        $nombreItemTotal = $nombreItemTotal - 200;
                                        $nombreItemOkTotal = $nombreItemOkTotal + 200;
                                    } else {
                                        $objItem->setCount($nombreItemTotal);
                                        $nombreItemTotal = $nombreItemTotal - $nombreItemTotal;
                                        $nombreItemOkTotal = $nombreItemOkTotal + $nombreItemTotal;
                                    }

                                    $objItem->setVnum($objItemshop->getIdItem());
                                    $em->persist($objItem);
                                    $em->flush();
                                    $em->detach($objItem);
                                    $nombreItemBuy++;
                                } else {
                                    $arrResult = ["result" => 0, "code" => 5];
                                    break;
                                }
                            }
                        }

                        if ($arrResult["result"] == 0) {
                            if ($nombreItemOkTotal > 0) {

                                $prixTotal = ($objItemshop->getPrix() * $nombreItem);

                                $proportionItemOk = (($nombreItemOkTotal / $nombreItemPendingTotal) * 100);
                                $soustraction = round(($objItemshop->getPrix() * $nombreItem) * $proportionItemOk / 100);
                                $prixTotal = $soustraction;
                                $arrResult["result"] = 1;
                            } else {
                                $prixTotal = 0;
                            }
                        } elseif ($arrResult["result"] == 1) {
                            $prixTotal = ($objItemshop->getPrix() * $nombreItem);
                            $nombreItemBuy = $nombreItem;
                        }

                        $this->objAccount->setCash($this->objAccount->getCash() - $prixTotal);
                        $this->objAccount->setMileage($this->objAccount->getMileage() + $prixTotal);
                        $em->persist($this->objAccount);
                        $em->flush();
                        $session->set("VamoNaies", $this->objAccount->getCash());
                        $session->set("TanaNaies", $this->objAccount->getMileage());
                    } else {

                        $nombreItemTotal = ($nombreItem * $objItemshop->getNbItem());
                        $nombreItemPendingTotal = $nombreItemTotal;
                        $nombreItemOkTotal = 0;

                        for ($i = 0; $i < $nombreItemTotal; $i++) {

                            $nextFreePosition = $this->checkFieldEntrepotIS();
                            if ($nextFreePosition !== false) {

                                $objItem = new \Player\Entity\Item();
                                $objItem->setOwnerId($this->objAccount->getId());
                                $objItem->setWindow("MALL");
                                $objItem->setPos($nextFreePosition);
                                $objItem->setCount(1);
                                $objItem->setVnum($objItemshop->getIdItem());

                                if ($socketPct > 0) {
                                    for ($iSocket = 0; $iSocket < $socketPct; $iSocket++) {
                                        $func = "setSocket" . $iSocket;
                                        $objItem->$func("1");
                                    }
                                }

                                $em->persist($objItem);
                                $em->flush();
                                $em->detach($objItem);
                                $nombreItemBuy++;
                                $nombreItemOkTotal++;
                            } else {
                                $arrResult = ["result" => 0, "code" => 5];
                                break;
                            }
                        }

                        if ($arrResult["result"] == 0) {
                            if ($nombreItemOkTotal > 0) {
                                $prixTotal = ($objItemshop->getPrix() * $nombreItem);
                                $proportionItemOk = (($nombreItemOkTotal / $nombreItemPendingTotal) * 100);
                                $soustraction = round(($objItemshop->getPrix() * $nombreItem) * $proportionItemOk / 100);
                                $prixTotal = $soustraction;

                                $arrResult["result"] = 1;
                            } else {
                                $prixTotal = 0;
                            }

                            if ($nombreItemBuy > 1) {
                                $nombreItemBuy = round($nombreItemBuy / $objItemshop->getNbItem());
                            }
                        } elseif ($arrResult["result"] == 1) {
                            $prixTotal = ($objItemshop->getPrix() * $nombreItem);
                            $nombreItemBuy = $nombreItem;
                        }

                        $this->objAccount->setCash($this->objAccount->getCash() - $prixTotal);
                        $this->objAccount->setMileage($this->objAccount->getMileage() + $prixTotal);
                        $em->persist($this->objAccount);
                        $em->flush();
                        $session->set("VamoNaies", $this->objAccount->getCash());
                        $session->set("TanaNaies", $this->objAccount->getMileage());
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
                    $socketPct = \Player\PlayerHelper::getItemProtoRepository()->findSocketPctByVnum($objItemshop->getIdItem());

                    //Si empilable
                    if ($flagItem == 4 || $flagItem == 20 || $flagItem == 132 || $flagItem == 2052 || $flagItem == 8212) {

                        $nombreItemTotal = $nombreItem * $objItemshop->getNbItem();
                        $nombreItemPendingTotal = $nombreItemTotal;
                        $nombreItemOkTotal = 0;
                        $nombreCase = round($nombreItemTotal / 200);

                        for ($iModulo = 0; $iModulo <= $nombreCase; $iModulo++) {
                            if ($nombreItemTotal > 0) {
                                if ($this->checkFieldEntrepotIS() !== false) {

                                    $nextFreePosition = $this->checkFieldEntrepotIS();

                                    $objItem = new \Player\Entity\Item();
                                    $objItem->setOwnerId($this->objAccount->getId());
                                    $objItem->setWindow("MALL");
                                    $objItem->setPos($nextFreePosition);

                                    if ($nombreItemTotal > 200) {
                                        $objItem->setCount(200);
                                        $nombreItemTotal = $nombreItemTotal - 200;
                                        $nombreItemOkTotal = $nombreItemOkTotal + 200;
                                    } else {
                                        $objItem->setCount($nombreItemTotal);
                                        $nombreItemTotal = $nombreItemTotal - $nombreItemTotal;
                                        $nombreItemOkTotal = $nombreItemOkTotal + $nombreItemTotal;
                                    }

                                    $objItem->setVnum($objItemshop->getIdItem());
                                    $em->persist($objItem);
                                    $em->flush();
                                    $em->detach($objItem);
                                    $nombreItemBuy++;
                                } else {
                                    $arrResult = ["result" => 0, "code" => 5];
                                    break;
                                }
                            }
                        }

                        if ($arrResult["result"] == 0) {
                            if ($nombreItemOkTotal > 0) {

                                $prixTotal = ($objItemshop->getPrix() * $nombreItem);

                                $proportionItemOk = (($nombreItemOkTotal / $nombreItemPendingTotal) * 100);
                                $soustraction = round(($objItemshop->getPrix() * $nombreItem) * $proportionItemOk / 100);
                                $prixTotal = $soustraction;
                                $arrResult["result"] = 1;
                            } else {
                                $prixTotal = 0;
                            }
                        } elseif ($arrResult["result"] == 1) {
                            $prixTotal = ($objItemshop->getPrix() * $nombreItem);
                            $nombreItemBuy = $nombreItem;
                        }

                        $this->objAccount->setMileage($this->objAccount->getMileage() - $prixTotal);
                        $em->persist($this->objAccount);
                        $em->flush();
                        $session->set("TanaNaies", $this->objAccount->getMileage());
                    } else {

                        $nombreItemTotal = ($nombreItem * $objItemshop->getNbItem());
                        $nombreItemPendingTotal = $nombreItemTotal;
                        $nombreItemOkTotal = 0;

                        for ($i = 0; $i < $nombreItemTotal; $i++) {

                            $nextFreePosition = $this->checkFieldEntrepotIS();

                            if ($nextFreePosition !== false) {
                                $nextFreePosition = $this->checkFieldEntrepotIS();

                                $objItem = new \Player\Entity\Item();
                                $objItem->setOwnerId($this->objAccount->getId());
                                $objItem->setWindow("MALL");
                                $objItem->setPos($nextFreePosition);
                                $objItem->setCount(1);
                                $objItem->setVnum($objItemshop->getIdItem());

                                if ($socketPct > 0) {
                                    for ($iSocket = 0; $iSocket < $socketPct; $iSocket++) {
                                        $func = "setSocket" . $iSocket;
                                        $objItem->$func("1");
                                    }
                                }

                                $em->persist($objItem);
                                $em->flush();
                                $em->detach($objItem);
                                $nombreItemBuy++;
                                $nombreItemOkTotal++;
                            } else {
                                $arrResult = ["result" => 0, "code" => 5];
                                break;
                            }
                        }

                        if ($arrResult["result"] == 0) {
                            if ($nombreItemOkTotal > 0) {
                                $prixTotal = ($objItemshop->getPrix() * $nombreItem);
                                $proportionItemOk = (($nombreItemOkTotal / $nombreItemPendingTotal) * 100);
                                $soustraction = round(($objItemshop->getPrix() * $nombreItem) * $proportionItemOk / 100);
                                $prixTotal = $soustraction;

                                $arrResult["result"] = 1;
                            } else {
                                $prixTotal = 0;
                            }

                            if ($nombreItemBuy > 1) {
                                $nombreItemBuy = round($nombreItemBuy / $objItemshop->getNbItem());
                            }
                        } elseif ($arrResult["result"] == 1) {
                            $prixTotal = ($objItemshop->getPrix() * $nombreItem);
                            $nombreItemBuy = $nombreItem;
                        }

                        $this->objAccount->setMileage($this->objAccount->getMileage() - $prixTotal);
                        $em->persist($this->objAccount);
                        $em->flush();
                        $session->set("TanaNaies", $this->objAccount->getMileage());
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
            if ($arrResult["code"] == 4) {
                $Resultat_Achat = "Type d'item inconnu";
            } elseif ($arrResult["code"] == 5) {
                if ($nombreItemOkTotal > 0) {
                    $Resultat_Achat = "Livraison partiel";
                } else {
                    $Resultat_Achat = "Manque de place";
                }
            } elseif ($arrResult["code"] == 6) {
                $Resultat_Achat = "Pas assez de " . \DeviseHelper::getLibelle(2);
            } elseif ($arrResult["code"] == 3) {
                $Resultat_Achat = "Pas assez de " . \DeviseHelper::getLibelle(1);
            } else {
                $Resultat_Achat = "Erreur";
            }
        }

        $objLogAchats = new \Site\Entity\LogAchats();
        $objLogAchats->setIdCompte($this->objAccount->getId());
        $objLogAchats->setCompte($this->objAccount->getLogin());
        $objLogAchats->setVnumItem($objItemshop->getIdItem());
        if ($objItemshop->getNbItem() > 1) {
            $objLogAchats->setItem($objItemshop->getNameItem() . " (x" . $nombreItemBuy . ")");
        } else {
            $objLogAchats->setItem($objItemshop->getNameItem());
        }
        $objLogAchats->setQuantite($nombreItemBuy);
        $objLogAchats->setPrix($prixTotal);
        $objLogAchats->setMonnaie($ID_Monnaie);
        $objLogAchats->setIp($this->ipAdresse);
        $objLogAchats->setDate(\Carbon\Carbon::now());
        $objLogAchats->setResultat($Resultat_Achat);

        $em->persist($objLogAchats);
        $em->flush();

        if ($arrResult["result"] == 1) {
            $template = $this->objTwig->loadTemplate("ItemShopArticleBuy.html5.twig");
            $result = $template->render([
                "compte" => $this->objAccount->getLogin(),
                "article" => $objItemshop->getNameItem(),
                "nombre" => $nombreItemBuy,
                "prix" => $prixTotal,
                "identifiantAchat" => $objLogAchats->getId(),
            ]);
            $subject = 'VamosMT2 - Achat de ' . $objItemshop->getNameItem();
            \EmailHelper::sendEmail($this->objAccount->getEmail(), $subject, $result);
        }

        $arrResult["nombreBuy"] = $nombreItemBuy;
        $arrResult["idTransaction"] = $objLogAchats->getId();
        echo json_encode($arrResult);
    }

}

$class = new ajaxArticleBuy();
$class->run();

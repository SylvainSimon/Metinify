<?php

namespace Includes;

require __DIR__ . '../../../../core/initialize.php';

class ajaxArticleBuy extends \ScriptHelper {

    public $isProtected = true;

    public function Verification_Place_Inventaire_IS($Verification_Place_Account_Id, $lol, $Procedure_Achat_Item_Nombre = 1) {

        $countSafebox = \Player\PlayerHelper::getSafeboxRepository()->findByIdCompte($this->objAccount->getId());

        if ($countSafebox !== null) {

            $nextFreePosition = 0;
            $Variable_De_Sortie = false;

            /* ------------------------ Chercher Position ---------------------------- */
            $Chercher_Position = "SELECT id FROM player.item 
                                        WHERE owner_id = ?
                                        AND pos = ?
                                        AND window = 'MALL'";
            $Parametres_Chercher_Position = $this->objConnection->prepare($Chercher_Position);
            /* -------------------------------------------------------------------------- */

            while ($Variable_De_Sortie == false) {

                $Parametres_Chercher_Position->execute(array(
                    $Verification_Place_Account_Id,
                    $nextFreePosition));
                $Parametres_Chercher_Position->setFetchMode(\PDO::FETCH_OBJ);
                $Nombre_De_Resultat_Chercher_Position = $Parametres_Chercher_Position->rowCount();

                if ($Nombre_De_Resultat_Chercher_Position >= 1) {
                    $nextFreePosition++;
                } else {
                    $Variable_De_Sortie = true;
                }
            }

            // Si l'entrepot est plein
            if ($nextFreePosition > (44 - $Procedure_Achat_Item_Nombre)) {
                return false;
            } else {
                return $nextFreePosition;
            } // On renvoi le numéro de la position libre
        } else {
            return false;
        }
    }

    public function run() {

        global $session;
        global $request;
        $em = \Shared\DoctrineHelper::getEntityManager();

        $Tableau_Erreurs = '';

        $idItem = $request->request->get("id_item");
        $nombreItem = $request->request->get("nombre_item");

        $objItemshop = \Site\SiteHelper::getItemshopRepository()->findItem($idItem, true);

        /* ------- Si l'ID item est bien dans la table Itemshop -------- */
        if ($objItemshop !== null) {

            /* ------- Si l'item est de type Simple 1 -------- */
            if ($objItemshop->getType() == 1) {

                //Si le Membre a assez de Vamonaies
                if ($session->get("VamoNaies") >= ($objItemshop->getPrix() * $nombreItem)) {

                    $flagItem = \Player\PlayerHelper::getItemProtoRepository()->findFlagByVnum($objItemshop->getIdItem());

                    //Si empilable
                    if ($flagItem == 4 || $flagItem == 20 || $flagItem == 132 || $flagItem == 2052 || $flagItem == 8212) {

                        //Si l'entrepot n'est pas plein
                        if (is_numeric($this->Verification_Place_Inventaire_IS($this->objAccount->getId(), $this->objConnection))) {

                            $nextFreePosition = $this->Verification_Place_Inventaire_IS($this->objAccount->getId(), $this->objConnection);

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
                            //5: Entrepot plein.
                            $Tableau_Erreurs = 5;
                            $Resultat_Achat = "Entrepot Plein ou Inexistant";
                        }
                    } else {
                        //Si l'entrepot n'est pas plein
                        if (is_numeric($this->Verification_Place_Inventaire_IS($this->objAccount->getId(), $this->objConnection))) {

                            for ($i = 1; $i <= $nombreItem; $i++) {
                                $nextFreePosition = $this->Verification_Place_Inventaire_IS($this->objAccount->getId(), $this->objConnection);

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
                            ?>
                            <script type="text/javascript">
                                Fonction_Reteneuse_Vamonaies(<?php echo $session->get("VamoNaies"); ?>);
                                Fonction_Reteneuse_Tananaies(<?php echo $session->get("TanaNaies"); ?>);
                            </script>
                            <?php
                        } else {
                            $Tableau_Erreurs = 5;
                            $Resultat_Achat = "Entrepot Plein ou Inexistant";
                        }
                    }
                } else {
                    $Tableau_Erreurs = 3;
                    $Resultat_Achat = "Pas assez de VamoNaies";
                }

                /* ----------- Si l'item est de type durée ------------ */
            } elseif ($objItemshop->getType() == 2) {

                //Si le membre a assez de cash
                if ($_SESSION['VamoNaies'] >= $objItemshop->getPrix()) {

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
                    ?> 

                    <script type="text/javascript">
                        Fonction_Reteneuse_Vamonaies(<?php echo $session->get("VamoNaies"); ?>);
                        Fonction_Reteneuse_Tananaies(<?php echo $session->get("TanaNaies"); ?>);
                    </script>         
                    <?php
                } else {
                    $Tableau_Erreurs = 3;
                    $Resultat_Achat = "Pas assez de Vamonaies";
                }

                /* -------------- Si l'item est de type TanaNaies -------------- */
            } elseif ($objItemshop->getType() == 3) {
                //Si le membre a assez de marques
                if ($_SESSION['TanaNaies'] >= ($objItemshop->getPrix() * $nombreItem)) {

                    $flagItem = \Player\PlayerHelper::getItemProtoRepository()->findFlagByVnum($objItemshop->getIdItem());

                    //Si empilable
                    if ($flagItem == 4 || $flagItem == 20 || $flagItem == 132 || $flagItem == 2052 || $flagItem == 8212) {

                        //Si l'entrepot n'est pas plein
                        if (is_numeric($this->Verification_Place_Inventaire_IS($this->objAccount->getId(), $this->objConnection))) {

                            $nextFreePosition = $this->Verification_Place_Inventaire_IS($this->objAccount->getId(), $this->objConnection);

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
                            ?>
                            <script type="text/javascript">
                                Fonction_Reteneuse_Tananaies(<?php echo $session->get("TanaNaies"); ?>);
                            </script>
                            <?php
                        } else {
                            $Tableau_Erreurs = 5;
                            $Resultat_Achat = "Entrepot Plein ou Inexistant";
                        }
                    } else {
                        //Si l'entrepot n'est pas plein
                        if (is_numeric($this->Verification_Place_Inventaire_IS($this->objAccount->getId(), $this->objConnection))) {

                            for ($i = 1; $i <= $nombreItem; $i++) {
                                $nextFreePosition = $this->Verification_Place_Inventaire_IS($this->objAccount->getId(), $this->objConnection);

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
                            ?>
                            <script type="text/javascript">
                                Fonction_Reteneuse_Tananaies(<?php echo $session->get("TanaNaies"); ?>);
                            </script>
                            <?php
                        } else {
                            $Tableau_Erreurs = 5;
                            $Resultat_Achat = "Entrepot Plein ou Inexistant";
                        }//5: Entrepot plein.
                    }
                } else {
                    $Tableau_Erreurs = 6;
                    $Resultat_Achat = "Pas assez de TanaNaies";
                }//3: Pas assez de Marques.
            } else {
                $Tableau_Erreurs = 4;
                $Resultat_Achat = "Type de l'item non valide";
            }//4: Type de l'item non-valide.
        }

        if ($objItemshop->getType() == 1) {
            $ID_Monnaie = "1";
        } else if ($objItemshop->getType() == 3) {
            $ID_Monnaie = "2";
        } else if ($objItemshop->getType() == 2) {
            $ID_Monnaie = "1";
        }

        if ($Tableau_Erreurs != '') {
            $Resultat_Achat = "Erreur";
        } else {
            $Resultat_Achat = "Réussi";
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


        if ($Tableau_Erreurs != '') {
            echo $Tableau_Erreurs;
        } else {
            ?>
            <div class="box-body">
                <span class="text-green">Achat terminé avec succée.</span>
                <br/>
                <br/>

                L'article a été placé dans votre entrepôt item-shop.<br/><br/>
                <span class="text-yellow">Le numéro de transaction est le : <?php echo $objLogAchats->getId(); ?></span><br/>
                Gardez le précieusement, il vous sera utile en cas de réclamation.<br/><br/>
                En cas de problème n'hésitez pas à contacter le support de VamosMt2.<br/>
            </div>

            <div class="box-footer">
                <input type="button" class="btn btn-primary btn-flat" value="Retourner à l'Item-Shop" onclick="Ajax('pages/ItemShop/ItemShop.php');" />
            </div>

            <?php
        }
    }

}

$class = new ajaxArticleBuy();
$class->run();

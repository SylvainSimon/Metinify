<?php

namespace Includes;

require __DIR__ . '../../../../core/initialize.php';

class ajaxArticleBuy extends \PageHelper {

    public function Verification_Place_Inventaire_IS($Verification_Place_Account_Id, $lol, $Procedure_Achat_Item_Nombre = 1) {


        /* ------------------------ Vérification Item ID ---------------------------- */
        $Verification_Existance_Entrepot = "SELECT size FROM player.safebox 
                                                    WHERE account_id = ? 
                                                    LIMIT 1";
        $Parametres_Verification_Existance_Entrepot = $this->objConnection->prepare($Verification_Existance_Entrepot);
        $Parametres_Verification_Existance_Entrepot->execute(array(
            $Verification_Place_Account_Id));
        $Parametres_Verification_Existance_Entrepot->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Verification_Existance_Entrepot = $Parametres_Verification_Existance_Entrepot->rowCount();
        /* -------------------------------------------------------------------------- */

        /* -------------- Si le compte possède bien un entrepot ----------- */
        if ($Nombre_De_Resultat_Verification_Existance_Entrepot == 1) {

            $Index_Position = 0;
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
                    $Index_Position));
                $Parametres_Chercher_Position->setFetchMode(\PDO::FETCH_OBJ);
                $Nombre_De_Resultat_Chercher_Position = $Parametres_Chercher_Position->rowCount();

                if ($Nombre_De_Resultat_Chercher_Position >= 1) {
                    $Index_Position++;
                } else {
                    $Variable_De_Sortie = true;
                }
            }

            // Si l'entrepot est plein
            if ($Index_Position > (44 - $Procedure_Achat_Item_Nombre)) {
                return false;
            } else {
                return $Index_Position;
            } // On renvoi le numéro de la position libre
        } else {
            /* --- N'as pas d'entrepot --- */
            return false;
        }
    }

    public function run() {
        ?>

        <?php
        if (empty($_SESSION['ID'])) {

            echo "Vous n'êtes pas connecté";
            exit();
        }
        ?>

        <?php
        /* ------------------------ Vérification Données ---------------------------- */
        $Verification_Donnees = "SELECT cash, mileage FROM account.account
                                  WHERE id = ?
                                  LIMIT 1";
        $Parametres_Verification_Donnees = $this->objConnection->prepare($Verification_Donnees);
        $Parametres_Verification_Donnees->execute(array(
            $_SESSION['ID']));
        $Parametres_Verification_Donnees->setFetchMode(\PDO::FETCH_OBJ);
        /* -------------------------------------------------------------------------- */

        $Donnees_Verification_Donnees = $Parametres_Verification_Donnees->fetch();

        $_SESSION['VamoNaies'] = $Donnees_Verification_Donnees->cash;
        $_SESSION['TanaNaies'] = $Donnees_Verification_Donnees->mileage;
        $Achat_Ip = $_SERVER['REMOTE_ADDR'];
        ?>

        <?php
        $Procedure_Achat_User_ID = $_SESSION['ID'];
        $Tableau_Erreurs = '';

        $Array_Bonus_Compte = array(
            '1' => 'gold_expire',
            '2' => 'silver_expire',
            '3' => 'safebox_expire',
            '4' => 'autoloot_expire',
            '5' => 'fish_mind_expire',
            '6' => 'marriage_fast_expire',
            '7' => 'money_drop_rate_expire');



        $Procedure_Achat_Parametres_Item_ID = $_POST['id_item'];
        $Procedure_Achat_Parametres_Item_Nombre = $_POST['nombre_item'];

        /* ------------------------ Vérification Item ID ---------------------------- */
        $Verification_Item_ID = "SELECT id FROM site.itemshop 
                                   WHERE id = ? 
                                   AND actif = ?
                                   LIMIT 1";
        $Parametres_Verification_Item_ID = $this->objConnection->prepare($Verification_Item_ID);
        $Parametres_Verification_Item_ID->execute(array(
            $Procedure_Achat_Parametres_Item_ID,
            "1"));
        $Parametres_Verification_Item_ID->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Verification_Item_ID = $Parametres_Verification_Item_ID->rowCount();
        /* -------------------------------------------------------------------------- */

        /* ------- Si l'ID item est bien dans la table Itemshop -------- */
        if ($Nombre_De_Resultat_Verification_Item_ID == 1) {

            /* ---------------- Récuperation des informations sur l'item ------------ */
            $Recuperation_Information = "SELECT * FROM site.itemshop 
                                   WHERE id = ? 
                                   AND actif = ?
                                   LIMIT 1";
            $Parametres_Recuperation_Information = $this->objConnection->prepare($Recuperation_Information);
            $Parametres_Recuperation_Information->execute(array(
                $Procedure_Achat_Parametres_Item_ID,
                "1"));
            $Parametres_Recuperation_Information->setFetchMode(\PDO::FETCH_OBJ);
            /* ------------------------------------------------------------------------- */

            $Donnees_Recuperation_Information = $Parametres_Recuperation_Information->fetch();

            $Procedure_Achat_Item_Prix = $Donnees_Recuperation_Information->prix;
            $Procedure_Achat_Item_Nombre = $Donnees_Recuperation_Information->nb_item;
            $Procedure_Achat_Item_Vnum = $Donnees_Recuperation_Information->id_item;
            $Procedure_Achat_Item_Nom = $Donnees_Recuperation_Information->name_item;


            /* ------- Si l'item est de type Simple 1 -------- */
            if ($Donnees_Recuperation_Information->type == 1) {

                //Si le Membre a assez de Vamonaies
                if ($_SESSION['VamoNaies'] >= ($Procedure_Achat_Item_Prix * $Procedure_Achat_Parametres_Item_Nombre)) {

                    /* ---------------- Récuperation des informations sur l'item ------------ */
                    $Recuperation_Flag = "SELECT flag FROM player.item_proto 
                                              WHERE vnum = ?
                                              LIMIT 1";
                    $Parametres_Recuperation_Flag = $this->objConnection->prepare($Recuperation_Flag);
                    $Parametres_Recuperation_Flag->execute(array(
                        $Procedure_Achat_Item_Vnum));
                    $Parametres_Recuperation_Flag->setFetchMode(\PDO::FETCH_OBJ);
                    /* ------------------------------------------------------------------------- */

                    $Donnees_Recuperation_Flag = $Parametres_Recuperation_Flag->fetch();

                    $Procedure_Achat_Item_Flac = $Donnees_Recuperation_Flag->flag;


                    /* ------------ Si l'item est empilable --------------- */
                    if ($Procedure_Achat_Item_Flac == 4 ||
                            $Procedure_Achat_Item_Flac == 20 ||
                            $Procedure_Achat_Item_Flac == 132 ||
                            $Procedure_Achat_Item_Flac == 2052 ||
                            $Procedure_Achat_Item_Flac == 8212) {

                        //Si l'entrepot n'est pas plein
                        if (is_numeric($this->Verification_Place_Inventaire_IS($Procedure_Achat_User_ID, $this->objConnection))) {

                            $Index_Position = $this->Verification_Place_Inventaire_IS($Procedure_Achat_User_ID, $this->objConnection);

                            /* -------------------------- Insertion de l'item ----------------- */
                            $Insertion_Logs = "INSERT INTO player.item (owner_id, window, pos, count, vnum) 
                                              VALUES (:owner_id, :window, :pos, :count, :vnum)";

                            $Parametres_Insertion = $this->objConnection->prepare($Insertion_Logs);
                            $Parametres_Insertion->execute(array(
                                ':owner_id' => $Procedure_Achat_User_ID,
                                ':window' => "MALL",
                                ':pos' => $Index_Position,
                                ':count' => $Procedure_Achat_Parametres_Item_Nombre,
                                ':vnum' => $Procedure_Achat_Item_Vnum));
                            /* ----------------------------------------------------------------------------- */

                            /* -------------------------- Debit des VamoNaies ----------------- */
                            $Update_Monnaies = "UPDATE account.account 
                                               SET cash = cash - ?, 
                                                   mileage = mileage + ?  
                                               WHERE id = ?
                                               LIMIT 1";

                            $Parametres_Update_Monnaies = $this->objConnection->prepare($Update_Monnaies);
                            $Parametres_Update_Monnaies->execute(array(
                                ($Procedure_Achat_Item_Prix * $Procedure_Achat_Parametres_Item_Nombre),
                                ($Procedure_Achat_Item_Prix * $Procedure_Achat_Parametres_Item_Nombre),
                                $Procedure_Achat_User_ID));
                            /* ----------------------------------------------------------------------------- */
                            ?>
                            <?php $_SESSION['VamoNaies'] = ($_SESSION['VamoNaies'] - ($Procedure_Achat_Item_Prix * $Procedure_Achat_Parametres_Item_Nombre)); ?> 
                            <?php $_SESSION['TanaNaies'] = ($_SESSION['TanaNaies'] + ($Procedure_Achat_Item_Prix * $Procedure_Achat_Parametres_Item_Nombre)); ?> 
                            <?php
                        } else {
                            //5: Entrepot plein.
                            $Tableau_Erreurs = 5;
                            $Resultat_Achat = "Entrepot Plein ou Inexistant";
                        }
                    }

                    //Sinon on distribue les items dans des cases différentes
                    else {
                        //Si l'entrepot n'est pas plein
                        if (is_numeric($this->Verification_Place_Inventaire_IS($Procedure_Achat_User_ID, $this->objConnection))) {

                            /* --------------------------- Insertion de l'item ---------------------------- */
                            $Insertion_Logs = "INSERT INTO player.item (owner_id, window, pos, count, vnum, socket0, socket1, socket2) 
                                              VALUES (:owner_id, :window, :pos, :count, :vnum, :socket0, :socket1, :socket2)";

                            $Parametres_Insertion = $this->objConnection->prepare($Insertion_Logs);
                            /* ---------------------------------------------------------------------------- */

                            for ($i = 1; $i <= $Procedure_Achat_Parametres_Item_Nombre; $i++) {

                                $Index_Position = $this->Verification_Place_Inventaire_IS($Procedure_Achat_User_ID, $this->objConnection);

                                $Parametres_Insertion->execute(array(
                                    ':owner_id' => $Procedure_Achat_User_ID,
                                    ':window' => "MALL",
                                    ':pos' => $Index_Position,
                                    ':count' => "1",
                                    ':vnum' => $Procedure_Achat_Item_Vnum,
                                    ':socket0' => "1",
                                    ':socket1' => "1",
                                    ':socket2' => "1"));
                            }

                            if (($Procedure_Achat_Item_Vnum == "2613") || ($Procedure_Achat_Item_Vnum == "2614")) {
                                /* -------------------------- Debit des VamoNaies ----------------- */
                                $Update_Monnaies = "UPDATE account.account 
                                               SET cash = cash - ? 
                                               WHERE id = ?
                                               LIMIT 1";

                                $Parametres_Update_Monnaies = $this->objConnection->prepare($Update_Monnaies);
                                $Parametres_Update_Monnaies->execute(array(
                                    ($Procedure_Achat_Item_Prix * $Procedure_Achat_Parametres_Item_Nombre),
                                    $Procedure_Achat_User_ID));
                                /* ----------------------------------------------------------------------------- */
                            } else {
                                /* -------------------------- Debit des VamoNaies ----------------- */
                                $Update_Monnaies = "UPDATE account.account 
                                               SET cash = cash - ?, 
                                                   mileage = mileage + ?  
                                               WHERE id = ?
                                               LIMIT 1";

                                $Parametres_Update_Monnaies = $this->objConnection->prepare($Update_Monnaies);
                                $Parametres_Update_Monnaies->execute(array(
                                    ($Procedure_Achat_Item_Prix * $Procedure_Achat_Parametres_Item_Nombre),
                                    ($Procedure_Achat_Item_Prix * $Procedure_Achat_Parametres_Item_Nombre),
                                    $Procedure_Achat_User_ID));
                                /* ----------------------------------------------------------------------------- */
                            }
                            ?>

                            <?php
                            if (($Procedure_Achat_Item_Vnum == "2613") || ($Procedure_Achat_Item_Vnum == "2614")) {
                                ?>
                                <?php $_SESSION['VamoNaies'] = ($_SESSION['VamoNaies'] - ($Procedure_Achat_Item_Prix * $Procedure_Achat_Parametres_Item_Nombre)); ?> 

                                <script type="text/javascript">
                                    window.parent.Fonction_Reteneuse_Vamonaies(<?php echo $_SESSION['VamoNaies']; ?>);
                                </script>
                            <?php } else { ?>
                                <?php $_SESSION['VamoNaies'] = ($_SESSION['VamoNaies'] - ($Procedure_Achat_Item_Prix * $Procedure_Achat_Parametres_Item_Nombre)); ?> 
                                <?php $_SESSION['TanaNaies'] = ($_SESSION['TanaNaies'] + ($Procedure_Achat_Item_Prix * $Procedure_Achat_Parametres_Item_Nombre)); ?> 

                                <script type="text/javascript">
                                    window.parent.Fonction_Reteneuse_Vamonaies(<?php echo $_SESSION['VamoNaies']; ?>);
                                    window.parent.Fonction_Reteneuse_Tananaies(<?php echo $_SESSION['TanaNaies']; ?>);
                                </script>
                            <?php } ?>
                            <?php
                        } else {
                            $Tableau_Erreurs = 5;
                            $Resultat_Achat = "Entrepot Plein ou Inexistant";
                        }//5: Entrepot plein.
                    }
                } else {
                    $Tableau_Erreurs = 3;
                    $Resultat_Achat = "Pas assez de VamoNaies";
                }//3: Pas assez de cash.

                /* ----------- Si l'item est de type durée ------------ */
            } elseif ($Donnees_Recuperation_Information->type == 2) {
                //Si le membre a assez de cash
                if ($_SESSION['VamoNaies'] >= $Procedure_Achat_Item_Prix) {

                    $bonus = $Array_Bonus_Compte[$Procedure_Achat_Item_Vnum];

                    $AnneeActuel = date("Y");
                    $Nombre_Annee = (2037 - $AnneeActuel);

                    if ($Procedure_Achat_Item_Nombre == 9999) {

                        /* ----------------------------- Update Temps de Bonus ------------------------- */
                        $Update_Monnaies = "UPDATE account.account 
                                               SET $bonus = (NOW() + INTERVAL $Nombre_Annee YEAR)
                                               WHERE id = ?
                                               LIMIT 1";

                        $Parametres_Update_Monnaies = $this->objConnection->prepare($Update_Monnaies);
                        $Parametres_Update_Monnaies->execute(array(
                            $Procedure_Achat_User_ID));
                        /* ----------------------------------------------------------------------------- */
                    } else {

                        /* ------------------------ Vérification Item ID ---------------------------- */
                        $Recuperation_Bonus = "SELECT $bonus 
                                                FROM account.account 
                                                WHERE id = ?
                                                AND $bonus > NOW()
                                                LIMIT 1";
                        $Parametres_Recuperation_Bonus = $this->objConnection->prepare($Recuperation_Bonus);
                        $Parametres_Recuperation_Bonus->execute(array(
                            $Procedure_Achat_User_ID));
                        $Parametres_Recuperation_Bonus->setFetchMode(\PDO::FETCH_OBJ);
                        /* -------------------------------------------------------------------------- */
                        $Nombre_De_Resultat_Bonus = $Parametres_Recuperation_Bonus->rowCount();

                        if ($Nombre_De_Resultat_Bonus == 1) {

                            $Donnees_Bonus = $Parametres_Recuperation_Bonus->fetch();

                            /* ----------------------------- Update Temps de Bonus ------------------------- */
                            $Update_Monnaies = "UPDATE account.account 
                                               SET $bonus = ($bonus + INTERVAL $Procedure_Achat_Item_Nombre DAY)
                                               WHERE id = ?
                                               LIMIT 1";

                            $Parametres_Update_Monnaies = $this->objConnection->prepare($Update_Monnaies);
                            $Parametres_Update_Monnaies->execute(array(
                                $Procedure_Achat_User_ID));
                            /* ----------------------------------------------------------------------------- */
                        } else if ($Nombre_De_Resultat_Bonus == 0) {

                            /* ----------------------------- Update Temps de Bonus ------------------------- */
                            $Update_Monnaies = "UPDATE account.account 
                                               SET $bonus = (NOW() + INTERVAL $Procedure_Achat_Item_Nombre DAY)
                                               WHERE id = ?
                                               LIMIT 1";

                            $Parametres_Update_Monnaies = $this->objConnection->prepare($Update_Monnaies);
                            $Parametres_Update_Monnaies->execute(array(
                                $Procedure_Achat_User_ID));
                            /* ----------------------------------------------------------------------------- */
                        }
                    }

                    /* -------------------------- Debit des VamoNaies ----------------- */
                    $Update_Monnaies = "UPDATE account.account 
                                               SET cash = cash - ?, 
                                                   mileage = mileage + ?  
                                               WHERE id = ?
                                               LIMIT 1";

                    $Parametres_Update_Monnaies = $this->objConnection->prepare($Update_Monnaies);
                    $Parametres_Update_Monnaies->execute(array(
                        ($Procedure_Achat_Item_Prix * $Procedure_Achat_Parametres_Item_Nombre),
                        ($Procedure_Achat_Item_Prix * $Procedure_Achat_Parametres_Item_Nombre),
                        $Procedure_Achat_User_ID));
                    /* ----------------------------------------------------------------------------- */
                    ?>
                    <?php $_SESSION['VamoNaies'] = ($_SESSION['VamoNaies'] - ($Procedure_Achat_Item_Prix * $Procedure_Achat_Parametres_Item_Nombre)); ?> 
                    <?php $_SESSION['TanaNaies'] = ($_SESSION['TanaNaies'] + ($Procedure_Achat_Item_Prix * $Procedure_Achat_Parametres_Item_Nombre)); ?> 

                    <script type="text/javascript">
                        window.parent.Fonction_Reteneuse_Vamonaies(<?php echo $_SESSION['VamoNaies']; ?>);
                        window.parent.Fonction_Reteneuse_Tananaies(<?php echo $_SESSION['TanaNaies']; ?>);
                    </script>            
                    <?php
                } else {
                    $Tableau_Erreurs = 3;
                    $Resultat_Achat = "Pas assez de Vamonaies";
                }//3: Pas assez de cash.

                /* -------------- Si l'item est de type TanaNaies -------------- */
            } elseif ($Donnees_Recuperation_Information->type == 3) {
                //Si le membre a assez de marques
                if ($_SESSION['TanaNaies'] >= ($Procedure_Achat_Item_Prix * $Procedure_Achat_Parametres_Item_Nombre)) {
                    //Si l'entrepot n'est pas plein
                    /* ---------------- Récuperation des informations sur l'item ------------ */
                    $Recuperation_Flag = "SELECT flag FROM player.item_proto 
                                              WHERE vnum = ?
                                              LIMIT 1";
                    $Parametres_Recuperation_Flag = $this->objConnection->prepare($Recuperation_Flag);
                    $Parametres_Recuperation_Flag->execute(array(
                        $Procedure_Achat_Item_Vnum));
                    $Parametres_Recuperation_Flag->setFetchMode(\PDO::FETCH_OBJ);
                    /* ------------------------------------------------------------------------- */

                    $Donnees_Recuperation_Flag = $Parametres_Recuperation_Flag->fetch();

                    $Procedure_Achat_Item_Flac = $Donnees_Recuperation_Flag->flag;


                    /* ------------ Si l'item est empilable --------------- */
                    if ($Procedure_Achat_Item_Flac == 4 ||
                            $Procedure_Achat_Item_Flac == 20 ||
                            $Procedure_Achat_Item_Flac == 132 ||
                            $Procedure_Achat_Item_Flac == 2052 ||
                            $Procedure_Achat_Item_Flac == 8212) {

                        //Si l'entrepot n'est pas plein
                        if (is_numeric($this->Verification_Place_Inventaire_IS($Procedure_Achat_User_ID, $this->objConnection))) {

                            $Index_Position = $this->Verification_Place_Inventaire_IS($Procedure_Achat_User_ID, $this->objConnection);

                            /* -------------------------- Insertion de l'item ----------------- */
                            $Insertion_Logs = "INSERT INTO player.item (owner_id, window, pos, count, vnum) 
                                              VALUES (:owner_id, :window, :pos, :count, :vnum)";

                            $Parametres_Insertion = $this->objConnection->prepare($Insertion_Logs);
                            $Parametres_Insertion->execute(array(
                                ':owner_id' => $Procedure_Achat_User_ID,
                                ':window' => "MALL",
                                ':pos' => $Index_Position,
                                ':count' => $Procedure_Achat_Parametres_Item_Nombre,
                                ':vnum' => $Procedure_Achat_Item_Vnum));
                            /* ----------------------------------------------------------------------------- */

                            /* -------------------------- Debit des VamoNaies ----------------- */
                            $Update_Monnaies = "UPDATE account.account 
                                               SET mileage = mileage - ?  
                                               WHERE id = ?
                                               LIMIT 1";

                            $Parametres_Update_Monnaies = $this->objConnection->prepare($Update_Monnaies);
                            $Parametres_Update_Monnaies->execute(array(
                                ($Procedure_Achat_Item_Prix * $Procedure_Achat_Parametres_Item_Nombre),
                                $Procedure_Achat_User_ID));
                            /* ----------------------------------------------------------------------------- */
                            ?>
                            <?php $_SESSION['TanaNaies'] = ($_SESSION['TanaNaies'] - ($Procedure_Achat_Item_Prix * $Procedure_Achat_Parametres_Item_Nombre)); ?> 

                            <script type="text/javascript">
                                window.parent.Fonction_Reteneuse_Tananaies(<?php echo $_SESSION['TanaNaies']; ?>);
                            </script>
                            <?php
                        } else {
                            //5: Entrepot plein.
                            $Tableau_Erreurs = 5;
                            $Resultat_Achat = "Entrepot Plein ou Inexistant";
                        }
                    }

                    //Sinon on empile les items
                    else {
                        //Si l'entrepot n'est pas plein
                        if (is_numeric($this->Verification_Place_Inventaire_IS($Procedure_Achat_User_ID, $this->objConnection))) {

                            /* --------------------------- Insertion de l'item ---------------------------- */
                            $Insertion_Logs = "INSERT INTO player.item (owner_id, window, pos, count, vnum, socket0, socket1, socket2) 
                                              VALUES (:owner_id, :window, :pos, :count, :vnum, :socket0, :socket1, :socket2)";

                            $Parametres_Insertion = $this->objConnection->prepare($Insertion_Logs);
                            /* ---------------------------------------------------------------------------- */

                            for ($i = 1; $i <= $Procedure_Achat_Parametres_Item_Nombre; $i++) {

                                $Index_Position = $this->Verification_Place_Inventaire_IS($Procedure_Achat_User_ID, $this->objConnection);

                                $Parametres_Insertion->execute(array(
                                    ':owner_id' => $Procedure_Achat_User_ID,
                                    ':window' => "MALL",
                                    ':pos' => $Index_Position,
                                    ':count' => "1",
                                    ':vnum' => $Procedure_Achat_Item_Vnum,
                                    ':socket0' => "1",
                                    ':socket1' => "1",
                                    ':socket2' => "1"));
                            }

                            /* -------------------------- Debit des VamoNaies ----------------- */
                            $Update_Monnaies = "UPDATE account.account 
                                               SET mileage = mileage - ?  
                                               WHERE id = ?
                                               LIMIT 1";

                            $Parametres_Update_Monnaies = $this->objConnection->prepare($Update_Monnaies);
                            $Parametres_Update_Monnaies->execute(array(
                                ($Procedure_Achat_Item_Prix * $Procedure_Achat_Parametres_Item_Nombre),
                                $Procedure_Achat_User_ID));
                            /* ----------------------------------------------------------------------------- */
                            ?>
                            <?php $_SESSION['TanaNaies'] = ($_SESSION['TanaNaies'] - ($Procedure_Achat_Item_Prix * $Procedure_Achat_Parametres_Item_Nombre)); ?> 

                            <script type="text/javascript">
                                window.parent.Fonction_Reteneuse_Tananaies(<?php echo $_SESSION['TanaNaies']; ?>);
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
        ?>
        <?php
        /* ------------------------ Check dernier numéro ---------------------------- */
        $Dernier_Numero = "SELECT id FROM site.log_achats ORDER by id DESC LIMIT 1";
        $Parametres_Dernier_Numero = $this->objConnection->prepare($Dernier_Numero);
        $Parametres_Dernier_Numero->execute();
        $Parametres_Dernier_Numero->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Dernier_Numero = $Parametres_Dernier_Numero->rowCount();
        /* -------------------------------------------------------------------------- */

        $Donnees_Dernier_Numero = $Parametres_Dernier_Numero->fetch();
        ?>
        <?php
        if ($Nombre_De_Resultat_Dernier_Numero == 0) {

            $Dernier_Numero = "1";
        } else {

            $Dernier_Numero = ($Donnees_Dernier_Numero->id + 1);
        }
        ?>

        <?php
        if ($Tableau_Erreurs != '') {

            echo $Tableau_Erreurs;
        } else {

            $Resultat_Achat = "Réussi";
            ?>

            <div class="box-body">
                <span class="text-green">Achat terminé avec succée.</span>
                <br/>
                <br/>

                L'article a été placé dans votre entrepôt item-shop.<br/><br/>
                <span class="text-yellow">Le numéro de transaction est le : <?php echo $Dernier_Numero; ?></span><br/>
                Gardez le précieusement, il vous sera utile en cas de réclamation.<br/><br/>
                En cas de problème n'hésitez pas à contacter le support de VamosMt2.<br/>
            </div>

            <div class="box-footer">
                <input type="button" class="btn btn-primary btn-flat" value="Accueil" onclick="Ajax('pages/_LegacyPages/Accueil.php');" />
            </div>

            <?php
        }
        ?>
        <?php
        if ($Donnees_Recuperation_Information->type == 1) {
            $ID_Monnaie = "1";
        } else if ($Donnees_Recuperation_Information->type == 3) {
            $ID_Monnaie = "2";
        } else if ($Donnees_Recuperation_Information->type == 2) {
            $ID_Monnaie = "1";
        }

        /* --------------------------- Insertion de l'item ---------------------------- */
        $Insertion_Logs = "INSERT INTO site.log_achats (id, id_compte, compte, vnum_item, item, quantite, prix, monnaie, date, ip, resultat) 
                              VALUES (:id, :id_compte, :compte, :vnum_item, :item, :quantite, :prix, :monnaie, NOW(), :ip, :resultat)";

        $Parametres_Insertion = $this->objConnection->prepare($Insertion_Logs);
        $Parametres_Insertion->execute(array(
            ':id' => $Dernier_Numero,
            ':id_compte' => $Procedure_Achat_User_ID,
            ':compte' => $_SESSION['Utilisateur'],
            ':vnum_item' => $Procedure_Achat_Item_Vnum,
            ':item' => $Procedure_Achat_Item_Nom,
            ':quantite' => $Procedure_Achat_Parametres_Item_Nombre,
            ':prix' => ($Procedure_Achat_Item_Prix * $Procedure_Achat_Parametres_Item_Nombre),
            ':monnaie' => $ID_Monnaie,
            ':ip' => $Achat_Ip,
            ':resultat' => $Resultat_Achat));
        /* ---------------------------------------------------------------------------- */
        ?>
        <?php
    }

}

$class = new ajaxArticleBuy();
$class->run();

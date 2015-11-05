<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class payement extends \PageHelper {

    public function run() {

        $Rechargement_Ip = $_SERVER["REMOTE_ADDR"];

        $Resultat_Paiement = false;

        if (@!empty($_GET['RECALL'])) {
            
            $RECALL = urlencode($_GET['RECALL']);

            $r = @file("http://payment.allopass.com/api/checkcode.apu?code=$RECALL&auth=227909/898935/4188626");

            if (substr($r[0], 0, 2) == "OK") {

                $Resultat_Paiement = true;
            }
            else {

                $Resultat_Rechargement = "Raté";
            }
        }

        $objAccount = \Account\AccountHelper::getAccountRepository()->find($_GET['data']);

        /* ------------------------ Check dernier numéro ---------------------------- */
        $Dernier_Numero = "SELECT id FROM site.logs_rechargements ORDER by id DESC LIMIT 1";
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

        if ($Resultat_Paiement) {

            $Resultat_Rechargement = "Réussi";

            /* -------------------------- Update des VamoNaies ----------------------------- */
            $Update_Monnaies = "UPDATE account.account 
                        SET cash = cash + 1350 
                        WHERE id = ?
                        LIMIT 1";

            $Parametres_Update_Monnaies = $this->objConnection->prepare($Update_Monnaies);
            $Parametres_Update_Monnaies->execute(array(
                $_GET['data']));
            /* ----------------------------------------------------------------------------- */

            if (!empty($_SESSION['ID'])) {
                $_SESSION['VamoNaies'] = ($_SESSION['VamoNaies'] + 1350);
            }

            /* --------------------------- Insertion des logs ---------------------------- */
            $Insertion_Logs = "INSERT INTO site.logs_rechargements (id, id_compte, compte, email_compte, code, nombre_vamonaies, date, resultat, ip) 
                                              VALUES (:id, :id_compte, :compte, :email_compte, :code, :nombre_vamonaies, NOW(), :resultat, :ip)";

            $Parametres_Insertion = $this->objConnection->prepare($Insertion_Logs);
            $Parametres_Insertion->execute(array(
                ':id' => $Dernier_Numero,
                ':id_compte' => $objAccount->getId(),
                ':compte' => $objAccount->getLogin(),
                ':email_compte' => $objAccount->getEmail(),
                ':code' => $_GET['RECALL'],
                ':nombre_vamonaies' => "1350",
                ':resultat' => $Resultat_Rechargement,
                ':ip' => $Rechargement_Ip));
            /* ---------------------------------------------------------------------------- */

            if (!empty($_SESSION['ID'])) {
                header('Location: ItemShopRechargementTerm.php?Resultat=Reussi&id_compte=' . $_GET['data'] . '&id=' . $Dernier_Numero . '&compteur=oui');
                exit;
            } else {
                header('Location: ItemShopRechargementTerm.php?Resultat=Reussi&id_compte=' . $_GET['data'] . '&id=' . $Dernier_Numero . '&compteur=non');
            }
            ?>
        <?php } else { ?>

            <?php

            $Resultat_Rechargement = "Mauvaise clès";

            /* --------------------------- Insertion des logs ---------------------------- */
            $Insertion_Logs = "INSERT INTO site.logs_rechargements (id, id_compte, compte, email_compte, code, date, resultat, ip) 
                                              VALUES (:id, :id_compte, :compte, :email_compte, :code, NOW(), :resultat, :ip)";

            $Parametres_Insertion = $this->objConnection->prepare($Insertion_Logs);
            $Parametres_Insertion->execute(array(
                ':id' => $Dernier_Numero,
                ':id_compte' => $objAccount->getId(),
                ':compte' => $objAccount->getLogin(),
                ':email_compte' => $objAccount->getEmail(),
                ':code' => $_GET['RECALL'],
                ':resultat' => $Resultat_Rechargement,
                ':ip' => $Rechargement_Ip));
            /* ---------------------------------------------------------------------------- */

            header('Location: ItemShopRechargementTerm.php?Resultat=Rate&Raison=ClesMauvaise&id_compte=' . $_GET['data'] . '&id=' . $Dernier_Numero . '');
            exit;
        }
        ?>
        <?php

    }

}

$class = new payement();
$class->run();

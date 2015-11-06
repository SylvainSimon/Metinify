<?php

namespace Administration;

require __DIR__ . '../../core/initialize.php';

class Sidebar_Gauche_Seconde extends \PageHelper {

    public $isProtected = true;
    public $isAdminProtected = true;

    public function run() {

        /* ------------------------ Vérification Données ---------------------------- */
        $Recuperation_Droits = "SELECT * 
                        FROM site.administration_users
                        WHERE id_compte = :id_compte
                        LIMIT 1";
        $Parametres_Recuperation_Droits = $this->objConnection->prepare($Recuperation_Droits);
        $Parametres_Recuperation_Droits->execute(array(':id_compte' => $_SESSION["ID"]));
        $Parametres_Recuperation_Droits->setFetchMode(\PDO::FETCH_OBJ);
        $Donnees_Recuperation_Droits = $Parametres_Recuperation_Droits->fetch();
        /* -------------------------------------------------------------------------- */
        ?>

        <div class="box box-default flat">
            <div class="box-header">
                <h3 class="box-title">Serveur</h3>
            </div>
            <div class="box-body no-padding">

                <table class="table table-condensed" style="border-collapse: collapse;">
                    <?php if ($Donnees_Recuperation_Droits->recherche_joueurs == 1) { ?>
                        <tr onclick="Ajax('administration/Recherche_Joueurs.php')"><td>- Recherche de joueurs sgm</td></tr>
                    <?php } ?>
                    <?php if ($Donnees_Recuperation_Droits->recherche_joueurs_admin == 1) { ?>
                        <tr onclick="Ajax('administration/Recherche_Joueurs_Admin.php')"><td>- Recherche de joueurs admin</td></tr>
                    <?php } ?>
                    <?php if ($Donnees_Recuperation_Droits->recherche_comptes == 1) { ?>
                        <tr onclick="Ajax('administration/Recherche_Comptes.php')"><td>- Recherche de comptes</td></tr>
                    <?php } ?>
                    <?php if ($Donnees_Recuperation_Droits->recherche_emails == 1) { ?>
                        <tr onclick="Ajax('administration/Recherche_Emails.php')"><td>- Recherche d'emails</td></tr>
                    <?php } ?>
                    <?php if ($Donnees_Recuperation_Droits->recherche_ip == 1) { ?>
                        <tr onclick="Ajax('administration/Recherche_IP.php')"><td>- Recherche par ip</td></tr>
                    <?php } ?>
                    <?php if ($Donnees_Recuperation_Droits->commandes == 1) { ?>
                        <tr onclick="Ajax('administration/Commandes.php')"><td>- Historiques des commandes</td></tr>
                    <?php } ?>
                    <?php if ($Donnees_Recuperation_Droits->mp == 1) { ?>
                        <tr onclick="Ajax('administration/Messages_Prives.php')"><td>- Historiques des messages privés</td></tr>
                    <?php } ?>
                    <?php if ($Donnees_Recuperation_Droits->recherche_guildes == 1) { ?>
                           <!-- <tr><td>- Recherche de guildes</td></tr> -->
                    <?php } ?>
                    <?php if ($Donnees_Recuperation_Droits->recherche_pecheurs == 1) { ?>
                           <!-- <tr><td>- Recherche de pêcheurs</td></tr> -->
                    <?php } ?>
                    <?php if ($Donnees_Recuperation_Droits->recherche_maries == 1) { ?>
                           <!-- <tr><td>- Recherche de mariés</td></tr> -->
                    <?php } ?>
                    <?php if ($Donnees_Recuperation_Droits->recherche_items == 1) { ?>
                           <!-- <tr><td>- Recherche d'items</td></tr> -->
                    <?php } ?>
                    <?php if ($Donnees_Recuperation_Droits->recherche_bannissements == 1) { ?>
                           <!-- <tr><td>- Recherche de bannissements</td></tr> -->
                    <?php } ?>
                    <?php if ($Donnees_Recuperation_Droits->recherche_renames == 1) { ?>
                           <!-- <tr><td>- Recherche de renames</td></tr> -->
                    <?php } ?>
                </table>
            </div>
        </div>
        <?php
    }

}

$class = new Sidebar_Gauche_Seconde();
$class->run();

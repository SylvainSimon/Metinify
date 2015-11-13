<?php

namespace Pages\MonCompte;

require __DIR__ . '../../../../core/initialize.php';

class MonCompte extends \PageHelper {

    public $isProtected = true;

    public function run() {

        global $request;
        parent::VerifMonCompte(\Encryption::decryptForUrl($request->query->get("id")));
                
        include __DIR__ . '../../../../pages/Tableaux_Arrays.php';

        /* ------------------------------ Vérification connecte ---------------------------------------------- */
        $Verification_Connecte = "SELECT id FROM player.player
                          WHERE player.id = ?
                          AND player.last_play >= (NOW() - INTERVAL 30 MINUTE)
                          LIMIT 1";
        $Parametres_Verification_Connecte = $this->objConnection->prepare($Verification_Connecte);
        /* -------------------------------------------------------------------------------------------------- */

        /* ------------------------ Recuperation Compte ----------------------------- */
        $Appel_Compte = "SELECT account.login,
                        account.id,
                        account.social_id,
                        account.ip_creation,
                        account.email,
                        account.status,
                        account.gold_expire,
                        account.silver_expire,
                        account.safebox_expire,
                        account.autoloot_expire,
                        account.fish_mind_expire,
                        account.marriage_fast_expire,
                        account.money_drop_rate_expire,
                        account.create_time,
                        safebox.size AS Safebox_Size,
                        safebox.password AS Safebox_Password,
                        player_index.empire
                        FROM account.account
                        LEFT JOIN player.player_index
                        ON player_index.id = account.id
                        LEFT JOIN player.safebox
                        ON account.id = safebox.account_id
                        WHERE account.id = ?
                        LIMIT 1";
        $Parametres_Appel_Compte = $this->objConnection->prepare($Appel_Compte);
        $Parametres_Appel_Compte->execute(array(
            $this->objAccount->getId()));
        $Parametres_Appel_Compte->setFetchMode(\PDO::FETCH_OBJ);
        $Resultat_Appel_Compte = $Parametres_Appel_Compte->fetch();
        ?>

        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Mon compte</h3>
            </div>

            <div class="box-body no-padding">

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">

                        <li class="active"><a href="#Onglet_InformationGeneral" data-toggle="tab" aria-expanded="true">Générales</a></li>
                        <li class=""><a href="#Onglet_Entrepot" data-toggle="tab" aria-expanded="false">Entrepôt</a></li>
                        <li class=""><a href="#Onglet_Entrepot_IS" data-toggle="tab" aria-expanded="false">Entrepot Item-Shop</a></li>
                        <li class=""><a href="#Historiques_Paiements" data-toggle="tab" aria-expanded="false">Paiements</a></li>
                        <li class=""><a href="#Historiques_Achats" data-toggle="tab" aria-expanded="false">Achats</a></li>
                    </ul>
                    <div class="tab-content">

                        <?php include '../../../pages/MonCompte/includes/OngletInformationsGeneral.php'; ?>
                        <?php include '../../../pages/MonCompte/includes/OngletEntrepot.php'; ?>
                        <?php include '../../../pages/MonCompte/includes/OngletEntrepotIS.php'; ?>
                        <?php include '../../../pages/MonCompte/includes/OngletHistoriquesPaiements.php'; ?>
                        <?php include '../../../pages/MonCompte/includes/OngletHistoriquesAchats.php'; ?>

                        <div class="clearfix"></div>
                    </div>
                </div>

                <div class="clear"></div>
            </div>
        </div>
        <?php
    }

}

$class = new MonCompte();
$class->run();

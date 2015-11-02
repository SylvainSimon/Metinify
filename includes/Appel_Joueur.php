<?php

namespace Includes;

require __DIR__ . '../../core/initialize.php';

class Appel_Joueur extends \PageHelper {

    public function run() {
        ?>
        <?php @include_once '../pages/Fonctions_Utiles.php'; ?>
        <?php
        if (empty($_SESSION['Utilisateur'])) {

            include 'Onglet_Non_Connecter.php';
            exit();
        }
        include '../pages/Tableaux_Arrays.php';

        $Id_Personnage = $_GET['id'];

        /* ------------------------------ Vérification connecte ---------------------------------------------- */
        $Verification_Connecte = "SELECT id FROM player.player
                          WHERE player.id = ?
                          AND player.last_play >= (NOW() - INTERVAL 30 MINUTE)
                          LIMIT 1";
        $Parametres_Verification_Connecte = $this->objConnection->prepare($Verification_Connecte);
        /* -------------------------------------------------------------------------------------------------- */

        /* --------------------------- Appel Joueur Page ---------------------------- */
        $Appel_Joueur_Page = "SELECT player.id AS player_id,
                             player.ip AS player_ip,
                             player.name,
                             player.exp,
                             player.level,
                             player.job,
                             player.playtime,
                             player.last_play,
                             player.gold,
                             player.alignment,
                             player.map_index,
                             player.exit_map_index,
                             player.horse_stamina,
                             player.horse_hp,
                             player.horse_level,
                             player.horse_riding,
                             player.horse_hp_droptime,
                             player.horse_skill_point,
                             player.stat_point,
                             player.st AS player_STR,
                             player.ht AS player_VIT,
                             player.dx AS player_DEX,
                             player.iq AS player_INT,
                             account.login AS account_login,
                             account.id AS account_id,
                             account.status AS account_status,
                             player_index.empire,
                             guild.name AS guild_name
                        
                        FROM player.player
                        LEFT JOIN account.account
                        ON account.id = player.account_id
                        LEFT JOIN player.player_index
                        ON account.id = player_index.id
                        LEFT JOIN player.guild_member
                        ON player.id = guild_member.pid
                        LEFT JOIN player.guild
                        ON guild_member.guild_id = guild.id
                        WHERE player.id = '" . $Id_Personnage . "'
                        LIMIT 1";

        $Parametres_Appel_Joueur_Page = $this->objConnection->query($Appel_Joueur_Page);
        $Parametres_Appel_Joueur_Page->setFetchMode(\PDO::FETCH_OBJ);
        /* --------------------------------------------------------------------------- */

        $Donnees_Appel_Joueurs_Page = $Parametres_Appel_Joueur_Page->fetch();

        if ($_SESSION['ID'] != $Donnees_Appel_Joueurs_Page->account_id) {

            include 'Onglet_Mauvais_Compte.php';
            exit();
        }
        ?>

        <link rel="stylesheet" href="../css/demos.css">

        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Mon personnage</h3>
            </div>

            <div class="box-body no-padding">

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">

                        <li class="active"><a href="#Onglet_InformationGeneral" data-toggle="tab" aria-expanded="true">Générales</a></li>
                        <li class=""><a href="#Onglet_Equipement" data-toggle="tab" aria-expanded="false">Équipement</a></li>
                        <li class=""><a href="#Onglet_Inventaire" data-toggle="tab" aria-expanded="false">Inventaire</a></li>
                        <li class=""><a href="#Onglet_Equitation" data-toggle="tab" aria-expanded="false">Cheval</a></li>
                        <li class=""><a href="#Onglet_Amis" data-toggle="tab" aria-expanded="false">Amis</a></li>
                    </ul>
                    <div class="tab-content">

                        <?php include 'Appel_Joueurs/Onglet_Informations_General.php'; ?>
                        <?php include 'Appel_Joueurs/Onglet_Equipement.php'; ?>
                        <?php include 'Appel_Joueurs/Onglet_Inventaire.php'; ?>
                        <?php include 'Appel_Joueurs/Onglet_Equitation.php'; ?>
                        <?php include 'Appel_Joueurs/Onglet_Amis.php'; ?>

                        <div class="clearfix"></div>
                    </div>
                </div>

            </div>
        </div>
        <?php
    }

}

$class = new Appel_Joueur();
$class->run();

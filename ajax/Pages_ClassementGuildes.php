<?php
include '../configPDO.php';

$Numero_De_Page = $_GET['page'];
$Limite_Basse = ($Numero_De_Page * 10);

/* ------------------------ Classement Joueur Page ------------------------ */
$Classement_Guilde_Page = "SELECT guild.name,
                              guild.level,
                              guild.exp,
                              guild.win,
                              guild.loss,
                              guild.draw,
                              player.name AS master_name,
                              player_index.empire AS guild_empire
                                     
                       FROM player.guild
                       LEFT JOIN player.player
                       ON guild.master = player.id
                       LEFT JOIN account.account
                       ON account.id = player.account_id
                       LEFT JOIN player.player_index
                       ON player_index.id = account.id
                       WHERE account.status != 'BLOCK'
                       AND player.name NOT IN(SELECT mName FROM common.gmlist)

                       ORDER BY guild.level DESC, guild.win DESC, guild.draw DESC, guild.loss ASC
                       LIMIT " . $Limite_Basse . ", 10";

$Parametres_Classement_Guilde_Page = $Connexion->query($Classement_Guilde_Page);
$Parametres_Classement_Guilde_Page->setFetchMode(PDO::FETCH_OBJ);
/* -------------------------------------------------------------------------- */

/* ------------------------------ Comptage guilde ------------------------------- */
$Comptage_Joueurs = "SELECT id FROM player.guild";
$Parametres_Comptage_Joueurs = $Connexion->query($Comptage_Joueurs);
$Nombre_De_Guildes = $Parametres_Comptage_Joueurs->rowCount();
/* --------------------------------------------------------------------------------- */

$Nombre_De_Page = abs(($Nombre_De_Guildes / 20) - 1);
$i = $Limite_Basse + 1;
?>

<table class="table table-condensed table-hover" style="border-collapse: collapse; margin-bottom: 0px;"> 
    <thead>
        <tr>

            <th style="width: 15px;" align="center"></th>
            <th style="width: 150px;">Nom</th>
            <th style="width: 25px;"></th>
            <th class="Align_center">Level</th>
            <th>Chef</th>
            <th class="hidden-md hidden-sm hidden-xs">Experience</th>
            <th style="width: 100px;">Score</th>
        </tr>
    </thead>

    <tbody id="pagedeclassement">

        <?php while ($Donnees_Classement_Guildes = $Parametres_Classement_Guilde_Page->fetch()) { ?>

            <tr>
                <td align="center">
                    <?php if ($i == 1) {
                        ?><i class="material-icons md-icon-star" style="color:#F3EC12;"></i>
                        <?php
                    } else if ($i == 2) {
                        ?><i class="material-icons md-icon-star text-gray"></i>
                        <?php
                    } else if ($i == 3) {
                        ?><i class="material-icons md-icon-star" style="color:#813838;"></i>
                        <?php
                    } else if ($i == 4) {
                        ?><i class="material-icons md-icon-bookmark" style="color:#F3EC12; opacity: 0.5"></i>
                        <?php
                    } else if ($i == 5) {
                        ?><i class="material-icons md-icon-bookmark text-gray" style="opacity: 0.5"></i>
                        <?php
                    } else if ($i == 6) {
                        ?><i class="material-icons md-icon-bookmark" style="color:#813838; opacity: 0.5"></i>
                        <?php
                    } else {
                        echo $i;
                    }
                    ?>
                </td>

                <td>
                    <?php echo $Donnees_Classement_Guildes->name; ?>
                </td>

                <td>
                    <?php if ($Donnees_Classement_Guildes->guild_empire == 1) { ?>
                        <i class="text-red material-icons md-icon-map md-20"></i>
                    <?php } else if ($Donnees_Classement_Guildes->guild_empire == 2) { ?>
                        <i class="text-yellow material-icons md-icon-map md-20"></i>
                    <?php } else if ($Donnees_Classement_Guildes->guild_empire == 3) { ?>
                        <i class="text-blue material-icons md-icon-map md-20"></i>
                    <?php } ?>
                </td>

                <td class="Align_center">
                    <?php echo $Donnees_Classement_Guildes->level; ?>
                </td>

                <td>
                    <?php echo $Donnees_Classement_Guildes->master_name; ?>
                </td>

                <td  class="hidden-md hidden-sm hidden-xs">
                    <?php echo $Donnees_Classement_Guildes->exp; ?>
                </td>
                <td>
                    <span class="text-green"><?php echo $Donnees_Classement_Guildes->win; ?></span>
                    /
                    <span class="text-red"><?php echo $Donnees_Classement_Guildes->loss; ?></span>
                    /
                    <?php echo $Donnees_Classement_Guildes->draw; ?>
                </td>

            </tr>
            <?php $i++; ?>

        <?php } ?>
    </tbody>

</table>
<div class="row" style="padding: 10px;">

    <div class="col-xs-6">
        <div class="pull-left">
            <?php if ($Numero_De_Page >= 1) { ?>
                <a href="javascript:void(0)" onclick="Ajax_Classement('ajax/Pages_ClassementGuildes.php?page=<?php echo ($Numero_De_Page - 1); ?>')">Page précédente</a>
            <?php } ?>
        </div>
    </div>

    <div class="col-xs-6">
        <div class="pull-right">
            <?php if ($Numero_De_Page <= $Nombre_De_Page) {
                ?>
                <a href="javascript:void(0)" onclick="Ajax_Classement('ajax/Pages_ClassementGuildes.php?page=<?php echo ($Numero_De_Page + 1); ?>')">Page suivante</a>
            <?php } ?>
        </div>
    </div>

</div>
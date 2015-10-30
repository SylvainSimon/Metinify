<?php
include '../configPDO.php';

$Numero_De_Page = $_GET['page'];
$Limite_Basse = ($Numero_De_Page * 20);

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
                       LIMIT " . $Limite_Basse . ",20";

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

<div class="Suivante_Precendent">
    <hr class="Hr_Haut"/>
    <div class="Position_Bouton_Precedent Bold">
        <?php if ($Numero_De_Page >= 1) { ?>
            <a href="javascript:void(0)" onclick="Ajax_Classement('ajax/Pages_ClassementGuildes.php?page=<?php echo ($Numero_De_Page - 1); ?>')"><= Précédente</a>
        <?php } else { ?>
            <= Précédente
        <?php } ?>
    </div>

    <div class="Position_Bouton_Suivant Bold">
        <?php if ($Numero_De_Page <= $Nombre_De_Page) {
            ?>
            <a href="javascript:void(0)" onclick="Ajax_Classement('ajax/Pages_ClassementGuildes.php?page=<?php echo ($Numero_De_Page + 1); ?>')">Suivante =></a>
        <?php } else { ?>
            Suivante =>
        <?php } ?>
    </div>
</div>
<hr class="Hr_Bas">
<table class="Table_Classement_Guilde No_Select"> 
    <thead>
        <tr>
            <th align="center" class="Colonne_Numero_Classement">N°</th>
            <th style="text-indent: 5px;" class="Align_Left" >Nom</th>
            <th class="Align_Left">Level</th>
            <th class="Align_Left">Chef</th>
            <th class="Align_Left">Experience</th>
            <th class="Align_center">Victoires</th>
            <th class="Align_center">Defaites</th>
            <th class="Align_center">Match nuls</th>
            <th align="center">Empire</th>

        </tr>

    </thead>
    <tbody id="pagedeclassement">

        <?php while ($Donnees_Classement_Guildes = $Parametres_Classement_Guilde_Page->fetch()) { ?>

            <tr onmouseover="this.style.backgroundColor='#666666';" onmouseout="this.style.backgroundColor='transparent';">
                <td align="center" class="Colonne_Numero_Classement">
                    <?php if ($i == 1) { ?>
                        <img src="images/rang/or.png"/>
                    <?php } else if ($i == 2) { ?>
                        <img src="images/rang/argent.png"/>
                    <?php } else if ($i == 3) { ?>
                        <img src="images/rang/bronze.png"/>
                    <?php } else if ($i == 4) { ?>
                        <img src="images/rang/Medaille_Or.png"/>
                    <?php } else if ($i == 5) { ?>
                        <img src="images/rang/Medaille_Argent.png"/>
                    <?php } else if ($i == 6) { ?>
                        <img src="images/rang/Medaille_Bronze.png"/>
                    <?php } else { ?>
                        <?php echo $i; ?>
                    <?php } ?>
                </td>

                <td style="text-indent: 5px;">
                    <?php echo $Donnees_Classement_Guildes->name; ?>
                </td>
                <td class="Align_Left">
                    <?php echo $Donnees_Classement_Guildes->level; ?>
                </td>
                <td>
                    <?php echo $Donnees_Classement_Guildes->master_name; ?>
                </td>
                <td>
                    <?php echo $Donnees_Classement_Guildes->exp; ?>
                </td>
                <td class="Align_center">
                    <?php echo $Donnees_Classement_Guildes->win; ?>
                </td>

                <td class="Align_center">
                    <?php echo $Donnees_Classement_Guildes->loss; ?>
                </td>
                <td class="Align_center">
                    <?php echo $Donnees_Classement_Guildes->draw; ?>
                </td>
                <td align="center">
                    <?php if ($Donnees_Classement_Guildes->guild_empire == 1) { ?>
                        <img class="Dimension_Image_Classement Deplacement_Drapeau" src="images/empire/red.jpg"/> 
                    <?php } else if ($Donnees_Classement_Guildes->guild_empire == 2) { ?>
                        <img class="Dimension_Image_Classement Deplacement_Drapeau" src="images/empire/yellow.jpg"/> 
                    <?php } else if ($Donnees_Classement_Guildes->guild_empire == 3) { ?>
                        <img class="Dimension_Image_Classement Deplacement_Drapeau" src="images/empire/blue.jpg"/>
                    <?php } ?>
                </td>

            </tr>
            <?php $i++; ?>

        <?php } ?>
    </tbody>

</table>

<hr class="Hr_Haut"/>
<div class="Position_SuivantPrecedent_BasClassement">
    <div class="Position_Bouton_Precedent Bold">
        <?php if ($Numero_De_Page >= 1) { ?>
            <a href="javascript:void(0)" onclick="Ajax_Classement('ajax/Pages_ClassementGuildes.php?page=<?php echo ($Numero_De_Page - 1); ?>')"><= Précédente</a>
        <?php } else { ?>
            <= Précédente
        <?php } ?>
    </div>

    <div class="Position_Bouton_Suivant Bold">
        <?php if ($Numero_De_Page <= $Nombre_De_Page) {
            ?>
            <a href="javascript:void(0)" onclick="Ajax_Classement('ajax/Pages_ClassementGuildes.php?page=<?php echo ($Numero_De_Page + 1); ?>')">Suivante =></a>
        <?php } else { ?>
            Suivante =>
        <?php } ?>
    </div>
</div>
<hr class="Hr_Bas">

<?php
include '../configPDO.php';

$Index_Recherche = 0;

$Guilde_A_Chercher = $_POST['recherche'];

/* ------------------------ Classement Joueur ---------------------------- */
$Classement_Guilde = "SELECT guild.name,
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

                       ORDER BY guild.level DESC, guild.win DESC, guild.draw DESC, guild.loss ASC";
$Parametres_Classement_Guilde = $Connexion->query($Classement_Guilde);
$Parametres_Classement_Guilde->setFetchMode(PDO::FETCH_OBJ);
$Nombre_De_Resultat = $Parametres_Classement_Guilde->rowCount();
/* -------------------------------------------------------------------------- */

while ($Donnees_Classement_Joueurs = $Parametres_Classement_Guilde->fetch()) {

    $Index_Recherche++;

    if ($Donnees_Classement_Joueurs->name == $Guilde_A_Chercher) {

        break;
    }
}
?>
<?php if ($Nombre_De_Resultat == $Index_Recherche) { ?>

    <tr><td colspan="9"> Aucun résultats</td></tr>

<?php } else { ?>

    <?php
    $Index_Recherche_Decale = ($Index_Recherche - 6);

    /* ------------------------------ Vérification connecte ---------------------------------------------- */
    $Verification_Connecte = "SELECT id FROM player.player
                          WHERE player.id = ?
                          AND player.last_play >= (NOW() - INTERVAL 30 MINUTE)
                          LIMIT 1";
    $Parametres_Verification_Connecte = $Connexion->prepare($Verification_Connecte);
    /* -------------------------------------------------------------------------------------------------- */

    /* ------------------------ Classement Joueur Recherche -------------------------------- */
    $Classement_Guilde_Rechercher = "SELECT guild.name,
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
                                        LIMIT " . $Index_Recherche_Decale . ", 20";

    $Parametres_Classement_Guilde_Rechercher = $Connexion->query($Classement_Guilde_Rechercher);
    $Parametres_Classement_Guilde_Rechercher->setFetchMode(PDO::FETCH_OBJ);
    /* ------------------------------------------------------------------------------------------- */
    ?>

    <?php while ($Donnees_Classement_Guildes_Recherche = $Parametres_Classement_Guilde_Rechercher->fetch()) { ?> 

        <?php if (htmlentities($Donnees_Classement_Guildes_Recherche->name) == $Guilde_A_Chercher) { ?>
            <tr id="Ligne_Joueur_Trouve">

            <script type="text/javascript">                               
                document.getElementById('Ligne_Joueur_Trouve').style.backgroundColor='#666666';
            </script>
        <?php } else { ?>
            <tr onmouseover="this.style.backgroundColor='#666666';" onmouseout="this.style.backgroundColor='transparent';">
            <?php } ?>
            <td align="center" class="Colonne_Numero_Classement">
                <?php echo ($Index_Recherche - 5); ?>
            </td>
            <td style="text-indent: 5px;">
                <?php echo $Donnees_Classement_Guildes_Recherche->name; ?>
            </td>
            <td class="Align_Left">
                <?php echo $Donnees_Classement_Guildes_Recherche->level; ?>
            </td>
            <td>
                <?php echo $Donnees_Classement_Guildes_Recherche->master_name; ?>
            </td>
            <td>
                <?php echo $Donnees_Classement_Guildes_Recherche->exp; ?>
            </td>
            <td class="Align_center">
                <?php echo $Donnees_Classement_Guildes_Recherche->win; ?>
            </td>

            <td class="Align_center">
                <?php echo $Donnees_Classement_Guildes_Recherche->loss; ?>
            </td>
            <td class="Align_center">
                <?php echo $Donnees_Classement_Guildes_Recherche->draw; ?>
            </td>
            <td align="center">
                <?php if ($Donnees_Classement_Guildes_Recherche->guild_empire == 1) { ?>
                    <img class="Dimension_Image_Classement Deplacement_Drapeau" src="images/empire/red.jpg"/> 
                <?php } else if ($Donnees_Classement_Guildes_Recherche->guild_empire == 2) { ?>
                    <img class="Dimension_Image_Classement Deplacement_Drapeau" src="images/empire/yellow.jpg"/> 
                <?php } else if ($Donnees_Classement_Guildes_Recherche->guild_empire == 3) { ?>
                    <img class="Dimension_Image_Classement Deplacement_Drapeau" src="images/empire/blue.jpg"/>
                <?php } ?>
            </td>
        </tr>

        <?php $Index_Recherche++; ?>

        <?php
    }
    ?>
<?php } ?>
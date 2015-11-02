<?php

namespace Ajax;

require __DIR__ . '../../core/initialize.php';

class Pages_ClassementGuildes_Recherche extends \PageHelper {

    public function run() {

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
        $Parametres_Classement_Guilde = $this->objConnection->query($Classement_Guilde);
        $Parametres_Classement_Guilde->setFetchMode(\PDO::FETCH_OBJ);
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
            $Index_Recherche_Decale = ($Index_Recherche - 4);

            /* ------------------------------ Vérification connecte ---------------------------------------------- */
            $Verification_Connecte = "SELECT id FROM player.player
                          WHERE player.id = ?
                          AND player.last_play >= (NOW() - INTERVAL 30 MINUTE)
                          LIMIT 1";
            $Parametres_Verification_Connecte = $this->objConnection->prepare($Verification_Connecte);
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
                                        LIMIT " . $Index_Recherche_Decale . ", 10";

            $Parametres_Classement_Guilde_Rechercher = $this->objConnection->query($Classement_Guilde_Rechercher);
            $Parametres_Classement_Guilde_Rechercher->setFetchMode(\PDO::FETCH_OBJ);
            /* ------------------------------------------------------------------------------------------- */
            ?>

            <?php while ($Donnees_Classement_Guildes_Recherche = $Parametres_Classement_Guilde_Rechercher->fetch()) { ?> 

                <?php if (htmlentities($Donnees_Classement_Guildes_Recherche->name) == $Guilde_A_Chercher) { ?>
                    <tr id="Ligne_Joueur_Trouve">
                    <script type="text/javascript">
                        document.getElementById('Ligne_Joueur_Trouve').style.backgroundColor = '#666666';
                    </script>
                <?php } else { ?>
                    <tr>
                    <?php } ?>
                    <td align="center">
                        <?php echo ($Index_Recherche - 5); ?>
                    </td>
                    <td>
                        <?php echo $Donnees_Classement_Guildes_Recherche->name; ?>
                    </td>

                    <td>
                        <?php if ($Donnees_Classement_Guildes_Recherche->guild_empire == 1) { ?>
                            <i class="text-red material-icons md-icon-map md-20"></i>
                        <?php } else if ($Donnees_Classement_Guildes_Recherche->guild_empire == 2) { ?>
                            <i class="text-yellow material-icons md-icon-map md-20"></i>
                        <?php } else if ($Donnees_Classement_Guildes_Recherche->guild_empire == 3) { ?>
                            <i class="text-blue material-icons md-icon-map md-20"></i>
                        <?php } ?>
                    </td>

                    <td class="Align_center">
                        <?php echo $Donnees_Classement_Guildes_Recherche->level; ?>
                    </td>
                    <td>
                        <?php echo $Donnees_Classement_Guildes_Recherche->master_name; ?>
                    </td>
                    <td  class="hidden-md hidden-sm hidden-xs">
                        <?php echo $Donnees_Classement_Guildes_Recherche->exp; ?>
                    </td>
                    <td>
                        <span class="text-green"><?php echo $Donnees_Classement_Guildes_Recherche->win; ?></span>
                        /
                        <span class="text-red"><?php echo $Donnees_Classement_Guildes_Recherche->loss; ?></span>
                        /
                        <?php echo $Donnees_Classement_Guildes_Recherche->draw; ?>
                    </td>
                </tr>

                <?php $Index_Recherche++; ?>

                <?php
            }
        }
    }

}

$class = new Pages_ClassementGuildes_Recherche();
$class->run();

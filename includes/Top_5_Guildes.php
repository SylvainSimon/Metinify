<div class="box box-default flat">

    <div class="box-header">
        <h3 class="box-title">Top guilde</h3>
    </div>

    <div class="box-body">

        <table class="table table-bordered">

            <tr>
                <th class="Align_Left">Place</th>
                <th class="Align_Left">Nom</th>
                <th class="Align_Right">Lvl.</th>
            </tr>

            <?php
            $i = 0;

            /* ------------------------------- Top 5 Joueur ----------------------------- */
            $Top_5_Guildes = "SELECT guild.name AS guild_Name,
                                     guild.level AS guild_Level
                                     
                                     FROM player.guild
                                     LEFT JOIN player.player
                                     ON guild.master = player.id
                                     LEFT JOIN account.account
                                     ON account.id = player.account_id
                                     WHERE account.status != 'BLOCK'
                                     AND player.name NOT IN(SELECT mName FROM common.gmlist)

                                     ORDER BY guild.level DESC, guild.win DESC
                                     LIMIT 0,6";

            $Parametres_Top_5_Guildes = $Connexion->query($Top_5_Guildes);
            $Parametres_Top_5_Guildes->setFetchMode(PDO::FETCH_OBJ);
            /* -------------------------------------------------------------------------- */
            ?>

            <?php while ($Donnees_Top_5_Guildes = $Parametres_Top_5_Guildes->fetch()) { ?>

                <?php $i++; ?>

                <tr class="Pointer Ligne_Classement" onmouseover="this.style.backgroundColor = '#666666';" onmouseout="this.style.backgroundColor = 'transparent';">
                    <td class="Align_Left">
                        <?php if ($i == 1) {
                            ?><img src="images/rang/or.png"/>
                            <?php
                        } else if ($i == 2) {
                            ?><img src="images/rang/argent.png"/>
                            <?php
                        } else if ($i == 3) {
                            ?><img src="images/rang/bronze.png"/>
                            <?php
                        } else if ($i == 4) {
                            ?><img src="images/rang/Medaille_Or.png"/>
                            <?php
                        } else if ($i == 5) {
                            ?><img src="images/rang/Medaille_Argent.png"/>
                            <?php
                        } else if ($i == 6) {
                            ?><img src="images/rang/Medaille_Bronze.png"/>
                            <?php
                        } else {

                            echo $i . " eme";
                        }
                        ?>
                    </td>
                    <td class="Align_Left">
                        <?php echo $Donnees_Top_5_Guildes->guild_Name; ?>
                    </td>
                    <td class="Align_Right">
                        <?php echo $Donnees_Top_5_Guildes->guild_Level; ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
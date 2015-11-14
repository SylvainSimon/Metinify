<div class="box box-default flat">

    <div class="box-header">
        <h3 class="box-title">Top guilde</h3>
    </div>

    <div class="box-body no-padding">

        <table class="table table-hover table-condensed table-responsive" style="border-collapse: collapse;">

            <thead>
                <tr>
                    <th class="">Nom</th>
                    <th style="text-align: right;">Level</th>
                </tr>
            </thead>

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

            $Parametres_Top_5_Guildes = $this->objConnection->query($Top_5_Guildes);
            $Parametres_Top_5_Guildes->setFetchMode(\PDO::FETCH_OBJ);
            /* -------------------------------------------------------------------------- */
            ?>

            <?php while ($Donnees_Top_5_Guildes = $Parametres_Top_5_Guildes->fetch()) { ?>

                <?php $i++; ?>

                <tr>
                    <td style="line-height: 10px;">
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
                            echo $i . " eme";
                        }
                        ?>
                        <span style="vertical-align: text-top;"><?php echo $Donnees_Top_5_Guildes->guild_Name; ?></span>
                    </td>
                    <td style="text-align: right;">
                        <?php echo $Donnees_Top_5_Guildes->guild_Level; ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
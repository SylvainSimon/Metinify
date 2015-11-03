<div class="box box-default flat">

    <div class="box-header">
        <h3 class="box-title">Classement PVP</h3>
    </div>

    <div class="box-body no-padding">

        <table class="table table-hover table-condensed table-responsive" style="border-collapse: collapse;">

            <thead>
                <tr>
                    <th>Pseudo</th>
                    <th class="Align_Right">Score</th>
                </tr>
            </thead>

            <?php
            $i = 0;

            /* ------------------------------- Top 5 Joueur ----------------------------- */
            $Top_5_Joueurs = "SELECT name,level,exp,victimes_pvp
                                         
                                     FROM player.player
                                     LEFT JOIN account.account
                                     ON account.id = player.account_id
                                         
                                     WHERE account.status='OK'
                                     AND ( not (name like '[GM]%' ))
                                     AND ( not (name like '[TGM]%' ))
                                     AND ( not (name like '[Admin]%' ))
                                     AND ( not (name like '[TM]%' ))
                                     AND ( not (name like '[SGM]%' ))
                                     AND player.name NOT IN(SELECT mName FROM common.gmlist)
									 ORDER BY victimes_pvp DESC, level DESC, exp DESC
                                     LIMIT 0,6";

            $Parametres_Top_5_Joueurs = $this->objConnection->query($Top_5_Joueurs);
            $Parametres_Top_5_Joueurs->setFetchMode(\PDO::FETCH_OBJ);
            /* -------------------------------------------------------------------------- */
            ?>

            <?php while ($Donnees_Top_5_Joueurs = $Parametres_Top_5_Joueurs->fetch()) { ?>

                <?php $i++; ?>

                <tr class="Pointer Ligne_Classement" onmouseover="this.style.backgroundColor = '#666666';" onmouseout="this.style.backgroundColor = 'transparent';">
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
                        <span style="vertical-align: text-top;"><?php echo $Donnees_Top_5_Joueurs->name; ?></span>
                    </td>
                    <td class="Align_Right">
                        <?php echo $Donnees_Top_5_Joueurs->victimes_pvp; ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
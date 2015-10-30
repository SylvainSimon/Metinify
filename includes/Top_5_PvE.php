<div class="box box-default flat">
    
    <div class="box-header">
        <h3 class="box-title">Classement joueurs pve</h3>
    </div>
    
    <div class="box-body">
        
        <table class="table table-bordered">
            
            <tr>
                <th class="Align_Left">Place</th>
                <th class="Align_Left">Pseudo</th>
                <th class="Align_Right">Score</th>
            </tr>
            <?php
            $i = 0;

            /* ------------------------------- Top 5 Joueur ----------------------------- */
            $Top_5_Joueurs = "SELECT name,level,exp,score_pve
                                         
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
									 ORDER BY score_pve DESC, level DESC, exp DESC
                                     LIMIT 0,6";

            $Parametres_Top_5_Joueurs = $Connexion->query($Top_5_Joueurs);
            $Parametres_Top_5_Joueurs->setFetchMode(PDO::FETCH_OBJ);
            /* -------------------------------------------------------------------------- */
            ?>

            <?php while ($Donnees_Top_5_Joueurs = $Parametres_Top_5_Joueurs->fetch()) { ?>

                <?php $i++; ?>

                <tr class="Pointer Ligne_Classement" onmouseover="this.style.backgroundColor='#666666';" onmouseout="this.style.backgroundColor='transparent';">
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
                        <?php echo $Donnees_Top_5_Joueurs->name; ?>
                    </td>
                    <td class="Align_Right">
                        <?php echo $Donnees_Top_5_Joueurs->score_pve; ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
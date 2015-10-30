<div class="Menu_Sidebar">
    <div class="Menu_Sidebar_Haut Pointer No_Select" onclick="Slider_Sidebar_Gauche_1();">Classement joueurs pvp</div>
    <div class="Menu_Sidebar_Milieu" id="Div_Sidebar_Gauche_1">
        <table class="Table_Top_5_Joueur">

            <tr><td colspan="3"><div class="barre"></div></td></tr>

            <tr>
                <th class="Align_Left">Place</th>
                <th class="Align_Left">Pseudo</th>
                <th class="Align_Right">Score</th>
            </tr>

            <tr><td colspan="3"><div class="barre"></div></td></tr>

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
                        <?php echo $Donnees_Top_5_Joueurs->victimes_pvp; ?>
                    </td>
                </tr>
                <?php
            }
            ?>
            <tr><td colspan="3"><div class="barre"></div></td></tr>
        </table>
    </div>
</div>
<div class="tab-pane" id="Onglet_Amis">

    <?php
    /* ----------------------------------------------- Liste Amis -------------------------------------------- */
    $Liste_Amis = "SELECT messenger_list.companion,
                                  player_index.empire,
                                  player.level,
                                  player.id AS id_amis,
                                  account.status,
                                  player.exp,
                                  player.skill_group,
                                  player.job,
                                  player.last_play,
                                  player.playtime
                          FROM player.player
                          LEFT JOIN player.messenger_list
                          ON player.name = messenger_list.companion
                          LEFT JOIN account.account
                          ON account.id = player.account_id
                          LEFT JOIN player.player_index
                          ON player_index.id = account.id
                          WHERE messenger_list.account = '" . $Donnees_Appel_Joueurs_Page->name . "'
                          ORDER by account.status DESC, messenger_list.companion ASC";

    $Parametres_Liste_Amis = $Connexion->query($Liste_Amis);
    $Parametres_Liste_Amis->setFetchMode(PDO::FETCH_OBJ);
    $Nombre_De_Resultat_Liste_Amis = $Parametres_Liste_Amis->rowCount();
    /* ------------------------------------------------------------------------------------------------------- */
    ?>

    <table id="Tableau_Recapitulatif_Amis">
        <tr>
            <th colspan="2">Récapitulatif :</th>
        </tr>
        <tr>
            <td title="Nombres de paiements que vous avez effectué" class="Colonne_Gauche">Nombre d'amis :</td>
            <td><?= $Nombre_De_Resultat_Liste_Amis; ?></td>
        </tr>
    </table>

    <div class="Zone_Tableau_Amis">
        <table id="Tableau_Amis" class="width100">

            <thead>
                <tr>

                    <th>Nom de l'ami(e)</th>
                    <th width="50">Level</th>
                    <th>Experience</th>
                    <th width="55">Race</th>
                    <th width="90">Classe</th>
                    <th width="130">Temps de jeu</th>
                    <th width="30">Compte</th>
                    <th width="40">Empire</th>
                    <th width="30">Status</th>

                </tr>
            </thead>

            <tbody>

                <?php if ($Nombre_De_Resultat_Liste_Amis != 0) { ?>
                    <?php while ($Resultat_Amis = $Parametres_Liste_Amis->fetch()) { ?>

                        <?php $Formatage_Experience = number_format($Resultat_Amis->exp, 0, '.', ' '); ?>
                        <?php
                        $lHeure = floor($Resultat_Amis->playtime / 60);
                        $lesMinutes = (($Resultat_Amis->playtime) % 60);
                        $lJours = floor($lHeure / 24);

                        $lHeure = ($lHeure - ($lJours * 24));
                        ?>
                        <tr onmouseover="this.style.backgroundColor='#333333';" onmouseout="this.style.backgroundColor='transparent';">
                            <td><?php echo $Resultat_Amis->companion; ?></td>
                            <td class="Align_center"><?php echo $Resultat_Amis->level; ?></td>

                            <td><?php echo $Formatage_Experience; ?></td>
                            <td>
                                <?php if ($Resultat_Amis->job == "0") { ?> 
                                    <img class="cadrephotoclassement" src="../images/races/0_mini.png" width="50"/>
                                <?php } else if ($Resultat_Amis->job == "1") { ?> 
                                    <img class="cadrephotoclassement" src="../images/races/1_mini.png" width="50"/>
                                <?php } else if ($Resultat_Amis->job == "2") { ?> 
                                    <img class="cadrephotoclassement" src="../images/races/2_mini.png" width="50"/>
                                <?php } else if ($Resultat_Amis->job == "3") { ?> 
                                    <img class="cadrephotoclassement" src="../images/races/3_mini.png" width="50"/>
                                <?php } else if ($Resultat_Amis->job == "4") { ?> 
                                    <img class="cadrephotoclassement" src="../images/races/4_mini.png" width="50"/>
                                <?php } else if ($Resultat_Amis->job == "5") { ?> 
                                    <img class="cadrephotoclassement" src="../images/races/5_mini.png" width="50"/>
                                <?php } else if ($Resultat_Amis->job == "6") { ?> 
                                    <img class="cadrephotoclassement" src="../images/races/6_mini.png" width="50"/>
                                <?php } else if ($Resultat_Amis->job == "7") { ?> 
                                    <img class="cadrephotoclassement" src="../images/races/7_mini.png" width="50"/>
                                <?php } ?>
                            </td>
                            <td>

                                <?php if ($Resultat_Amis->job == 0) { ?>
                                    <?php if ($Resultat_Amis->skill_group == 1) { ?>
                                        Corp à Corp
                                    <?php } elseif ($Resultat_Amis->skill_group == 2) { ?>
                                        Mental
                                    <?php } else { ?>
                                        Non-définie
                                    <?php } ?>	
                                <?php } elseif ($Resultat_Amis->job == 1) { ?>
                                    <?php if ($Resultat_Amis->skill_group == 1) { ?>
                                        Assasin
                                    <?php } elseif ($Resultat_Amis->skill_group == 2) { ?>
                                        Archer
                                    <?php } else { ?>
                                        Non-définie
                                    <?php } ?>
                                <?php } elseif ($Resultat_Amis->job == 2) { ?>
                                    <?php if ($Resultat_Amis->skill_group == 1) { ?>
                                        Arme magique
                                    <?php } elseif ($Resultat_Amis->skill_group == 2) { ?>
                                        Magie Noir
                                    <?php } else { ?>
                                        Non-définie
                                    <?php } ?>
                                <?php } elseif ($Resultat_Amis->job == 3) { ?>
                                    <?php if ($Resultat_Amis->skill_group == 1) { ?>
                                        Dragon
                                    <?php } elseif ($Resultat_Amis->skill_group == 2) { ?>
                                        Soin
                                    <?php } else { ?>
                                        Non-définie
                                    <?php } ?>
                                <?php } elseif ($Resultat_Amis->job == 4) { ?>
                                    <?php if ($Resultat_Amis->skill_group == 1) { ?>
                                        CàC
                                    <?php } elseif ($Resultat_Amis->skill_group == 2) { ?>
                                        Mental
                                    <?php } else { ?>
                                        Non-définie
                                    <?php } ?>	
                                <?php } elseif ($Resultat_Amis->job == 5) { ?>
                                    <?php if ($Resultat_Amis->skill_group == 1) { ?>
                                        Assasin
                                    <?php } elseif ($Resultat_Amis->skill_group == 2) { ?>
                                        Archer
                                    <?php } else { ?>
                                        Non-définie
                                    <?php } ?>
                                <?php } elseif ($Resultat_Amis->job == 6) { ?>
                                    <?php if ($Resultat_Amis->skill_group == 1) { ?>
                                        AM
                                    <?php } elseif ($Resultat_Amis->skill_group == 2) { ?>
                                        MN
                                    <?php } else { ?>
                                        Non-définie
                                    <?php } ?>
                                <?php } elseif ($Resultat_Amis->job == 7) { ?>
                                    <?php if ($Resultat_Amis->skill_group == 1) { ?>
                                        Dragon
                                    <?php } elseif ($Resultat_Amis->skill_group == 2) { ?>
                                        Soin
                                    <?php } else { ?>
                                        Non-définie
                                    <?php } ?>
                                <?php } else { ?>
                                    Non-définie
                                <?php } ?>
                            </td>
                            <td><?php echo $lJours . " jours et " . $lHeure . "h" . $lesMinutes; ?></td>

                            <?php if ($Resultat_Amis->status == "OK") { ?>

                                <td align="center">
                                    <img src="../images/valid.gif" class="Image_ListeJoueur_Status" title="Compte actif"/>
                                </td>

                            <?php } else if ($Resultat_Amis->status == "BLOCK") { ?>
                                <td align="center">
                                    <img src="../images/invalid.gif" class="Image_ListeJoueur_Status"/>
                                </td>

                            <?php } else { ?>
                                <td align="center">
                                    <img src="../images/warning.gif" class="Image_ListeJoueur_Status" title="Etat inconnu" />
                                </td>
                            <?php } ?>
                            <td align="center">
                                <?php if ($Resultat_Amis->empire == 1) { ?>
                                    <img class="Image_Royaume" src="../images/empire/red.jpg" class="Image_ListeJoueur_Royaume" alt="Shinsoo" />
                                <?php } else if ($Resultat_Amis->empire == 2) { ?> 
                                    <img class="Image_Royaume" src="../images/empire/yellow.jpg" class="Image_ListeJoueur_Royaume" alt="Chunjo" />
                                <?php } else if ($Resultat_Amis->empire == 3) { ?> 
                                    <img class="Image_Royaume" src="../images/empire/blue.jpg" class="Image_ListeJoueur_Royaume" alt="Jinno" />
                                <?php } else { ?> 
                                    <img class="Image_Royaume" src="../images/empire/Royaume_Inconnu.jpg" class="Image_ListeJoueur_Royaume" alt="Inconnu" />
                                <?php } ?>
                            </td>
                            <?php
                            $Parametres_Verification_Connecte->execute(array(
                                $Resultat_Amis->id_amis));
                            $Parametres_Verification_Connecte->setFetchMode(PDO::FETCH_OBJ);
                            $Resultat_Verification_Connecte = $Parametres_Verification_Connecte->rowCount();
                            ?>
                            <?php if ($Resultat_Verification_Connecte != "1") { ?>
                                <td title="Hors-ligne" align="center">
                                    <img class="Ombre_Grise Deplacement_Status" src="../images/offline.gif" />
                                </td>
                            <?php } else { ?>
                                <td title="En ligne" align="center">
                                    <img class="Ombre_Grise Deplacement_Status" src="../images/online.gif" />

                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>

                <?php } else { ?>

                <td colspan="9">Aucuns amis.</td>
            <?php } ?>
            </tbody>

        </table>
    </div>
</div>
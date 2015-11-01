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

    <div class="row">
        <div class="col-lg-12">      
            <div class="Zone_Tableau_Amis">

                <table class="table table-condensed" style="border-collapse: collapse; margin-bottom: 0px;">

                    <thead>
                        <tr>

                            <th>Pseudo</th>
                            <th width="50">Level</th>
                            <th class="hidden-md hidden-sm hidden-xs">Expérience</th>
                            <th width="55">Race</th>
                            <th class="hidden-md hidden-sm hidden-xs">Classe</th>
                            <th width="130">Temps de jeu</th>
                            <th></th>
                            <th></th>
                            <th></th>
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
                                <tr>
                                    <td><?php echo $Resultat_Amis->companion; ?></td>
                                    <td class="Align_center"><?php echo $Resultat_Amis->level; ?></td>

                                    <td class="hidden-md hidden-sm hidden-xs"><?php echo $Formatage_Experience; ?></td>
                                    <td class="hidden-md hidden-sm hidden-xs">
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

                                    <td>
                                        <?php if ($Resultat_Amis->status == "OK") { ?>
                                            <i data-tooltip="Compte actif" data-tooltip-position="left" class="text-green material-icons md-icon-done md-20"></i>
                                        <?php } else if ($Resultat_Amis->status == "BLOCK") { ?>
                                            <i data-tooltip="Compte banni" data-tooltip-position="left" class="text-red material-icons md-icon-close md-20"></i>
                                        <?php } else { ?>
                                            <i data-tooltip="Etat inconnu" data-tooltip-position="left" class="material-icons md-icon-help md-20"></i>
                                        <?php } ?>
                                    </td>

                                    <td>
                                        <?php if ($Resultat_Amis->empire == 1) { ?>
                                            <i data-tooltip="Empire Shinsoo" data-tooltip-position="left" class="text-red material-icons md-icon-map md-20"></i>
                                        <?php } else if ($Resultat_Amis->empire == 2) { ?>
                                            <i data-tooltip="Empire Chunjo" data-tooltip-position="left" class="text-yellow material-icons md-icon-map md-20"></i>
                                        <?php } else if ($Resultat_Amis->empire == 3) { ?>
                                            <i data-tooltip="Empire Jinno" data-tooltip-position="left" class="text-blue material-icons md-icon-map md-20"></i>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php
                                        $Parametres_Verification_Connecte->execute(array(
                                            $Resultat_Amis->id_amis));
                                        $Parametres_Verification_Connecte->setFetchMode(PDO::FETCH_OBJ);
                                        $Resultat_Verification_Connecte = $Parametres_Verification_Connecte->rowCount();
                                        ?>
                                        <?php if ($Resultat_Verification_Connecte != "1") { ?>
                                            <span data-tooltip="Hors-ligne" data-tooltip-position="left">
                                                <i class="text-red material-icons md-icon-account-circle"></i>
                                            </span>
                                        <?php } else { ?>
                                            <span data-tooltip="En ligne" data-tooltip-position="left">
                                                <i class="text-green material-icons md-icon-account-circle"></i>
                                            </span>
                                        <?php } ?>

                                    </td>
                                </tr>
                            <?php } ?>

                        <?php } else { ?>

                        <td colspan="9">Aucuns amis.</td>
                    <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
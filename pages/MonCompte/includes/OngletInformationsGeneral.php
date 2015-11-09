<script type="text/javascript">var Clique_Code_Effacement = 0;</script>

<div class="tab-pane active" id="Onglet_InformationGeneral">

    <div class="row">
        <div class="col-lg-4">
            <table class="table table-condensed" style="border-collapse: collapse;">
                <tbody>
                    <tr>
                        <td style="border-top: 0px;">Compte :</td>
                        <td style="border-top: 0px;"><?php echo $Resultat_Appel_Compte->login; ?></td>
                    </tr>
                    <tr>
                        <td>Création :</td>
                        <?php
                        $Recomposition_Date = DateTimeHelper::stringToFormatedString($Resultat_Appel_Compte->create_time);
                        ?>
                        <td><span style="font-size: 12px; font-weight: bold;"><?php echo $Recomposition_Date; ?></span></td>
                    </tr>
                    <tr>
                        <td>Ip du compte :</td></td>
                        <?php if ($Resultat_Appel_Compte->ip_creation == '') { ?>
                            <td>Non-définie</td>

                        <?php } else { ?>
                            <td><?php echo $Resultat_Appel_Compte->ip_creation; ?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td>Empire :</td>
                        <td style="line-height: 10px;">
                            <?php if ($Resultat_Appel_Compte->empire == 1) { ?>
                                <i class="text-red material-icons md-icon-map md-20"></i>
                            <?php } else if ($Resultat_Appel_Compte->empire == 2) { ?>
                                <i class="text-yellow material-icons md-icon-map md-20"></i>
                            <?php } else if ($Resultat_Appel_Compte->empire == 3) { ?>
                                <i class="text-blue material-icons md-icon-map md-20"></i>
                            <?php } else { ?> 
                                <i class="material-icons md-icon-map md-20"></i>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>E-mail :</td>
                        <td>
                            <?php
                            $chaineCoupe = substr($Resultat_Appel_Compte->email, 0, 8);
                            $chaineCoupe = trim($chaineCoupe);

                            $caractere = (strlen($Resultat_Appel_Compte->email) - 8);
                            for ($i = 0; $i < $caractere; $i++) {
                                $i++;
                                $chaineCoupe.= "●";
                            }
                            ?>
                            <?php echo $chaineCoupe; ?>


                            <i data-tooltip="Modifier mon E-mail" data-tooltip-position="right" onclick="Ajax('pages/MonCompte/EmailChangeForm.php');" class="pull-right Pointer material-icons md-icon-edit text-yellow"></i>

                        </td>

                    </tr>
                    <tr>
                        <td>Mot de passe :</td>
                        <td>
                            ●●●●●●●●●●●●

                            <i data-tooltip="Modifier mon mot de passe" data-tooltip-position="right" onclick="Ajax('pages/MonCompte/PasswordChangeForm.php');" class="pull-right Pointer material-icons md-icon-edit text-yellow"></i>

                        </td>

                    </tr>

                    <?php if ($Resultat_Appel_Compte->social_id == "") { ?>
                        <tr>
                            <td>Code d'effacement :</td>
                            <td>
                                Aucun code définie
                                <i data-tooltip="Définir mon code d'effacement" data-tooltip-position="right" onclick="Ajax('pages/MonCompte/CodeEffacementCreateForm.php');" class="pull-right Pointer material-icons md-icon-add"></i>
                            </td>
                        </tr>
                    <?php } else { ?>
                        <tr>
                            <td>Code d'effacement :</td>
                            <td>
                                <span id="Code_Effacement">●●●●●●●</span>

                                <i style="margin-left: 5px;" data-tooltip="Modifier mon code" onclick="Ajax('pages/MonCompte/CodeEffacementChangeForm.php');" class="pull-right Pointer material-icons md-icon-edit text-yellow"></i>
                                <i data-tooltip="Voir le code" onclick="if (Clique_Code_Effacement == 0) {
                                            document.getElementById('Code_Effacement').innerHTML = '<?php echo $Resultat_Appel_Compte->social_id; ?>';
                                            Clique_Code_Effacement = 1;
                                        } else {
                                            document.getElementById('Code_Effacement').innerHTML = '●●●●●●●';
                                            Clique_Code_Effacement = 0;
                                        }
                                        ;" class="pull-right Pointer material-icons md-icon-visible"></i>

                            </td>
                        </tr>
                    <?php } ?>

                    <?php if ($Resultat_Appel_Compte->Safebox_Size == "") { ?>
                        <tr>
                            <td>Entrepôt :</td>
                            <td>Entrepot non-crée.</td>
                        </tr>
                    <?php } else { ?>
                        <?php if ($Resultat_Appel_Compte->Safebox_Password == "") { ?>
                            <?php $Password_Entrepot = "000000"; ?>
                        <?php } else { ?>
                            <?php $Password_Entrepot = $Resultat_Appel_Compte->Safebox_Password; ?>
                        <?php } ?>
                        <tr>
                            <td>Entrepôt :</td>
                            <td id="Code_Entrepot">
                                ●●●●●●

                                <i style="margin-left: 5px;"  data-tooltip="Modifier mon code" onclick="Ajax('pages/MonCompte/CodeEntrepotChangeForm.php');" class="pull-right Pointer material-icons md-icon-edit text-yellow"></i>

                                <i data-tooltip="Récupérer le code entrepôt" onclick="Ajax('pages/MonCompte/CodeEntrepotForgottenEmail.php');" class="pull-right Pointer material-icons md-icon-settings_backup_restore text-blue"></i>

                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="col-lg-8">

            <?php
            /* ------------------------ Recuperation Compte ----------------------------- */
            $Liste_Personnages = "SELECT player.name,
                                 player.id,
                                 player.level,
                                 player.job,
                                 player.ip,
                                 player.exp,
                                 player.playtime,
                                 player.skill_group,
                                 player.last_play
                          FROM player.player
                          WHERE player.account_id = ?
                          ORDER by level DESC
                          LIMIT 4";
            $Parametres_Liste_Personnages = $this->objConnection->prepare($Liste_Personnages);
            $Parametres_Liste_Personnages->execute(array($Appel_Compte_Id));
            $Parametres_Liste_Personnages->setFetchMode(\PDO::FETCH_OBJ);
            $Nombre_De_Resultat = $Parametres_Liste_Personnages->rowCount();

            /* -------------------------------------------------------------------------- */
            ?>
            <table class="table table-condensed table-hover" style="border-collapse: collapse;">
                <thead>
                    <tr>
                        <th class="hidden-md hidden-sm hidden-xs" width="50">Race</th>
                        <th width="130">Pseudonyme</th>
                        <th class="hidden-md hidden-sm hidden-xs">Classe</th>
                        <th width="30">Lvl</th>
                        <th class="hidden-md hidden-sm hidden-xs">Temps de jeu</th>
                        <th width="95">Ip</th>
                        <th width="30">Status</th>
                    </tr>

                </thead>

                <tbody>
                    <?php if ($Nombre_De_Resultat != 0) { ?>

                        <?php while ($Resultat_Liste_Personnages = $Parametres_Liste_Personnages->fetch()) { ?>

                            <?php
                            $dt = \Carbon\Carbon::create(2000, 1, 1, 0, 0, 0)->startOfDay();
                            $dt2 = $dt->copy()->addMinute($Resultat_Liste_Personnages->playtime);
                            $var = $dt->diffInMonths($dt2) . " mois, ";
                            $var .= $dt->diffInDays($dt2) . " jours et ";
                            $var .= $dt->diffInHours($dt2) . " heures";

                            Carbon\CarbonInterval::minutes($Resultat_Liste_Personnages->playtime);
                            ?>
                            <tr data-tooltip="Cliquez pour voir le détails du personnage" onclick="Ajax('pages/MonPersonnage/MonPersonnage.php?id=<?php echo $Resultat_Liste_Personnages->id; ?>')" class="Pointer">
                                <td class="hidden-md hidden-sm hidden-xs">
                                    <?php if ($Resultat_Liste_Personnages->job == "0") { ?> 
                                        <img class="cadrephotoclassement" src="../images/races/0_mini.png" height="25"/>
                                    <?php } else if ($Resultat_Liste_Personnages->job == "1") { ?> 
                                        <img class="cadrephotoclassement" src="../images/races/1_mini.png" height="25"/>
                                    <?php } else if ($Resultat_Liste_Personnages->job == "2") { ?> 
                                        <img class="cadrephotoclassement" src="../images/races/2_mini.png" height="25"/>
                                    <?php } else if ($Resultat_Liste_Personnages->job == "3") { ?> 
                                        <img class="cadrephotoclassement" src="../images/races/3_mini.png" height="25"/>
                                    <?php } else if ($Resultat_Liste_Personnages->job == "4") { ?> 
                                        <img class="cadrephotoclassement" src="../images/races/4_mini.png" height="25"/>
                                    <?php } else if ($Resultat_Liste_Personnages->job == "5") { ?> 
                                        <img class="cadrephotoclassement" src="../images/races/5_mini.png" height="25"/>
                                    <?php } else if ($Resultat_Liste_Personnages->job == "6") { ?> 
                                        <img class="cadrephotoclassement" src="../images/races/6_mini.png" height="25"/>
                                    <?php } else if ($Resultat_Liste_Personnages->job == "7") { ?> 
                                        <img class="cadrephotoclassement" src="../images/races/7_mini.png" height="25"/>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php echo $Resultat_Liste_Personnages->name ?>
                                </td>
                                <td>

                                    <?php if ($Resultat_Liste_Personnages->job == 0) { ?>
                                        <?php if ($Resultat_Liste_Personnages->skill_group == 1) { ?>
                                            Corp à Corp
                                        <?php } elseif ($Resultat_Liste_Personnages->skill_group == 2) { ?>
                                            Mental
                                        <?php } else { ?>
                                            Non-définie
                                        <?php } ?>	
                                    <?php } elseif ($Resultat_Liste_Personnages->job == 1) { ?>
                                        <?php if ($Resultat_Liste_Personnages->skill_group == 1) { ?>
                                            Assasin
                                        <?php } elseif ($Resultat_Liste_Personnages->skill_group == 2) { ?>
                                            Archer
                                        <?php } else { ?>
                                            Non-définie
                                        <?php } ?>
                                    <?php } elseif ($Resultat_Liste_Personnages->job == 2) { ?>
                                        <?php if ($Resultat_Liste_Personnages->skill_group == 1) { ?>
                                            Arme magique
                                        <?php } elseif ($Resultat_Liste_Personnages->skill_group == 2) { ?>
                                            Magie Noir
                                        <?php } else { ?>
                                            Non-définie
                                        <?php } ?>
                                    <?php } elseif ($Resultat_Liste_Personnages->job == 3) { ?>
                                        <?php if ($Resultat_Liste_Personnages->skill_group == 1) { ?>
                                            Dragon
                                        <?php } elseif ($Resultat_Liste_Personnages->skill_group == 2) { ?>
                                            Soin
                                        <?php } else { ?>
                                            Non-définie
                                        <?php } ?>
                                    <?php } elseif ($Resultat_Liste_Personnages->job == 4) { ?>
                                        <?php if ($Resultat_Liste_Personnages->skill_group == 1) { ?>
                                            CàC
                                        <?php } elseif ($Resultat_Liste_Personnages->skill_group == 2) { ?>
                                            Mental
                                        <?php } else { ?>
                                            Non-définie
                                        <?php } ?>	
                                    <?php } elseif ($Resultat_Liste_Personnages->job == 5) { ?>
                                        <?php if ($Resultat_Liste_Personnages->skill_group == 1) { ?>
                                            Assasin
                                        <?php } elseif ($Resultat_Liste_Personnages->skill_group == 2) { ?>
                                            Archer
                                        <?php } else { ?>
                                            Non-définie
                                        <?php } ?>
                                    <?php } elseif ($Resultat_Liste_Personnages->job == 6) { ?>
                                        <?php if ($Resultat_Liste_Personnages->skill_group == 1) { ?>
                                            AM
                                        <?php } elseif ($Resultat_Liste_Personnages->skill_group == 2) { ?>
                                            MN
                                        <?php } else { ?>
                                            Non-définie
                                        <?php } ?>
                                    <?php } elseif ($Resultat_Liste_Personnages->job == 7) { ?>
                                        <?php if ($Resultat_Liste_Personnages->skill_group == 1) { ?>
                                            Dragon
                                        <?php } elseif ($Resultat_Liste_Personnages->skill_group == 2) { ?>
                                            Soin
                                        <?php } else { ?>
                                            Non-définie
                                        <?php } ?>
                                    <?php } else { ?>
                                        Non-définie
                                    <?php } ?>
                                </td>
                                <td><?php echo $Resultat_Liste_Personnages->level; ?></td>
                                <td class="hidden-md hidden-sm hidden-xs">
                                    <?php echo $var; ?>
                                </td>
                                <td><?php echo $Resultat_Liste_Personnages->ip ?></td>

                                <?php
                                $Parametres_Verification_Connecte->execute(array(
                                    $Resultat_Liste_Personnages->id));
                                $Parametres_Verification_Connecte->setFetchMode(\PDO::FETCH_OBJ);
                                $Resultat_Verification_Connecte = $Parametres_Verification_Connecte->rowCount();
                                ?>

                                <td>
                                    <?php if ($Resultat_Verification_Connecte != "1") { ?>
                                        <span data-tooltip="Hors-ligne" data-tooltip-position="left" class="pull-right">
                                            <i class="text-red material-icons md-icon-account-circle"></i>
                                        </span>
                                    <?php } else { ?>
                                        <span data-tooltip="En ligne" data-tooltip-position="left" class="pull-right">
                                            <i class="text-green material-icons md-icon-account-circle"></i>
                                        </span>
                                    <?php } ?>
                                </td>
                            </tr>

                        <?php } ?>

                    <?php } else { ?>
                        <tr>
                            <td colspan="8">
                                Aucuns personnages.
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
    </div>

    <div class="row" style="margin-bottom: 10px;">


        <div class="col-md-12">

            <?php if ($Resultat_Appel_Compte->autoloot_expire != "0000-00-00 00:00:00") { ?>
                <?php $Resultat_Appel_Compte->autoloot_expire = str_replace("-", "/", $Resultat_Appel_Compte->autoloot_expire); ?>
            <div class="col-lg-4" style="margin-top: 10px;"><?php echo $Array_BonusCompte['autoloot_expire'] ?><span id="Compteloot" style="position: relative; left:12px;"></span></div>
                <script>
                    $('#Compteloot').countdown('<?= $Resultat_Appel_Compte->autoloot_expire; ?>', function (event) {
                        $(this).html(event.strftime('%-m mois / %-D %!d:jour,jours; %-H:%M:%S'));
                    });
                </script>
            <?php } ?>
                
            <?php if ($Resultat_Appel_Compte->gold_expire != "0000-00-00 00:00:00") { ?>
                <?php $Resultat_Appel_Compte->gold_expire = str_replace("-", "/", $Resultat_Appel_Compte->gold_expire); ?>
                <div class="col-lg-4" style="margin-top: 10px;"><?php echo $Array_BonusCompte['gold_expire'] ?><span id="Comptegold" style="position: relative; left:12px;"></span></div>
                <script>
                    $('#Comptegold').countdown('<?= $Resultat_Appel_Compte->gold_expire; ?>', function (event) {
                        $(this).html(event.strftime('%-m mois / %-D %!d:jour,jours; %-H:%M:%S'));
                    });
                </script>
            <?php } ?>
                
            <?php if ($Resultat_Appel_Compte->silver_expire != "0000-00-00 00:00:00") { ?>
                <?php $Resultat_Appel_Compte->silver_expire = str_replace("-", "/", $Resultat_Appel_Compte->silver_expire); ?>
                <div class="col-lg-4" style="margin-top: 10px;"><?php echo $Array_BonusCompte['silver_expire'] ?><span id="Comptesilver" style="position: relative; left:12px;"></span></div>
                <script>
                    $('#Comptesilver').countdown('<?= $Resultat_Appel_Compte->silver_expire; ?>', function (event) {
                        $(this).html(event.strftime('%-m mois / %-D %!d:jour,jours; %-H:%M:%S'));
                    });
                </script>
            <?php } ?>
                
            <?php if ($Resultat_Appel_Compte->marriage_fast_expire != "0000-00-00 00:00:00") { ?>
                <?php $Resultat_Appel_Compte->marriage_fast_expire = str_replace("-", "/", $Resultat_Appel_Compte->marriage_fast_expire); ?>
                <div class="col-lg-4" style="margin-top: 10px;"><?php echo $Array_BonusCompte['marriage_fast_expire'] ?><span id="Comptelove" style="position: relative; left:12px;"></span></div>
                <script>
                    $('#Comptelove').countdown('<?= $Resultat_Appel_Compte->marriage_fast_expire; ?>', function (event) {
                        $(this).html(event.strftime('%-m mois / %-D %!d:jour,jours; %-H:%M:%S'));
                    });
                </script>
            <?php } ?>
                
            <?php if ($Resultat_Appel_Compte->safebox_expire != "0000-00-00 00:00:00") { ?>
                <?php $Resultat_Appel_Compte->safebox_expire = str_replace("-", "/", $Resultat_Appel_Compte->safebox_expire); ?>
                <div class="col-lg-4" style="margin-top: 10px;"><?php echo $Array_BonusCompte['safebox_expire'] ?><span id="Comptesafebox" style="position: relative; left:12px;"></span></div>
                <script>
                    $('#Comptesafebox').countdown('<?= $Resultat_Appel_Compte->safebox_expire; ?>', function (event) {
                        $(this).html(event.strftime('%-m mois / %-D %!d:jour,jours; %-H:%M:%S'));
                    });
                </script>
            <?php } ?>
                
            <?php if ($Resultat_Appel_Compte->money_drop_rate_expire != "0000-00-00 00:00:00") { ?>
                <?php $Resultat_Appel_Compte->money_drop_rate_expire = str_replace("-", "/", $Resultat_Appel_Compte->money_drop_rate_expire); ?>
                <div class="col-lg-4" style="margin-top: 10px;"><?php echo $Array_BonusCompte['money_drop_rate_expire'] ?><span id="Comptemonnaie" style="position: relative; left:12px;"></span></div>
                <script>
                    $('#Comptemonnaie').countdown('<?= $Resultat_Appel_Compte->money_drop_rate_expire; ?>', function (event) {
                        $(this).html(event.strftime('%-m mois / %-D %!d:jour,jours; %-H:%M:%S'));
                    });
                </script>
            <?php } ?>
                
            <?php if ($Resultat_Appel_Compte->fish_mind_expire != "0000-00-00 00:00:00") { ?>
                <?php $Resultat_Appel_Compte->fish_mind_expire = str_replace("-", "/", $Resultat_Appel_Compte->fish_mind_expire); ?>
                <div class="col-lg-4" style="margin-top: 10px;"><?php echo $Array_BonusCompte['fish_mind_expire'] ?><span id="Comptepeche" style="position: relative; left:12px;"></span></div>
                <script>
                    $('#Comptepeche').countdown('<?= $Resultat_Appel_Compte->fish_mind_expire; ?>', function (event) {
                        $(this).html(event.strftime('%-m mois / %-D %!d:jour,jours; %-H:%M:%S'));
                    });
                </script>
            <?php } ?>

        </div>

    </div>

    <div class="clearfix"></div>
</div>
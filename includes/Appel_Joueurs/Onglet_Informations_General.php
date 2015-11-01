<div class="tab-pane active" id="Onglet_InformationGeneral">


    <div class="row">
        <div class="col-lg-4">
            <table class="table table-condensed" style="border-collapse: collapse;">
                <tr>
                    <td style="border-top: 0px;" class="Colonne_Gauche">
                        <span>Personnage :</span>
                    </td>
                    <td style="border-top: 0px;">
                        <?php echo $Donnees_Appel_Joueurs_Page->name; ?>

                        <?php
                        $Parametres_Verification_Connecte->execute(array(
                            $Donnees_Appel_Joueurs_Page->player_id));
                        $Parametres_Verification_Connecte->setFetchMode(PDO::FETCH_OBJ);
                        $Resultat_Verification_Connecte = $Parametres_Verification_Connecte->rowCount();
                        ?>

                        <?php if ($Resultat_Verification_Connecte != "1") { ?>
                            <?php $Resultat_Appel_Joueur_Connecte = 0; ?>

                            <span data-tooltip="Hors-ligne" data-tooltip-position="left" class="hidden-md pull-right">
                                <i class="text-red material-icons md-icon-account-circle"></i>
                            </span>
                        <?php } else { ?>
                            <?php $Resultat_Appel_Joueur_Connecte = 1; ?>

                            <span data-tooltip="En ligne" data-tooltip-position="left" class="hidden-md pull-right">
                                <i class="text-green material-icons md-icon-account-circle"></i>
                            </span>
                        <?php } ?>

                    </td>
                </tr>
                <tr>
                    <td class="Colonne_Gauche">
                        <span>Level :</span>
                    </td>
                    <td><?php echo $Donnees_Appel_Joueurs_Page->level; ?></td>
                </tr>
                <tr>
                    <td class="Colonne_Gauche">Experience</td>
                    <?php $Formatage_Experience = number_format($Donnees_Appel_Joueurs_Page->exp, 0, '.', ' ') . " exp."; ?>
                    <td><?php echo $Formatage_Experience; ?></td>
                </tr>
                <tr>
                    <td class="Colonne_Gauche">
                        <span>Yangs :</span>
                    </td>
                    <?php $Formatage_Yangs = number_format($Donnees_Appel_Joueurs_Page->gold, 0, '.', ' ') . " yangs."; ?>
                    <td><?php echo $Formatage_Yangs; ?></td>
                </tr>
                <tr>
                    <td class="Colonne_Gauche">
                        <span>Temp de jeu :</span>
                    </td>
                    <?php
                    $Heures_de_Jeu = floor($Donnees_Appel_Joueurs_Page->playtime / 60);
                    $Minutes_de_Jeu = (($Donnees_Appel_Joueurs_Page->playtime) % 60);
                    $Jours_de_Jeu = floor($Heures_de_Jeu / 24);
                    $Heures_de_Jeu = ($Heures_de_Jeu - ($Jours_de_Jeu * 24));

                    if ($Minutes_de_Jeu < 10) {
                        $Minutes_de_Jeu = "0" . $Minutes_de_Jeu;
                    }
                    ?>
                    <td><?php echo $Jours_de_Jeu . " jours et " . $Heures_de_Jeu . "h" . $Minutes_de_Jeu . "min"; ?></td>
                </tr>
                <tr>
                    <td class="Colonne_Gauche">
                        <span>Grade :</span>
                    </td>
                    <?php
                    $alignement = ($Donnees_Appel_Joueurs_Page->alignment / 10);
                    if ($alignement >= 0 && $alignement < 1000) {
                        $grade = 0;
                    } else if ($alignement >= 1000 && $alignement < 4000) {
                        $grade = 1;
                    } else if ($alignement >= 4000 && $alignement < 8000) {
                        $grade = 2;
                    } else if ($alignement >= 8000 && $alignement < 12000) {
                        $grade = 3;
                    } else if ($alignement >= 12000 && $alignement <= 30000) {
                        $grade = 4;
                    }

                    if ($alignement <= -1 && $alignement > -4000) {
                        $grade = -1;
                    } else if ($alignement <= -4000 && $alignement > -8000) {
                        $grade = -2;
                    } else if ($alignement <= -8000 && $alignement > -12000) {
                        $grade = -3;
                    } else if ($alignement <= -12000 && $alignement >= -30000) {
                        $grade = -4;
                    }
                    ?>
                    <?php if ($alignement < 0) { ?>
                        <td><span class="Couleur_Grade_Negatif"><?php echo $Array_Grades[$grade] ?></span></td>
                    <?php } else { ?>
                        <td><span class="Couleur_Grade_Positif"><?php echo $Array_Grades[$grade] ?></span></td>
                    <?php } ?>
                </tr>

                <tr>
                    <td class="Colonne_Gauche">Dernière conn.:</td>
                    <td><span style="font-size: 12px; font-weight: bold;"><?= Formatage_Date($Donnees_Appel_Joueurs_Page->last_play, true); ?></span></td>
                </tr>

                <?php
                if ($Resultat_Appel_Joueur_Connecte == 0) {

                    $Index_Map = $Donnees_Appel_Joueurs_Page->exit_map_index;
                } else {

                    $Index_Map = $Donnees_Appel_Joueurs_Page->map_index;
                }

                include 'Localisation.php';
                ?>

            </table>
        </div>

        <div class="col-lg-4">

            <table class="table table-condensed" style="border-collapse: collapse;">
                <tr>
                    <td style="border-top: 0px;">Compte</td>
                    <td style="border-top: 0px;">
                        <a title="Aller sur la page du compte" href="javascript:void(0)" onclick="Ajax('./includes/Appel_Compte.php?id=<?php echo $Donnees_Appel_Joueurs_Page->account_id; ?>')" rel="superbox[iframe]">
                            <?php echo $Donnees_Appel_Joueurs_Page->account_login; ?>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Empire</td>
                    <td>
                        <?php if ($Donnees_Appel_Joueurs_Page->empire == 1) { ?>
                            <img src="../images/empire/red.jpg" alt="Shinsoo" />
                        <?php } else if ($Donnees_Appel_Joueurs_Page->empire == 2) { ?> 
                            <img src="../images/empire/yellow.jpg" alt="Chunjo" />
                        <?php } else if ($Donnees_Appel_Joueurs_Page->empire == 3) { ?> 
                            <img src="../images/empire/blue.jpg" alt="Jinno" />
                        <?php } else { ?> 
                            <img src="../images/empire/Royaume_Inconnu.jpg" alt="Inconnu" />
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <?php if ($Donnees_Appel_Joueurs_Page->account_status == "OK") { ?>
                        <td onclick="Ajax('pages/Admin/Bannir_Compte.php?compte=<?php echo $Donnees_Appel_Joueurs_Page->account_id; ?>');">
                            <img src="../images/valid.gif" title="Compte actif"/>
                        </td>
                    <?php } else if ($Donnees_Appel_Joueurs_Page->account_status == "BLOCK") { ?>
                        <td>
                            <img src="../images/invalid.gif" title="Compte banni"/>
                        </td>
                    <?php } else { ?>
                        <td>
                            <img src="../images/warning.gif" title="Etat inconnu" />
                        </td>
                    <?php } ?>
                </tr>
                <tr>
                    <td>IP personnage</td></td>
                    <td><?php echo $Donnees_Appel_Joueurs_Page->player_ip; ?></td>
                </tr>
            </table>


            <?php
            /* ----------------------------------------------- Verif Guilde -------------------------------------------- */
            $Verif_Guilde = "SELECT id
                            FROM player.guild
                            WHERE guild.master = '" . $Donnees_Appel_Joueurs_Page->player_id . "'
                            LIMIT 1";

            $Parametres_Verif_Guilde = $Connexion->query($Verif_Guilde);
            $Parametres_Verif_Guilde->setFetchMode(PDO::FETCH_OBJ);
            $Nombre_De_Resultat_Verif_Guilde = $Parametres_Verif_Guilde->rowCount();
            /* ----------------------------------------------------------------------------------------------------- */
            ?>
            <table class="table table-condensed" style="border-collapse: collapse;">
                <tr>
                    <td>Guilde</td>
                    <?php if ($Donnees_Appel_Joueurs_Page->guild_name == "") { ?>
                        <td>
                            Pas de guilde

                        </td>
                    <?php } else { ?>
                        <td>
                            <?php echo $Donnees_Appel_Joueurs_Page->guild_name; ?>
                            <div class="Icone_Chef_Guilde">
                                <?php if ($Nombre_De_Resultat_Verif_Guilde == 0) { ?>
                                    <img src="../images/icones/membre.png" title="Membre" />
                                <?php } else { ?>
                                    <img src="../images/icones/couronne.png" title="Chef de la Guilde"/>
                                <?php } ?>
                            </div>
                        </td>
                    <?php } ?>
                </tr>
                <tr>
                    <td>Conjoint</td>
                    <?php
                    /* ----------------------------------------------- Conjoint -------------------------------------------- */
                    $Appel_Joueur_Conjoint = "SELECT player.name,
                                                     player.id
                                              FROM player.marriage
                                              LEFT JOIN player.player
                                              ON (player.id = marriage.pid1)
                                              WHERE (marriage.pid1 = '" . $Donnees_Appel_Joueurs_Page->player_id . "'
                                              OR marriage.pid2 = '" . $Donnees_Appel_Joueurs_Page->player_id . "')";

                    $Parametres_Appel_Joueur_Conjoint = $Connexion->query($Appel_Joueur_Conjoint);
                    $Parametres_Appel_Joueur_Conjoint->setFetchMode(PDO::FETCH_OBJ);
                    /* ----------------------------------------------------------------------------------------------------- */

                    $Resultat_Verification_Conjoint = $Parametres_Appel_Joueur_Conjoint->fetch();
                    ?>

                    <?php if (@$Resultat_Verification_Conjoint->name == $Donnees_Appel_Joueurs_Page->name) { ?>

                        <?php
                        /* ----------------------------------------------- Conjoint -------------------------------------------- */
                        $Appel_Joueur_Conjoint = "SELECT player.name,
                                                         player.id
                                                  FROM player.marriage
                                                  LEFT JOIN player.player
                                                  ON (player.id = marriage.pid2)
                                                  WHERE (marriage.pid1 = '" . $Donnees_Appel_Joueurs_Page->player_id . "'
                                                  OR marriage.pid2 = '" . $Donnees_Appel_Joueurs_Page->player_id . "')";

                        $Parametres_Appel_Joueur_Conjoint = $Connexion->query($Appel_Joueur_Conjoint);
                        $Parametres_Appel_Joueur_Conjoint->setFetchMode(PDO::FETCH_OBJ);
                        /* ----------------------------------------------------------------------------------------------------- */

                        $Resultat_Verification_Conjoint = $Parametres_Appel_Joueur_Conjoint->fetch();
                        ?>
                    <?php } ?>

                    <?php if ($Resultat_Verification_Conjoint == "") { ?>
                        <td>Célibataire</td>
                    <?php } else { ?>
                        <?php
                        if (($Donnees_Appel_Joueurs_Page->job == "1") ||
                                ($Donnees_Appel_Joueurs_Page->job == "3") ||
                                ($Donnees_Appel_Joueurs_Page->job == "4") ||
                                ($Donnees_Appel_Joueurs_Page->job == "6")) {
                            ?>
                            <td><?php echo "Mariée à" . $Resultat_Verification_Conjoint->name ?></td>
                        <?php } else { ?>
                            <td><?php echo "Marié à " . $Resultat_Verification_Conjoint->name ?></td>
                        <?php } ?>
                    <?php } ?>
                </tr>

            </table>
        </div>
        <div class="col-lg-4">

            <table class="table table-condensed" style="border-collapse: collapse;">
                <tr>
                    <td style="border-top: 0px;">Points de stats</td></td>
                    <td style="border-top: 0px;"><?php echo $Donnees_Appel_Joueurs_Page->stat_point; ?></td>
                </tr>
                <tr>
                    <td>Vitalité</td></td>
                    <td><?php echo $Donnees_Appel_Joueurs_Page->player_VIT; ?></td>
                </tr>
                <tr>
                    <td>Intelligence</td></td>
                    <td><?php echo $Donnees_Appel_Joueurs_Page->player_INT; ?></td>
                </tr>
                <tr>
                    <td>Force</td></td>
                    <td><?php echo $Donnees_Appel_Joueurs_Page->player_STR; ?></td>
                </tr>
                <tr>
                    <td>Dextérité</td></td>
                    <td><?php echo $Donnees_Appel_Joueurs_Page->player_DEX; ?></td>
                </tr>

            </table>

        </div>

        <div id="dialog_Confirmation_Deblocage_Yangs" title="Confirmer la réinitialisation">Pensez à déconnecter votre personnage et patientez 10 minutes.</div>
        <input style="display: none;" id="Id_Tempo_Deblocage_Yangs" value="" />

        <div id="dialog_Confirmation_Deblocage_Perso" title="Confirmer le déblocage">Pensez à déconnecter votre personnage et patientez 10 minutes.</div>
        <input style="display: none;" id="Id_Tempo_Deblocage_Perso" value="" />

    </div>

    <div class="row">
        <div class="col-lg-12" style="padding-bottom: 10px; padding-left: 25px;">

            <button type="button" data-tooltip="Ramène le personnage sur sa map originel" class="btn btn-flat btn-warning" onclick="Ouverture_Dialogue_Deblocage_Perso(<?php echo $Donnees_Appel_Joueurs_Page->player_id; ?>);">
                Débloquer
            </button>

            <?php if ($Donnees_Appel_Joueurs_Page->gold < 0) { ?>
                <button type="button" data-tooltip="Ramène les yangs bloqués à 1 500 000" class="btn btn-flat btn-warning" onclick="Ouverture_Dialogue_Deblocage_Yangs(<?php echo $Donnees_Appel_Joueurs_Page->player_id; ?>);">
                    Réinitialiser mes yangs
                </button>
            <?php } ?>

            <button type="button" data-tooltip="" class="btn btn-flat btn-primary" onclick="Ajax('pages/Personnage_Renommer.php?id_perso=<?php echo $Donnees_Appel_Joueurs_Page->player_id; ?>');">
                Renommer
            </button>

            <button type="button" data-tooltip="Supprimer votre personnage" class="btn btn-flat btn-danger" onclick="Ajax('pages/Personnage_Supprimer.php?id_perso=<?php echo $Donnees_Appel_Joueurs_Page->player_id; ?>');">
                Supprimer
            </button>
        </div>
    </div>

    <script type="text/javascript">

        function Compte_A_Rebour() {

        }

        $(function () {
            $("#dialog_Confirmation_Deblocage_Perso").dialog({
                resizable: false,
                autoOpen: false,
                modal: true,
                buttons: {
                    "Je confirme": function () {
                        $(this).dialog("close");
                        Deblocage_Personnage();

                    },
                    "Annuler": function () {
                        $(this).dialog("close");
                        window.parent.Barre_De_Statut("Déblocage annulé.");
                        window.parent.Icone_Chargement(0);
                    }
                }
            });

        });

        $(function () {
            $("#dialog_Confirmation_Deblocage_Yangs").dialog({
                resizable: false,
                autoOpen: false,
                modal: true,
                buttons: {
                    "Je confirme": function () {
                        $(this).dialog("close");
                        Deblocage_Yangs();

                    },
                    "Annuler": function () {
                        $(this).dialog("close");
                        window.parent.Barre_De_Statut("Déblocage annulé.");
                        window.parent.Icone_Chargement(0);
                    }
                }
            });

        });

        function Ouverture_Dialogue_Deblocage_Perso(id_perso) {

            window.parent.Barre_De_Statut("En attente de la confirmation...");
            window.parent.Icone_Chargement(1);

            $("#Id_Tempo_Deblocage_Perso").val(id_perso);
            $("#dialog_Confirmation_Deblocage_Perso").dialog("open");
        }

        function Ouverture_Dialogue_Deblocage_Yangs(id_perso) {

            window.parent.Barre_De_Statut("En attente de la confirmation...");
            window.parent.Icone_Chargement(1);

            $("#Id_Tempo_Deblocage_Yangs").val(id_perso);
            $("#dialog_Confirmation_Deblocage_Yangs").dialog("open");
        }

        function Deblocage_Yangs() {

            window.parent.Barre_De_Statut("Réinitialisation des yangs en cours...");
            window.parent.Icone_Chargement(1);

            $.ajax({
                type: "POST",
                url: "Appel_Joueurs/SQL_Deblocage_Yangs.php",
                data: "id_perso=" + $("#Id_Tempo_Deblocage_Yangs").val(),
                success: function (msg) {

                    if (msg == "NOT_YOU") {
                        window.parent.Barre_De_Statut("Ce perssonage ne vous appartient pas.");
                        window.parent.Icone_Chargement(2);
                    } else if (msg == "YANGS") {
                        window.parent.Barre_De_Statut("Ce personnage n'as pas de problème de yangs.");
                        window.parent.Icone_Chargement(2);
                    } else {

                        window.parent.Barre_De_Statut("Yangs réinitialisé.");
                        window.parent.Icone_Chargement(0);
                    }

                }
            });
        }

        function Deblocage_Personnage() {

            window.parent.Barre_De_Statut("Réinitialisation des coordonées du personnage...");
            window.parent.Icone_Chargement(1);

            $.ajax({
                type: "POST",
                url: "Appel_Joueurs/SQL_Deblocage_Perso.php",
                data: "id_perso=" + $("#Id_Tempo_Deblocage_Perso").val(),
                success: function (msg) {

                    if (msg == "NOT_EMPIRE") {

                        window.parent.Barre_De_Statut("Ce personnage n'as pas d'empire.");
                        window.parent.Icone_Chargement(2);

                    } else if (msg == "NOT_YOU") {

                        window.parent.Barre_De_Statut("Ce personnage ne vous appartient pas.");
                        window.parent.Icone_Chargement(2);

                    } else {

                        window.parent.Barre_De_Statut("Coordonées réinitialisé.");
                        window.parent.Icone_Chargement(0);
                    }

                }
            });
        }
    </script>

</div>
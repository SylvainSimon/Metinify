<?php

namespace Pages\Classements;

require __DIR__ . '../../../core/initialize.php';

class ClassementJoueursPvE extends \PageHelper {

    public function run() {

        $Numero_De_Page = 0;

        /* ------------------------------ Vérification connecte ---------------------------------------------- */
        $Verification_Connecte = "SELECT id FROM player.player
                          WHERE player.id = ?
                          AND player.last_play >= (NOW() - INTERVAL 10 MINUTE)
                          LIMIT 1";
        $Parametres_Verification_Connecte = $this->objConnection->prepare($Verification_Connecte);
        /* -------------------------------------------------------------------------------------------------- */

        /* ------------------------ Classement Joueur ---------------------------- */
        $Classement_Joueur = "SELECT player.name,
                             player.id AS player_id,
                             player.job,
                             player.exp,
                             player.level,
                             player.skill_group,
                             player_index.empire,
			     player.score_pve,
                             account.id

                             FROM player.player
                             LEFT JOIN account.account
                             ON account.id = player.account_id
                             LEFT JOIN player.player_index
                             ON player_index.id = account.id
                                         
                             WHERE (account.status='OK')
                             AND ( not (name like '[GM]%' ))
                             AND ( not (name like '[TGM]%' ))
                             AND ( not (name like '[Admin]%' ))
                             AND ( not (name like '[TM]%' ))
                             AND ( not (name like '[SGM]%' ))
                             AND player.name NOT IN(SELECT mName FROM common.gmlist)

                             ORDER BY score_pve DESC, level DESC, exp DESC
                             LIMIT 0,10";
        $Parametres_Classement_Joueur = $this->objConnection->query($Classement_Joueur);
        $Parametres_Classement_Joueur->setFetchMode(\PDO::FETCH_OBJ);
        /* -------------------------------------------------------------------------- */

        /* ------------------------------ Comptage joueur ------------------------------- */
        $Comptage_Joueurs = "SELECT id FROM player.player";
        $Parametres_Comptage_Joueurs = $this->objConnection->query($Comptage_Joueurs);
        $Nombre_De_Joueurs = $Parametres_Comptage_Joueurs->rowCount();
        /* --------------------------------------------------------------------------------- */

        $nombredePage = (($Nombre_De_Joueurs / 10) - 1);
        $i = $Numero_De_Page + 1;
        ?>

        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Classement arène PVE</h3>

            </div>

            <div class="box-body no-padding">

                <script type="text/javascript">

                    function Recherche_Joueurs() {

                        Barre_De_Statut("Recherche du joueur en cours...");
                        Icone_Chargement(1);

                        $.ajax({
                            type: "POST",
                            url: "ajax/Pages_ClassementJoueurs_Recherche_PvE.php",
                            data: "recherche=" + $("#SaisieRecherche").val(),
                            success: function (msg) {

                                $("#pagedeclassement").html(msg);
                                Barre_De_Statut("Recherche terminé.");
                                Icone_Chargement(0);

                            }
                        });
                        return false;

                    }

                </script>

                <div class="row" style="padding: 10px;">
                    <div class="col-md-4">
                        <input type="text" class="form-control input-sm inline" autofocus="autofocus" placeholder="Pseudo..." id="SaisieRecherche"/>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="btn btn-primary btn-flat btn-sm inline" src="images/Bouton_Rechercher.png" onclick="if (document.getElementById('SaisieRecherche').value != '') {
                                            Recherche_Joueurs();
                                        }" value="Rechercher"/>
                    </div>
                </div>


                <div id="Changement_de_Page">

                    <table class="table table-condensed table-hover" style="border-collapse: collapse; margin-bottom: 5px;"> 
                        <thead>
                            <tr>
                                <th style="width: 15px;" align="center"></th>
                                <th style="width: 15px;">Race</th>
                                <th>Pseudo</th>
                                <th class="hidden-md hidden-sm hidden-xs">Level</th>
                                <th class="hidden-md hidden-sm hidden-xs">Expérience</th>
                                <th>Classe</th>
                                <th>PVE</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="pagedeclassement">

                            <?php while ($Donnees_Classement_Joueurs = $Parametres_Classement_Joueur->fetch()) { ?>

                                <tr>
                                    <td align="center">
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
                                            echo $i;
                                        }
                                        ?>
                                    </td>

                                    <td>
                                        <?php if ($Donnees_Classement_Joueurs->job == "0") { ?> 
                                            <img class="Dimension_Image_Classement" src="images/races/0_mini.png"/>
                                        <?php } else if ($Donnees_Classement_Joueurs->job == "1") { ?> 
                                            <img class="Dimension_Image_Classement" src="images/races/1_mini.png"/>
                                        <?php } else if ($Donnees_Classement_Joueurs->job == "2") { ?> 
                                            <img  class="Dimension_Image_Classement" src="images/races/2_mini.png"/>
                                        <?php } else if ($Donnees_Classement_Joueurs->job == "3") { ?> 
                                            <img class="Dimension_Image_Classement" src="images/races/3_mini.png"/>
                                        <?php } else if ($Donnees_Classement_Joueurs->job == "4") { ?> 
                                            <img class="Dimension_Image_Classement" src="images/races/4_mini.png"/>
                                        <?php } else if ($Donnees_Classement_Joueurs->job == "5") { ?> 
                                            <img class="Dimension_Image_Classement" src="images/races/5_mini.png"/>
                                        <?php } else if ($Donnees_Classement_Joueurs->job == "6") { ?> 
                                            <img class="Dimension_Image_Classement" src="images/races/6_mini.png"/>
                                        <?php } else if ($Donnees_Classement_Joueurs->job == "7") { ?> 
                                            <img class="Dimension_Image_Classement" src="images/races/7_mini.png"/>
                                        <?php } ?>
                                    </td>

                                    <td>
                                        <?php echo $Donnees_Classement_Joueurs->name; ?>
                                    </td>
                                    <td class="hidden-md hidden-sm hidden-xs">
                                        <?php echo $Donnees_Classement_Joueurs->level; ?>
                                    </td>
                                    <td  class="hidden-md hidden-sm hidden-xs">
                                        <?php echo $Donnees_Classement_Joueurs->exp; ?>
                                    </td>

                                    <td>

                                        <?php if ($Donnees_Classement_Joueurs->job == 0) { ?>
                                            <?php if ($Donnees_Classement_Joueurs->skill_group == 1) { ?>
                                                Corps à Corps
                                            <?php } elseif ($Donnees_Classement_Joueurs->skill_group == 2) { ?>
                                                Mental
                                            <?php } else { ?>
                                                Non-définie
                                            <?php } ?>	
                                        <?php } elseif ($Donnees_Classement_Joueurs->job == 1) { ?>
                                            <?php if ($Donnees_Classement_Joueurs->skill_group == 1) { ?>
                                                Assasin
                                            <?php } elseif ($Donnees_Classement_Joueurs->skill_group == 2) { ?>
                                                Archer
                                            <?php } else { ?>
                                                Non-définie
                                            <?php } ?>
                                        <?php } elseif ($Donnees_Classement_Joueurs->job == 2) { ?>
                                            <?php if ($Donnees_Classement_Joueurs->skill_group == 1) { ?>
                                                Arme magique
                                            <?php } elseif ($Donnees_Classement_Joueurs->skill_group == 2) { ?>
                                                Magie Noir
                                            <?php } else { ?>
                                                Non-définie
                                            <?php } ?>
                                        <?php } elseif ($Donnees_Classement_Joueurs->job == 3) { ?>
                                            <?php if ($Donnees_Classement_Joueurs->skill_group == 1) { ?>
                                                Dragon
                                            <?php } elseif ($Donnees_Classement_Joueurs->skill_group == 2) { ?>
                                                Soin
                                            <?php } else { ?>
                                                Non-définie
                                            <?php } ?>
                                        <?php } elseif ($Donnees_Classement_Joueurs->job == 4) { ?>
                                            <?php if ($Donnees_Classement_Joueurs->skill_group == 1) { ?>
                                                Corps à Corps
                                            <?php } elseif ($Donnees_Classement_Joueurs->skill_group == 2) { ?>
                                                Mental
                                            <?php } else { ?>
                                                Non-définie
                                            <?php } ?>	
                                        <?php } elseif ($Donnees_Classement_Joueurs->job == 5) { ?>
                                            <?php if ($Donnees_Classement_Joueurs->skill_group == 1) { ?>
                                                Assasin
                                            <?php } elseif ($Donnees_Classement_Joueurs->skill_group == 2) { ?>
                                                Archer
                                            <?php } else { ?>
                                                Non-définie
                                            <?php } ?>
                                        <?php } elseif ($Donnees_Classement_Joueurs->job == 6) { ?>
                                            <?php if ($Donnees_Classement_Joueurs->skill_group == 1) { ?>
                                                AM
                                            <?php } elseif ($Donnees_Classement_Joueurs->skill_group == 2) { ?>
                                                MN
                                            <?php } else { ?>
                                                Non-définie
                                            <?php } ?>
                                        <?php } elseif ($Donnees_Classement_Joueurs->job == 7) { ?>
                                            <?php if ($Donnees_Classement_Joueurs->skill_group == 1) { ?>
                                                Dragon
                                            <?php } elseif ($Donnees_Classement_Joueurs->skill_group == 2) { ?>
                                                Soin
                                            <?php } else { ?>
                                                Non-définie
                                            <?php } ?>
                                        <?php } else { ?>
                                            Non-définie
                                        <?php } ?>
                                    </td>

                                    <td>
                                        <?php echo $Donnees_Classement_Joueurs->score_pve; ?>
                                    </td>

                                    <td>
                                        <?php if ($Donnees_Classement_Joueurs->empire == 1) { ?>
                                            <i data-tooltip="Empire Shinsoo" data-tooltip-position="left" class="text-red material-icons md-icon-map md-20"></i>
                                        <?php } else if ($Donnees_Classement_Joueurs->empire == 2) { ?>
                                            <i data-tooltip="Empire Chunjo" data-tooltip-position="left" class="text-yellow material-icons md-icon-map md-20"></i>
                                        <?php } else if ($Donnees_Classement_Joueurs->empire == 3) { ?>
                                            <i data-tooltip="Empire Jinno" data-tooltip-position="left" class="text-blue material-icons md-icon-map md-20"></i>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php
                                        $Parametres_Verification_Connecte->execute(array(
                                            $Donnees_Classement_Joueurs->player_id));
                                        $Parametres_Verification_Connecte->setFetchMode(\PDO::FETCH_OBJ);
                                        $Resultat_Verification_Connecte = $Parametres_Verification_Connecte->rowCount();
                                        ?>
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
                                <?php $i++; ?>

                            <?php } ?>
                        </tbody>
                    </table>

                    <div class="row" style="padding: 10px;">

                        <div class="col-xs-6">
                            <div class="pull-left">
                                <?php if ($Numero_De_Page >= 1) { ?>
                                    <a href="javascript:void(0)" onclick="Ajax_Classement('ajax/Pages_ClassementJoueurs_PvE.php?page=<?php echo ($Numero_De_Page - 1); ?>')">Page précédente</a>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="pull-right">
                                <?php if ($Numero_De_Page <= $nombredePage) {
                                    ?>
                                    <a href="javascript:void(0)" onclick="Ajax_Classement('ajax/Pages_ClassementJoueurs_PvE.php?page=<?php echo ($Numero_De_Page + 1); ?>')">Page suivante</a>
                                <?php } ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php
    }

}

$class = new ClassementJoueursPvE();
$class->run();

<?php

namespace Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ClassementJoueursPvEPage extends \PageHelper {

    public function run() {

        $Numero_De_Page = $_GET['page'];
        $Limite_Basse = ($Numero_De_Page * 10);

        /* ------------------------------ Vérification connecte ---------------------------------------------- */
        $Verification_Connecte = "SELECT id FROM player.player
                          WHERE player.id = ?
                          AND player.last_play >= (NOW() - INTERVAL 10 MINUTE)
                          LIMIT 1";
        $Parametres_Verification_Connecte = $this->objConnection->prepare($Verification_Connecte);
        /* -------------------------------------------------------------------------------------------------- */

        /* ------------------------ Classement Joueur Page ------------------------ */
        $Classement_Joueur_Page = "SELECT player.name,
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
                                  LIMIT " . $Limite_Basse . ",10";

        $Parametres_Classement_Joueur_Page = $this->objConnection->query($Classement_Joueur_Page);
        $Parametres_Classement_Joueur_Page->setFetchMode(\PDO::FETCH_OBJ);
        /* -------------------------------------------------------------------------- */

        /* ------------------------------ Comptage joueur ------------------------------- */
        $Comptage_Joueurs = "SELECT id FROM player.player";
        $Parametres_Comptage_Joueurs = $this->objConnection->query($Comptage_Joueurs);
        $Nombre_De_Joueurs = $Parametres_Comptage_Joueurs->rowCount();
        /* --------------------------------------------------------------------------------- */

        $Nombre_De_Page = abs(($Nombre_De_Joueurs / 20) - 1);
        $i = $Limite_Basse + 1;
        ?>


        <table class="table table-condensed table-hover" style="border-collapse: collapse; margin-bottom: 5px;"> 
            <thead>
                <tr>
                    <th style="width: 15px;" align="center"></th>
                    <th style="width: 15px;">Race</th>
                    <th>Pseudo</th>
                    <th>Level</th>
                    <th class="hidden-md hidden-sm hidden-xs">Expérience</th>
                    <th>Classe</th>
                    <th>Score</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="pagedeclassement">
                <?php while ($Donnees_Classement_Joueurs_Page = $Parametres_Classement_Joueur_Page->fetch()) { ?> 

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
                            <?php if ($Donnees_Classement_Joueurs_Page->job == "0") { ?> 
                                <img class="Dimension_Image_Classement" src="images/races/0_mini.png"/>
                            <?php } else if ($Donnees_Classement_Joueurs_Page->job == "1") { ?> 
                                <img class="Dimension_Image_Classement" src="images/races/1_mini.png"/>
                            <?php } else if ($Donnees_Classement_Joueurs_Page->job == "2") { ?> 
                                <img  class="Dimension_Image_Classement" src="images/races/2_mini.png"/>
                            <?php } else if ($Donnees_Classement_Joueurs_Page->job == "3") { ?> 
                                <img class="Dimension_Image_Classement" src="images/races/3_mini.png"/>
                            <?php } else if ($Donnees_Classement_Joueurs_Page->job == "4") { ?> 
                                <img class="Dimension_Image_Classement" src="images/races/4_mini.png"/>
                            <?php } else if ($Donnees_Classement_Joueurs_Page->job == "5") { ?> 
                                <img class="Dimension_Image_Classement" src="images/races/5_mini.png"/>
                            <?php } else if ($Donnees_Classement_Joueurs_Page->job == "6") { ?> 
                                <img class="Dimension_Image_Classement" src="images/races/6_mini.png"/>
                            <?php } else if ($Donnees_Classement_Joueurs_Page->job == "7") { ?> 
                                <img class="Dimension_Image_Classement" src="images/races/7_mini.png"/>
                            <?php } ?>
                        </td>

                        <td style="text-indent: 5px;">
                            <?php echo $Donnees_Classement_Joueurs_Page->name; ?>
                        </td>
                        <td>
                            <?php echo $Donnees_Classement_Joueurs_Page->level; ?>
                        </td>
                        <td  class="hidden-md hidden-sm hidden-xs">
                            <?php echo $Donnees_Classement_Joueurs_Page->exp; ?>
                        </td>

                        <td>
                            <?php if ($Donnees_Classement_Joueurs_Page->job == 0) { ?>
                                <?php if ($Donnees_Classement_Joueurs_Page->skill_group == 1) { ?>
                                    Corps à Corps
                                <?php } elseif ($Donnees_Classement_Joueurs_Page->skill_group == 2) { ?>
                                    Mental
                                <?php } else { ?>
                                    Non-définie
                                <?php } ?>	
                            <?php } elseif ($Donnees_Classement_Joueurs_Page->job == 1) { ?>
                                <?php if ($Donnees_Classement_Joueurs_Page->skill_group == 1) { ?>
                                    Assasin
                                <?php } elseif ($Donnees_Classement_Joueurs_Page->skill_group == 2) { ?>
                                    Archer
                                <?php } else { ?>
                                    Non-définie
                                <?php } ?>
                            <?php } elseif ($Donnees_Classement_Joueurs_Page->job == 2) { ?>
                                <?php if ($Donnees_Classement_Joueurs_Page->skill_group == 1) { ?>
                                    Arme magique
                                <?php } elseif ($Donnees_Classement_Joueurs_Page->skill_group == 2) { ?>
                                    Magie Noir
                                <?php } else { ?>
                                    Non-définie
                                <?php } ?>
                            <?php } elseif ($Donnees_Classement_Joueurs_Page->job == 3) { ?>
                                <?php if ($Donnees_Classement_Joueurs_Page->skill_group == 1) { ?>
                                    Dragon
                                <?php } elseif ($Donnees_Classement_Joueurs_Page->skill_group == 2) { ?>
                                    Soin
                                <?php } else { ?>
                                    Non-définie
                                <?php } ?>
                            <?php } elseif ($Donnees_Classement_Joueurs_Page->job == 4) { ?>
                                <?php if ($Donnees_Classement_Joueurs_Page->skill_group == 1) { ?>
                                    CàC
                                <?php } elseif ($Donnees_Classement_Joueurs_Page->skill_group == 2) { ?>
                                    Mental
                                <?php } else { ?>
                                    Non-définie
                                <?php } ?>	
                            <?php } elseif ($Donnees_Classement_Joueurs_Page->job == 5) { ?>
                                <?php if ($Donnees_Classement_Joueurs_Page->skill_group == 1) { ?>
                                    Assasin
                                <?php } elseif ($Donnees_Classement_Joueurs_Page->skill_group == 2) { ?>
                                    Archer
                                <?php } else { ?>
                                    Non-définie
                                <?php } ?>
                            <?php } elseif ($Donnees_Classement_Joueurs_Page->job == 6) { ?>
                                <?php if ($Donnees_Classement_Joueurs_Page->skill_group == 1) { ?>
                                    AM
                                <?php } elseif ($Donnees_Classement_Joueurs_Page->skill_group == 2) { ?>
                                    MN
                                <?php } else { ?>
                                    Non-définie
                                <?php } ?>
                            <?php } elseif ($Donnees_Classement_Joueurs_Page->job == 7) { ?>
                                <?php if ($Donnees_Classement_Joueurs_Page->skill_group == 1) { ?>
                                    Dragon
                                <?php } elseif ($Donnees_Classement_Joueurs_Page->skill_group == 2) { ?>
                                    Soin
                                <?php } else { ?>
                                    Non-définie
                                <?php } ?>
                            <?php } else { ?>
                                Non-définie
                            <?php } ?>
                        </td>

                        <td>
                            <?php echo $Donnees_Classement_Joueurs_Page->score_pve; ?>
                        </td>

                        <td>
                            <?php if ($Donnees_Classement_Joueurs_Page->empire == 1) { ?>
                                <i class="text-red material-icons md-icon-map md-20"></i>
                            <?php } else if ($Donnees_Classement_Joueurs_Page->empire == 2) { ?>
                                <i class="text-yellow material-icons md-icon-map md-20"></i>
                            <?php } else if ($Donnees_Classement_Joueurs_Page->empire == 3) { ?>
                                <i class="text-blue material-icons md-icon-map md-20"></i>
                            <?php } ?>
                        </td>
                        <td>
                            <?php
                            $Parametres_Verification_Connecte->execute(array(
                                $Donnees_Classement_Joueurs_Page->player_id));
                            $Parametres_Verification_Connecte->setFetchMode(\PDO::FETCH_OBJ);
                            $Resultat_Verification_Connecte = $Parametres_Verification_Connecte->rowCount();
                            ?>
                            <?php if ($Resultat_Verification_Connecte != "1") { ?>
                                <span title="Hors-ligne" class="hidden-md pull-right">
                                    <i class="text-red material-icons md-icon-account-circle"></i>
                                </span>
                            <?php } else { ?>
                                <span title="En ligne" class="hidden-md pull-right">
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
                        <a href="javascript:void(0)" onclick="Ajax_Classement('pages/Classements/ajax/ClassementJoueursPvEPage.php?page=<?php echo ($Numero_De_Page - 1); ?>')">Page précédente</a>
                    <?php } ?>
                </div>
            </div>

            <div class="col-xs-6">
                <div class="pull-right">
                    <?php if ($Numero_De_Page <= $Nombre_De_Page) {
                        ?>
                        <a href="javascript:void(0)" onclick="Ajax_Classement('pages/Classements/ajaxClassementJoueursPvEPage.php?page=<?php echo ($Numero_De_Page + 1); ?>')">Page suivante</a>
                    <?php } ?>
                </div>
            </div>

        </div>
        <?php
    }

}

$class = new ClassementJoueursPvEPage();
$class->run();
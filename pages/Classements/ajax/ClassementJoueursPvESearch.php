<?php

namespace Pages\Classements\Ajax;

require __DIR__ . '../../../../core/initialize.php';

class ClassementJoueursPvESearch extends \PageHelper {

    public function run() {

        $Index_Recherche = 0;

        $Perso_A_Chercher = $_POST['recherche'];

        /* ------------------------ Classement Joueur ---------------------------- */
        $Classement_Joueur = "SELECT player.name,
                             player.job,
                             player.id AS player_id,
                             player.last_play,
                             player.skill_group,
			     player.score_pve,
                             player_index.empire

                             FROM player.player
                             LEFT JOIN account.account
                             ON account.id = player.account_id               
                             LEFT JOIN player.player_index
                             ON player_index.id = account.id

                             WHERE account.status != 'BLOCK'
                             AND ( not (name like '[GM]%'))
                             AND ( not (name like '[TGM]%'))
                             AND ( not (name like '[Admin]%'))
                             AND ( not (name like '[TM]%'))
                             AND ( not (name like '[SGM]%'))
                             AND player.name NOT IN(SELECT mName FROM common.gmlist)

                             ORDER BY score_pve DESC, level DESC, exp DESC";
        $Parametres_Classement_Joueur = $this->objConnection->query($Classement_Joueur);
        $Parametres_Classement_Joueur->setFetchMode(\PDO::FETCH_OBJ);
        $Nombre_De_Resultat = $Parametres_Classement_Joueur->rowCount();
        /* -------------------------------------------------------------------------- */

        while ($Donnees_Classement_Joueurs = $Parametres_Classement_Joueur->fetch()) {

            $Index_Recherche++;

            if ($Donnees_Classement_Joueurs->name == $Perso_A_Chercher) {

                break;
            }
        }
        ?>
        <?php if ($Nombre_De_Resultat == $Index_Recherche) { ?>

            <tr><td colspan="8"> Aucun résultats</td></tr>

        <?php } else { ?>

            <?php
            $Index_Recherche_Decale = ($Index_Recherche - 4);

            /* ------------------------------ Vérification connecte ---------------------------------------------- */
            $Verification_Connecte = "SELECT id FROM player.player
                          WHERE player.id = ?
                          AND player.last_play >= (NOW() - INTERVAL 10 MINUTE)
                          LIMIT 1";
            $Parametres_Verification_Connecte = $this->objConnection->prepare($Verification_Connecte);
            /* -------------------------------------------------------------------------------------------------- */

            /* ------------------------ Classement Joueur Recherche -------------------------------- */
            $Classement_Joueur_Rechercher = "SELECT player.name,
                                        player.job,
                                        player.exp,
                                        player.level,
                                        player.id AS player_id,
                                        player.last_play,
                                        player.skill_group,
                                        player_index.empire,
					player.victimes_pvp,
                                        player.score_pve,
                                        account.id

                                        FROM player.player
                                        LEFT JOIN account.account
                                        ON account.id = player.account_id               
                                        LEFT JOIN player.player_index
                                        ON player_index.id = account.id

                                        WHERE account.status != 'BLOCK'
                                        AND ( not (name like '[GM]%'))
                                        AND ( not (name like '[TGM]%'))
                                        AND ( not (name like '[Admin]%'))
                                        AND ( not (name like '[TM]%'))
                                        AND ( not (name like '[SGM]%'))
                                        AND player.name NOT IN(SELECT mName FROM common.gmlist)

                                        ORDER BY score_pve DESC, level DESC, exp DESC
                                        LIMIT " . $Index_Recherche_Decale . ", 10";

            $Parametres_Classement_Joueur_Rechercher = $this->objConnection->query($Classement_Joueur_Rechercher);
            $Parametres_Classement_Joueur_Rechercher->setFetchMode(\PDO::FETCH_OBJ);
            /* ------------------------------------------------------------------------------------------- */
            ?>

            <?php while ($Donnees_Classement_Joueurs_Recherche = $Parametres_Classement_Joueur_Rechercher->fetch()) { ?> 

                <?php if ($Donnees_Classement_Joueurs_Recherche->name == $Perso_A_Chercher) { ?>
                    <tr id="Ligne_Joueur_Trouve">

                    <script type="text/javascript">
                        document.getElementById('Ligne_Joueur_Trouve').style.backgroundColor = '#666666';
                    </script>
                <?php } else { ?>
                    <tr>
                    <?php } ?>
                    <td align="center">
                        <?php echo ($Index_Recherche - 5); ?>
                    </td>

                    <td>
                        <?php if ($Donnees_Classement_Joueurs_Recherche->job == "0") { ?> 
                            <img class="Dimension_Image_Classement" src="images/races/0_mini.png"/>
                        <?php } else if ($Donnees_Classement_Joueurs_Recherche->job == "1") { ?> 
                            <img class="Dimension_Image_Classement" src="images/races/1_mini.png"/>
                        <?php } else if ($Donnees_Classement_Joueurs_Recherche->job == "2") { ?> 
                            <img  class="Dimension_Image_Classement" src="images/races/2_mini.png"/>
                        <?php } else if ($Donnees_Classement_Joueurs_Recherche->job == "3") { ?> 
                            <img class="Dimension_Image_Classement" src="images/races/3_mini.png"/>
                        <?php } else if ($Donnees_Classement_Joueurs_Recherche->job == "4") { ?> 
                            <img class="Dimension_Image_Classement" src="images/races/4_mini.png"/>
                        <?php } else if ($Donnees_Classement_Joueurs_Recherche->job == "5") { ?> 
                            <img class="Dimension_Image_Classement" src="images/races/5_mini.png"/>
                        <?php } else if ($Donnees_Classement_Joueurs_Recherche->job == "6") { ?> 
                            <img class="Dimension_Image_Classement" src="images/races/6_mini.png"/>
                        <?php } else if ($Donnees_Classement_Joueurs_Recherche->job == "7") { ?> 
                            <img class="Dimension_Image_Classement" src="images/races/7_mini.png"/>
                        <?php } ?>
                    </td>

                    <td style="text-indent: 5px;">
                        <?php echo $Donnees_Classement_Joueurs_Recherche->name; ?>
                    </td>
                    <td>
                        <?php echo $Donnees_Classement_Joueurs_Recherche->level; ?>
                    </td>
                    <td  class="hidden-md hidden-sm hidden-xs">
                        <?php echo $Donnees_Classement_Joueurs_Recherche->exp; ?>
                    </td>

                    <td>
                        <?php if ($Donnees_Classement_Joueurs_Recherche->job == 0) { ?>
                            <?php if ($Donnees_Classement_Joueurs_Recherche->skill_group == 1) { ?>
                                Corps à Corps
                            <?php } elseif ($Donnees_Classement_Joueurs_Recherche->skill_group == 2) { ?>
                                Mental
                            <?php } else { ?>
                                Non-définie
                            <?php } ?>	
                        <?php } elseif ($Donnees_Classement_Joueurs_Recherche->job == 1) { ?>
                            <?php if ($Donnees_Classement_Joueurs_Recherche->skill_group == 1) { ?>
                                Assasin
                            <?php } elseif ($Donnees_Classement_Joueurs_Recherche->skill_group == 2) { ?>
                                Archer
                            <?php } else { ?>
                                Non-définie
                            <?php } ?>
                        <?php } elseif ($Donnees_Classement_Joueurs_Recherche->job == 2) { ?>
                            <?php if ($Donnees_Classement_Joueurs_Recherche->skill_group == 1) { ?>
                                Arme magique
                            <?php } elseif ($Donnees_Classement_Joueurs_Recherche->skill_group == 2) { ?>
                                Magie Noir
                            <?php } else { ?>
                                Non-définie
                            <?php } ?>
                        <?php } elseif ($Donnees_Classement_Joueurs_Recherche->job == 3) { ?>
                            <?php if ($Donnees_Classement_Joueurs_Recherche->skill_group == 1) { ?>
                                Dragon
                            <?php } elseif ($Donnees_Classement_Joueurs_Recherche->skill_group == 2) { ?>
                                Soin
                            <?php } else { ?>
                                Non-définie
                            <?php } ?>
                        <?php } elseif ($Donnees_Classement_Joueurs_Recherche->job == 4) { ?>
                            <?php if ($Donnees_Classement_Joueurs_Recherche->skill_group == 1) { ?>
                                CàC
                            <?php } elseif ($Donnees_Classement_Joueurs_Recherche->skill_group == 2) { ?>
                                Mental
                            <?php } else { ?>
                                Non-définie
                            <?php } ?>	
                        <?php } elseif ($Donnees_Classement_Joueurs_Recherche->job == 5) { ?>
                            <?php if ($Donnees_Classement_Joueurs_Recherche->skill_group == 1) { ?>
                                Assasin
                            <?php } elseif ($Donnees_Classement_Joueurs_Recherche->skill_group == 2) { ?>
                                Archer
                            <?php } else { ?>
                                Non-définie
                            <?php } ?>
                        <?php } elseif ($Donnees_Classement_Joueurs_Recherche->job == 6) { ?>
                            <?php if ($Donnees_Classement_Joueurs_Recherche->skill_group == 1) { ?>
                                AM
                            <?php } elseif ($Donnees_Classement_Joueurs_Recherche->skill_group == 2) { ?>
                                MN
                            <?php } else { ?>
                                Non-définie
                            <?php } ?>
                        <?php } elseif ($Donnees_Classement_Joueurs_Recherche->job == 7) { ?>
                            <?php if ($Donnees_Classement_Joueurs_Recherche->skill_group == 1) { ?>
                                Dragon
                            <?php } elseif ($Donnees_Classement_Joueurs_Recherche->skill_group == 2) { ?>
                                Soin
                            <?php } else { ?>
                                Non-définie
                            <?php } ?>
                        <?php } else { ?>
                            Non-définie
                        <?php } ?>
                    </td>


                    <td>
                        <?php echo $Donnees_Classement_Joueurs_Recherche->score_pve; ?>
                    </td>

                    <td>
                        <?php if ($Donnees_Classement_Joueurs_Recherche->empire == 1) { ?>
                            <i class="text-red material-icons md-icon-map md-20"></i>
                        <?php } else if ($Donnees_Classement_Joueurs_Recherche->empire == 2) { ?>
                            <i class="text-yellow material-icons md-icon-map md-20"></i>
                        <?php } else if ($Donnees_Classement_Joueurs_Recherche->empire == 3) { ?>
                            <i class="text-blue material-icons md-icon-map md-20"></i>
                        <?php } ?>
                    </td>
                    <td>
                        <?php
                        $Parametres_Verification_Connecte->execute(array(
                            $Donnees_Classement_Joueurs_Recherche->player_id));
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

                <?php $Index_Recherche++; ?>

                <?php
            }
        }
    }

}

$class = new ClassementJoueursPvESearch();
$class->run();

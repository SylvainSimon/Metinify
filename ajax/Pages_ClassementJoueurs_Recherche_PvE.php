<?php
include '../configPDO.php';

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
$Parametres_Classement_Joueur = $Connexion->query($Classement_Joueur);
$Parametres_Classement_Joueur->setFetchMode(PDO::FETCH_OBJ);
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
    $Index_Recherche_Decale = ($Index_Recherche - 6);

    /* ------------------------------ Vérification connecte ---------------------------------------------- */
    $Verification_Connecte = "SELECT id FROM player.player
                          WHERE player.id = ?
                          AND player.last_play >= (NOW() - INTERVAL 10 MINUTE)
                          LIMIT 1";
    $Parametres_Verification_Connecte = $Connexion->prepare($Verification_Connecte);
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

                                        ORDER BY level DESC, exp DESC, victimes_pvp DESC
                                        LIMIT " . $Index_Recherche_Decale . ", 20";

    $Parametres_Classement_Joueur_Rechercher = $Connexion->query($Classement_Joueur_Rechercher);
    $Parametres_Classement_Joueur_Rechercher->setFetchMode(PDO::FETCH_OBJ);
    /* ------------------------------------------------------------------------------------------- */
    ?>

    <?php while ($Donnees_Classement_Joueurs_Recherche = $Parametres_Classement_Joueur_Rechercher->fetch()) { ?> 

        <?php if ($Donnees_Classement_Joueurs_Recherche->name == $Perso_A_Chercher) { ?>
            <tr id="Ligne_Joueur_Trouve">

            <script type="text/javascript">                               
                document.getElementById('Ligne_Joueur_Trouve').style.backgroundColor='#666666';
            </script>
        <?php } else { ?>
            <tr onmouseover="this.style.backgroundColor='#666666';" onmouseout="this.style.backgroundColor='transparent';">
            <?php } ?>
            <td align="center" class="Colonne_Numero_Classement">
                <?php echo ($Index_Recherche - 5); ?>
            </td>
            <td style="text-indent: 5px;">
                <?php echo $Donnees_Classement_Joueurs_Recherche->name; ?>
            </td>
            <td>
                <?php echo $Donnees_Classement_Joueurs_Recherche->level; ?>
            </td>
            <td>
                <?php echo $Donnees_Classement_Joueurs_Recherche->exp; ?>
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

            <td class="Align_center">
                <?php if ($Donnees_Classement_Joueurs_Recherche->empire == 1) { ?>
                    <img class="Dimension_Image_Classement Deplacement_Drapeau" src="images/empire/red.jpg"/> 
                <?php } else if ($Donnees_Classement_Joueurs_Recherche->empire == 2) { ?>
                    <img class="Dimension_Image_Classement Deplacement_Drapeau" src="images/empire/yellow.jpg"/> 
                <?php } else if ($Donnees_Classement_Joueurs_Recherche->empire == 3) { ?>
                    <img class="Dimension_Image_Classement Deplacement_Drapeau" src="images/empire/blue.jpg"/>
                <?php } ?>

            </td>
            <?php
            $Parametres_Verification_Connecte->execute(array(
                $Donnees_Classement_Joueurs_Recherche->player_id));
            $Parametres_Verification_Connecte->setFetchMode(PDO::FETCH_OBJ);
            $Resultat_Verification_Connecte = $Parametres_Verification_Connecte->rowCount();
            ?>
            <?php if ($Resultat_Verification_Connecte != "1") { ?>
                <td title="Hors-ligne" class="Align_Right Deplacement_Drapeau ">
                    <img class="Ombre_Grise" src="images/offline.gif" />
                </td>
            <?php } else { ?>
                <td title="En ligne" class="Align_Right Deplacement_Drapeau">
                    <img class="Ombre_Grise" src="images/online.gif" />

                </td>
            <?php } ?>
        </tr>

        <?php $Index_Recherche++; ?>

        <?php
    }
    ?>
<?php } ?>
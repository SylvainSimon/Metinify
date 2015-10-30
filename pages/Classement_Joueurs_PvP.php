<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include '../configPDO.php'; ?>

<?php
$Numero_De_Page = 0;

/* ------------------------------ Vérification connecte ---------------------------------------------- */
$Verification_Connecte = "SELECT id FROM player.player
                          WHERE player.id = ?
                          AND player.last_play >= (NOW() - INTERVAL 10 MINUTE)
                          LIMIT 1";
$Parametres_Verification_Connecte = $Connexion->prepare($Verification_Connecte);
/* -------------------------------------------------------------------------------------------------- */

/* ------------------------ Classement Joueur ---------------------------- */
$Classement_Joueur = "SELECT player.name,
                             player.id AS player_id,
                             player.job,
                             player.exp,
                             player.level,
                             player.skill_group,
                             player_index.empire,
					 		 player.victimes_pvp,
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

                             ORDER BY victimes_pvp DESC, level DESC, exp DESC
                             LIMIT 0,20";
$Parametres_Classement_Joueur = $Connexion->query($Classement_Joueur);
$Parametres_Classement_Joueur->setFetchMode(PDO::FETCH_OBJ);
/* -------------------------------------------------------------------------- */

/* ------------------------------ Comptage joueur ------------------------------- */
$Comptage_Joueurs = "SELECT id FROM player.player";
$Parametres_Comptage_Joueurs = $Connexion->query($Comptage_Joueurs);
$Nombre_De_Joueurs = $Parametres_Comptage_Joueurs->rowCount();
/* --------------------------------------------------------------------------------- */

$nombredePage = (($Nombre_De_Joueurs / 20) - 1);
$i = $Numero_De_Page + 1;
?>
<div class="Cadre_Principal">

    <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
        <h1>Classement map pvp des joueurs</h1>
    </div>
    <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1"> 
        <script type="text/javascript">
        
            function Recherche_Joueurs(){
            
                Barre_De_Statut("Recherche du joueur en cours...");
                Icone_Chargement(1);
                
                $.ajax({
                    type: "POST",
                    url: "ajax/Pages_ClassementJoueurs_Recherche.php",
                    data: "recherche="+$("#SaisieRecherche").val(),
                    success: function(msg){
                    
                        $("#pagedeclassement").fadeOut("slow", function(){
                            $("#pagedeclassement").html(msg);
                            Barre_De_Statut("Recherche terminé.");
                            Icone_Chargement(0);
                            $("#pagedeclassement").fadeIn("slow");
                        });

                    }
                });
                return false;

            }
    
        </script>
        <hr class="Hr_Haut"/>
        <form action="javascript:void(0);" class="Formulaire_Recherche_Joueur">

            <input type="text" class="Zone_Saisie_Recherche_Joueur" autofocus="autofocus" placeholder="Pseudo du joueur..." id="SaisieRecherche"/>
            &nbsp;
            <input type="submit" class="Bouton_Formulaire_Recherche_Joueur Bouton_Normal" src="images/Bouton_Rechercher.png" onclick="if(document.getElementById('SaisieRecherche').value != ''){ Recherche_Joueurs(); }" value="Rechercher"/>

        </form>
        <hr class="Hr_Bas">

        <div id="Changement_de_Page">
            <div>
                <div class="Position_Bouton_Precedent Bold">
                    <?php if ($Numero_De_Page >= 1) { ?>
                        <a href="javascript:void(0)" onclick="Ajax_Classement('ajax/Pages_ClassementJoueurs.php?page=<?php echo ($Numero_De_Page - 1); ?>')"><= Précédente</a>
                    <?php } else { ?>
                        <= Précédente
                    <?php } ?>
                </div>

                <div class="Position_Bouton_Suivant Bold">
                    <?php if ($Numero_De_Page <= $nombredePage) {
                        ?>
                        <a href="javascript:void(0)" onclick="Ajax_Classement('ajax/Pages_ClassementJoueurs.php?page=<?php echo ($Numero_De_Page + 1); ?>')">Suivante =></a>
                    <?php } else { ?>
                        Suivante =>
                    <?php } ?>
                </div>
            </div>
            <hr class="Hr_Bas">

            <table class="Table_Classement_Joueur"> 
                <thead>
                    <tr>
                        <th align="center" class="Colonne_Numero_Classement">N°</th>
                        <th style="text-indent: 5px;" class="Align_Left" >Pseudo</th>
                        <th class="Align_Left">Level</th>
                        <th class="Align_Left">Experience</th>
                        <th class="Align_Left">Race</th>
                        <th class="Align_Left">Classe</th>
                        <th class="Align_Left">Score</th>
                        <th class="Align_center">Royaume</th>
                        <th class="Align_Right">Status</th>
                    </tr>
                </thead>
                <tbody id="pagedeclassement">

                    <?php while ($Donnees_Classement_Joueurs = $Parametres_Classement_Joueur->fetch()) { ?>

                        <tr onmouseover="this.style.backgroundColor='#555555';" onmouseout="this.style.backgroundColor='transparent';">
                            <td align="center" class="Colonne_Numero_Classement">
                                <?php if ($i == 1) { ?>
                                    <img src="images/rang/or.png"/>
                                <?php } else if ($i == 2) { ?>
                                    <img src="images/rang/argent.png"/>
                                <?php } else if ($i == 3) { ?>
                                    <img src="images/rang/bronze.png"/>
                                <?php } else if ($i == 4) { ?>
                                    <img src="images/rang/Medaille_Or.png"/>
                                <?php } else if ($i == 5) { ?>
                                    <img src="images/rang/Medaille_Argent.png"/>
                                <?php } else if ($i == 6) { ?>
                                    <img src="images/rang/Medaille_Bronze.png"/>
                                <?php } else { ?>
                                    <?php echo $i; ?>
                                <?php } ?>
                            </td>

                            <td style="text-indent: 5px;">
                                <?php echo $Donnees_Classement_Joueurs->name; ?>
                            </td>
                            <td>
                                <?php echo $Donnees_Classement_Joueurs->level; ?>
                            </td>
                            <td>
                                <?php echo $Donnees_Classement_Joueurs->exp; ?>
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
                                <?php echo $Donnees_Classement_Joueurs->victimes_pvp; ?>
                            </td>
							
                            <td class="Align_center">
                                <?php if ($Donnees_Classement_Joueurs->empire == 1) { ?>
                                    <img class="Dimension_Image_Classement Deplacement_Drapeau" src="images/empire/red.jpg"/> 
                                <?php } else if ($Donnees_Classement_Joueurs->empire == 2) { ?>
                                    <img class="Dimension_Image_Classement Deplacement_Drapeau" src="images/empire/yellow.jpg"/> 
                                <?php } else if ($Donnees_Classement_Joueurs->empire == 3) { ?>
                                    <img class="Dimension_Image_Classement Deplacement_Drapeau" src="images/empire/blue.jpg"/>
                                <?php } ?>
                            </td>

                            <?php
                            $Parametres_Verification_Connecte->execute(array(
                            $Donnees_Classement_Joueurs->player_id));
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
                        <?php $i++; ?>

                    <?php } ?>
                </tbody>
            </table>
            
            <hr class="Hr_Haut"/>
            <div class="Position_SuivantPrecedent_BasClassement">
                <div class="Position_Bouton_Precedent Bold">
                    <?php if ($Numero_De_Page >= 1) { ?>
                        <a href="javascript:void(0)" onclick="Ajax_Classement('ajax/Pages_ClassementJoueurs.php?page=<?php echo ($Numero_De_Page - 1); ?>')"><= Précédente</a>
                    <?php } else { ?>
                        <= Précédente
                    <?php } ?>
                </div>
                <div class="Position_Bouton_Suivant Bold">
                    <?php if ($Numero_De_Page <= $nombredePage) {
                        ?>
                        <a href="javascript:void(0)" onclick="Ajax_Classement('ajax/Pages_ClassementJoueurs.php?page=<?php echo ($Numero_De_Page + 1); ?>')">Suivante =></a>
                    <?php } else { ?>
                        Suivante =>
                    <?php } ?>
                </div>

            </div>
            <hr class="Hr_Bas">
        </div>
    </div>
</div>
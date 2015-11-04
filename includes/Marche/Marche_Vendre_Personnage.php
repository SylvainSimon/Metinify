<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class Marche_Vendre_Personnage extends \PageHelper {

    public $isProtected = true;
    
    public function run() {
        ?>
        <?php include '../../pages/Tableaux_Arrays.php'; ?>
        
        <?php if (!empty($_SESSION['ID'])) { ?>
            <?php
            /* ------------------------ Recuperation Compte ----------------------------- */
            $Liste_Personnages = "SELECT player.name,
                                 player.id,
                                 player.level,
                                 player.job,
                                 player.skill_group
                          FROM player.player
                          WHERE player.account_id = ?
                          ORDER by level DESC
                          LIMIT 4";
            $Parametres_Liste_Personnages = $this->objConnection->prepare($Liste_Personnages);
            $Parametres_Liste_Personnages->execute(array($_SESSION["ID"]));
            $Parametres_Liste_Personnages->setFetchMode(\PDO::FETCH_OBJ);
            $Nombre_De_Resultat = $Parametres_Liste_Personnages->rowCount();

            /* -------------------------------------------------------------------------- */
            ?>
            <table id="Tableau_Personnages" class="box_shadows">
                <thead>
                    <tr>
                        <th width="50">Race</th>
                        <th width="130">Pseudonyme</th>
                        <th width="60">Classe</th>
                        <th width="30">Lvl</th>
                    </tr>

                </thead>

                <tbody>

                    <?php if ($Nombre_De_Resultat != 0) { ?>

                        <?php while ($Resultat_Liste_Personnages = $Parametres_Liste_Personnages->fetch()) { ?>

                            <tr title="Choisir ce personnage" onclick="Chargement_Formulaire_Vente(<?= $Resultat_Liste_Personnages->id; ?>)" class="Pointer" onmouseover="this.style.backgroundColor = '#333333';" onmouseout="this.style.backgroundColor = 'transparent';">
                                <td align="center">
                                    <?php if ($Resultat_Liste_Personnages->job == "0") { ?> 
                                        <img class="cadrephotoclassement" src="../../images/races/0_mini.png" height="25"/>
                                    <?php } else if ($Resultat_Liste_Personnages->job == "1") { ?> 
                                        <img class="cadrephotoclassement" src="../../images/races/1_mini.png" height="25"/>
                                    <?php } else if ($Resultat_Liste_Personnages->job == "2") { ?> 
                                        <img class="cadrephotoclassement" src="../../images/races/2_mini.png" height="25"/>
                                    <?php } else if ($Resultat_Liste_Personnages->job == "3") { ?> 
                                        <img class="cadrephotoclassement" src="../../images/races/3_mini.png" height="25"/>
                                    <?php } else if ($Resultat_Liste_Personnages->job == "4") { ?> 
                                        <img class="cadrephotoclassement" src="../../images/races/4_mini.png" height="25"/>
                                    <?php } else if ($Resultat_Liste_Personnages->job == "5") { ?> 
                                        <img class="cadrephotoclassement" src="../../images/races/5_mini.png" height="25"/>
                                    <?php } else if ($Resultat_Liste_Personnages->job == "6") { ?> 
                                        <img class="cadrephotoclassement" src="../../images/races/6_mini.png" height="25"/>
                                    <?php } else if ($Resultat_Liste_Personnages->job == "7") { ?> 
                                        <img class="cadrephotoclassement" src="../../images/races/7_mini.png" height="25"/>
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php echo $Resultat_Liste_Personnages->name ?>
                                </td>
                                <td>

                                    <?php if ($Resultat_Liste_Personnages->job == 0) { ?>
                                        <?php if ($Resultat_Liste_Personnages->skill_group == 1) { ?>
                                            Corps à Corps
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

            <div id="Explication_Vendre_Personnage" class="Explication_Vendre_Personnage">
                - Ici vous pouvez vendre votre personnage contre des monnaies.<br/>
                - Le personnage sera détaché de votre compte.<br/>
                - Il sera remplacé par un personnage factice jusqu'à la vente.<br/>
                - Votre personnage sera placé sur la place du marché.<br/>
                - Lorsqu'un utilisateur fait l'acquisition de votre personnage,
                il est transféré vers son compte ainsi que l'équipement et l'inventaire.<br/>
                - Le royaume du personnage est celui du compte.<br/>
                - Le prix minimum est de 2 000 Vamonaies ou 2 000 Tananaies.<br/>
                - Ce personnage ne doit pas être marié et sans guilde.<br />
            </div>

            <div id="Zone_Formulaire_Vendre_Personnage" class="Zone_Formulaire_Vendre_Personnage">

                <div id="Contenue_Cadre_Vente">
                    <div class="Message_Formulaire_Vendre_Personnage">
                        <= Pour commencer, séléctionnez le personnage que vous désirez mettre en vente.
                    </div>
                </div>

            </div>

            <script type="text/javascript">

                function Chargement_Formulaire_Vente(id_personnage) {

                    window.parent.Barre_De_Statut("Création du formulaire...");
                    window.parent.Icone_Chargement(1);

                    $.ajax({
                        type: "POST",
                        url: "SQL_Recuperer_Formulaire_Vendre_Personnage.php",
                        data: "id_personnage=" + id_personnage,
                        success: function (msg) {
                            if (msg == 0) {

                                window.parent.Barre_De_Statut("Ce personnage ne vous appartient pas.");
                                window.parent.Icone_Chargement(2);

                            } else {

                                $("#Contenue_Cadre_Vente").fadeOut("medium", function () {
                                    $("#Contenue_Cadre_Vente").html(msg);
                                    window.parent.Barre_De_Statut("Formulaire généré.");
                                    window.parent.Icone_Chargement(0);
                                    $("#Contenue_Cadre_Vente").fadeIn("medium");
                                });
                            }
                        }
                    });
                    return false;

                }

            </script>

        <?php } else { ?>

            <?php include 'Marche_Non_Connecter.php'; ?>

        <?php } ?>
        <?php
    }

}

$class = new Marche_Vendre_Personnage();
$class->run();

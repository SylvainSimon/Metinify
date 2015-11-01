<div class="tab-pane" id="Onglet_Equitation">

    <?php if ($Donnees_Appel_Joueurs_Page->horse_level == 0) { ?>

        Ce perssonage ne possède pas de cheval.

    <?php } else { ?>

        <table id="Tableau_Personnage_Cheval">
            <tr>
                <th colspan="2">Information générales :</th>
            </tr>
            <?php
            $Horse_Level = $Donnees_Appel_Joueurs_Page->horse_level;
            ?>
            <tr>
                <td class="Colonne_Gauche">Niveau :</td></td>
                <td><?php echo $Horse_Level; ?></td>
            </tr>
            <tr>
                <td class="Colonne_Gauche">Type de cheval :</td></td>
                <?php if ($Horse_Level > 0 && $Horse_Level < 12) { ?>
                    <td>Poney</td>
                <?php } else if ($Horse_Level > 11 && $Horse_Level < 21) { ?>
                    <td>Cheval de combat</td>
                <?php } else if ($Horse_Level > 20) { ?>
                    <td>Cheval militaire</td>
                <?php } ?>
            </tr>
            <tr>
                <td class="Colonne_Gauche">Endurance :</td></td>
                <td><?php echo $Donnees_Appel_Joueurs_Page->horse_hp; ?></td>
            </tr>
            <tr>
                <td class="Colonne_Gauche">Faim :</td></td>
                <td><?php echo $Donnees_Appel_Joueurs_Page->horse_stamina; ?></td>
            </tr>
            <tr>
                <td class="Colonne_Gauche">Etat :</td></td>
                <?php if ($Donnees_Appel_Joueurs_Page->horse_riding == 1) { ?>
                    <td>En service.</td>
                <?php } else { ?>
                    <td>A l'écurie.</td>
                <?php } ?>
            </tr>

        </table>

        <div class="Affichage_Cheval" align="center">

            <?php
            /* ----------------------------------------------- Verif Chef Guilde -------------------------------------------- */
            $Verif_Chef_Guilde = "SELECT id
                                          FROM player.guild
                                          WHERE guild.master = '" . $Donnees_Appel_Joueurs_Page->player_id . "'
                                          LIMIT 1";

            $Parametres_Verif_Chef_Guilde = $Connexion->query($Verif_Chef_Guilde);
            $Parametres_Verif_Chef_Guilde->setFetchMode(PDO::FETCH_OBJ);
            $Nombre_De_Resultat_Verif_Chef_Guilde = $Parametres_Verif_Chef_Guilde->rowCount();
            /* ----------------------------------------------------------------------------------------------------- */

            if ($Nombre_De_Resultat_Verif_Chef_Guilde == 0) {

                $Chef_de_Guilde = false;
            } else {

                $Chef_de_Guilde = true;
            }
            ?>

            <?php if ($Chef_de_Guilde == true) { ?>

                <?php if ($Horse_Level > 0 && $Horse_Level < 12) { ?>
                    <img src="../images/chevaux/Cheval_1_Chef.png"/>
                <?php } else if ($Horse_Level > 11 && $Horse_Level < 21) { ?>
                    <img src="../images/chevaux/Cheval_11_Chef.png"/>
                <?php } else if ($Horse_Level > 20) { ?>
                    <img src="../images/chevaux/Cheval_21_Chef.png"/>
                <?php } ?>

            <?php } else { ?>

                <?php if ($Donnees_Appel_Joueurs_Page->guild_name == "") { ?>

                    <?php if ($Horse_Level > 0 && $Horse_Level < 12) { ?>
                        <img src="../images/chevaux/Cheval_1_Sans_Guilde.png"/>
                    <?php } else if ($Horse_Level > 11 && $Horse_Level < 21) { ?>
                        <img src="../images/chevaux/Cheval_11_Sans_Guilde.png"/>
                    <?php } else if ($Horse_Level > 20) { ?>
                        <img src="../images/chevaux/Cheval_21_Sans_Guilde.png"/>
                    <?php } ?>

                <?php } else { ?>
                    <?php if ($Horse_Level > 0 && $Horse_Level < 12) { ?>
                        <img src="../images/chevaux/Cheval_1_Membre.png"/>
                    <?php } else if ($Horse_Level > 11 && $Horse_Level < 21) { ?>
                        <img src="../images/chevaux/Cheval_11_Membre.png"/>
                    <?php } else if ($Horse_Level > 20) { ?>
                        <img src="../images/chevaux/Cheval_21_Membre.png"/>
                    <?php } ?>
                <?php } ?>
            <?php } ?>

        </div>

    <?php } ?>
</div>
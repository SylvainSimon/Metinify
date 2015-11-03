<div class="tab-pane" id="Onglet_Equitation">

    <?php if ($Donnees_Appel_Joueurs_Page->horse_level == 0) { ?>
        Ce perssonage ne possède pas de cheval.
    <?php } else { ?>

        <div class="row">
            <div class="col-lg-4">

                    <table class="table table-condensed" style="border-collapse: collapse; margin-bottom: 0px;">
  
                    <?php
                    $Horse_Level = $Donnees_Appel_Joueurs_Page->horse_level;
                    ?>
                    <tr>
                        <td style="border-top: 0px;" class="Colonne_Gauche">Niveau :</td></td>
                        <td style="border-top: 0px;"><?php echo $Horse_Level; ?></td>
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

            </div>
            <div class="col-lg-8" style="text-align: center;">
                    <?php
                    /* ----------------------------------------------- Verif Chef Guilde -------------------------------------------- */
                    $Verif_Chef_Guilde = "SELECT id
                                          FROM player.guild
                                          WHERE guild.master = '" . $Donnees_Appel_Joueurs_Page->player_id . "'
                                          LIMIT 1";

                    $Parametres_Verif_Chef_Guilde = $this->objConnection->query($Verif_Chef_Guilde);
                    $Parametres_Verif_Chef_Guilde->setFetchMode(\PDO::FETCH_OBJ);
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
                            <img src="../images/chevaux/Cheval_1_Chef.png" style="width: 90%; height: auto;" />
                        <?php } else if ($Horse_Level > 11 && $Horse_Level < 21) { ?>
                            <img src="../images/chevaux/Cheval_11_Chef.png" style="width: 90%; height: auto;"/>
                        <?php } else if ($Horse_Level > 20) { ?>
                            <img src="../images/chevaux/Cheval_21_Chef.png" style="width: 90%; height: auto;"/>
                        <?php } ?>

                    <?php } else { ?>

                        <?php if ($Donnees_Appel_Joueurs_Page->guild_name == "") { ?>

                            <?php if ($Horse_Level > 0 && $Horse_Level < 12) { ?>
                                <img src="../images/chevaux/Cheval_1_Sans_Guilde.png" style="width: 90%; height: auto;"/>
                            <?php } else if ($Horse_Level > 11 && $Horse_Level < 21) { ?>
                                <img src="../images/chevaux/Cheval_11_Sans_Guilde.png" style="width: 90%; height: auto;"/>
                            <?php } else if ($Horse_Level > 20) { ?>
                                <img src="../images/chevaux/Cheval_21_Sans_Guilde.png" style="width: 90%; height: auto;"/>
                            <?php } ?>

                        <?php } else { ?>
                            <?php if ($Horse_Level > 0 && $Horse_Level < 12) { ?>
                                <img src="../images/chevaux/Cheval_1_Membre.png" style="width: 90%; height: auto;"/>
                            <?php } else if ($Horse_Level > 11 && $Horse_Level < 21) { ?>
                                <img src="../images/chevaux/Cheval_11_Membre.png" style="width: 90%; height: auto;"/>
                            <?php } else if ($Horse_Level > 20) { ?>
                                <img src="../images/chevaux/Cheval_21_Membre.png" style="width: 90%; height: auto;"/>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>
<div class="tab-pane" id="Historiques_Achats">

    <?php
    /* ----------------------------------------------- Liste rechargements -------------------------------------------- */
    $Liste_Achats = "SELECT log_achats.id,
                               log_achats.date,
                               log_achats.ip,
                               log_achats.prix,
                               log_achats.monnaie,
                               log_achats.quantite,
                               log_achats.vnum_item,
                               log_achats.item
                        FROM site.log_achats
                        WHERE id_compte = '" . $Resultat_Appel_Compte->id . "'
                        ORDER by date DESC";

    $Parametres_Liste_Achats = $Connexion->query($Liste_Achats);
    $Parametres_Liste_Achats->setFetchMode(PDO::FETCH_OBJ);
    $Nombre_De_Resultat_Liste_Achats = $Parametres_Liste_Achats->rowCount();
    /* ------------------------------------------------------------------------------------------------------- */

    /* -------------------------- Somme VamoNaies ------------------------------ */
    $Somme_Depenses = "SELECT SUM(log_achats.prix) AS nombre
                        FROM site.log_achats
                        WHERE id_compte = '" . $Resultat_Appel_Compte->id . "'
                        AND monnaie = 1";

    $Parametres_Somme_Depenses = $Connexion->query($Somme_Depenses);
    $Parametres_Somme_Depenses->setFetchMode(PDO::FETCH_OBJ);
    $Resultat_Somme_Depenses = $Parametres_Somme_Depenses->fetch();
    /* ----------------------------------------------------------------------------- */

    /* -------------------------- Somme VamoNaies ------------------------------ */
    $Somme_Depenses_Tan = "SELECT SUM(log_achats.prix) AS nombre
                        FROM site.log_achats
                        WHERE id_compte = '" . $Resultat_Appel_Compte->id . "'
                        AND monnaie = 2";

    $Parametres_Somme_Depenses_Tan = $Connexion->query($Somme_Depenses_Tan);
    $Parametres_Somme_Depenses_Tan->setFetchMode(PDO::FETCH_OBJ);
    $Resultat_Somme_Depenses_Tan = $Parametres_Somme_Depenses_Tan->fetch();
    /* ----------------------------------------------------------------------------- */
    ?>

    <div class="row">
        <div class="col-lg-4">
            <table class="table table-condensed" style="border-collapse: collapse; margin-bottom: 0px;">
                <tr>
                    <td style="border-top: 0px;" title="Nombres de paiements que vous avez effectué" class="Colonne_Gauche">Nombre d'achats :</td>
                    <td style="border-top: 0px;"><?= $Nombre_De_Resultat_Liste_Achats; ?></td>
                </tr>
                <tr>
                    <td title="Totalité des Vamonaies que vous avez gagné" class="Colonne_Gauche">Vamonaies dépensés :</td>
                    <td><?= $Resultat_Somme_Depenses->nombre; ?></td>
                </tr>
                <tr>
                    <td title="Totalité des Vamonaies que vous avez gagné" class="Colonne_Gauche">Tananaies dépensés :</td>
                    <td><?= $Resultat_Somme_Depenses_Tan->nombre; ?></td>
                </tr>
            </table>

        </div>
        <div class="col-lg-8">

            <table class="table table-condensed table-hover" style="border-collapse: collapse; margin-bottom: 0px;">
                <thead>
                    <tr>
                        <th width="40">ID</th>
                        <th width="35">Icone</th>
                        <th>Article</th>
                        <th width="40">Nbre.</th>
                        <th>Prix</th>
                        <th width="200">Date du rechargement</th>
                        <th width="50">Ip</th>

                    </tr>
                </thead>

                <tbody>
                    <?php if ($Nombre_De_Resultat_Liste_Achats > 0) { ?>

                        <?php while ($Resultat_Liste_Achats = $Parametres_Liste_Achats->fetch()) { ?>
                            <tr class="Pointer" onmouseover="this.style.backgroundColor = '#333333';" onmouseout="this.style.backgroundColor = 'transparent';">
                                <td>
                                    <span class="Align_center"><?= $Resultat_Liste_Achats->id; ?></span>
                                </td>
                                <td align="center">
                                    <span ><?= "<img width='25' src=\"../images/items/" . $Resultat_Liste_Achats->vnum_item . ".png\">"; ?></span>
                                </td>
                                <td><?= $Resultat_Liste_Achats->item; ?></td>
                                <td><?= $Resultat_Liste_Achats->quantite; ?></td>
                                <td>
                                    &nbsp;
                                    <?= $Resultat_Liste_Achats->prix; ?>
                                    &nbsp;
                                    <?php if ($Resultat_Liste_Achats->monnaie == "1") { ?>
                                        <img src="../images/rectopiece.png" style="width: 16px; position: relative; top: 3px;" height="16" />
                                    <?php } else { ?>
                                        <img src="../images/versopiece.png" style="width: 16px; position: relative; top: 3px;" height="16" />
                                    <?php } ?>
                                </td>
                                <td><?= Formatage_Date($Resultat_Liste_Achats->date); ?></td>
                                <td><?= $Resultat_Liste_Achats->ip; ?></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr><td colspan="7">Vous n'avez jamais acheter d'article.</td></tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
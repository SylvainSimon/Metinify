<div class="tab-pane" id="Historiques_Paiements">

    <?php
    /* -------------------------- Liste rechargements ------------------------------ */
    $Liste_Paiements = "SELECT logs_rechargements.id,
                               logs_rechargements.date,
                               logs_rechargements.ip,
                               logs_rechargements.email_compte,
                               logs_rechargements.nombre_vamonaies
                        FROM site.logs_rechargements
                        WHERE id_compte = '" . $Resultat_Appel_Compte->id . "'
                        AND compte != ''
                        ORDER by date DESC";

    $Parametres_Liste_Paiements = $Connexion->query($Liste_Paiements);
    $Parametres_Liste_Paiements->setFetchMode(PDO::FETCH_OBJ);
    $Nombre_De_Resultat_Liste_Paiements = $Parametres_Liste_Paiements->rowCount();
    /* ----------------------------------------------------------------------------- */

    /* -------------------------- Somme VamoNaies ------------------------------ */
    $Somme_VamoNaies = "SELECT SUM(nombre_vamonaies) AS nombre
                        FROM site.logs_rechargements
                        WHERE id_compte = '" . $Resultat_Appel_Compte->id . "'
                        AND compte != ''";

    $Parametres_Somme_VamoNaies = $Connexion->query($Somme_VamoNaies);
    $Parametres_Somme_VamoNaies->setFetchMode(PDO::FETCH_OBJ);
    $Resultat_Somme_VamoNaies = $Parametres_Somme_VamoNaies->fetch()
    /* ----------------------------------------------------------------------------- */
    ?>

    <div class="row">
        <div class="col-lg-4">
            <table class="table table-condensed" style="border-collapse: collapse;">
                <tr>
                    <td style="border-top: 0px;">
                        <span data-tooltip="Nombres de paiements que vous avez effectué"  data-tooltip-position="right">
                            Nombre de paiement
                        </span>
                    </td>
                    <td style="border-top: 0px;">
                        <span class="pull-right">
                            <?= $Nombre_De_Resultat_Liste_Paiements; ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span data-tooltip="Total de Vamonaies que vous avez acheté"  data-tooltip-position="right">
                            Total de VamoNaies
                        </span>
                    </td>
                    <td>
                        <span class="pull-right">
                            <?= $Resultat_Somme_VamoNaies->nombre; ?>
                        </span>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-lg-8">

            <div class="Zone_Tableau_Rechargements">

                <table class="table table-condensed table-hover" style="border-collapse: collapse; margin-bottom: 0px;">
                    <thead>
                        <tr>
                            <th width="50" align="center">ID</th>
                            <th width="250">Date du rechargement</th>
                            <th>Email du rechargement</th>
                            <th width="80">VamoNaies</th>
                            <th width="120">Ip</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if ($Nombre_De_Resultat_Liste_Paiements > 0) { ?>
                            <?php while ($Resultat_Liste_Paiements = $Parametres_Liste_Paiements->fetch()) { ?>
                                <tr class="Pointer" onmouseover="this.style.backgroundColor = '#333333';" onmouseout="this.style.backgroundColor = 'transparent';">
                                    <td>
                                        <span class="Align_center"><?php echo $Resultat_Liste_Paiements->id; ?></span>
                                    </td>
                                    <td><?= Formatage_Date($Resultat_Liste_Paiements->date); ?></td>
                                    <td><?= $Resultat_Liste_Paiements->email_compte; ?></td>
                                    <td><?= $Resultat_Liste_Paiements->nombre_vamonaies; ?></td>
                                    <td><?= $Resultat_Liste_Paiements->ip; ?></td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr><td colspan="5">Vous n'avez jamais rechargé votre compte.</td></tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
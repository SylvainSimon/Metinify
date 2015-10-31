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
    <table id="Tableau_Recapitulatif_Paiement">
        <tr>
            <th colspan="2">Récapitulatif :</th>
        </tr>
        <tr>
            <td title="Nombres de paiements que vous avez effectué" class="Colonne_Gauche">Nombre de paiement<?php if ($Nombre_De_Resultat_Liste_Paiements > 1) { ?>s<?php } ?> :</td>
            <td><?= $Nombre_De_Resultat_Liste_Paiements; ?></td>
        </tr>
        <tr>
            <td title="Totalité des Vamonaies que vous avez gagné" class="Colonne_Gauche">Total de VamoNaies :</td>
            <td><?= $Resultat_Somme_VamoNaies->nombre; ?></td>
        </tr>
    </table>

    <div class="Zone_Tableau_Rechargements">
        <table id="Tableau_Rechargements">
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
                        <tr class="Pointer" onmouseover="this.style.backgroundColor='#333333';" onmouseout="this.style.backgroundColor='transparent';">
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
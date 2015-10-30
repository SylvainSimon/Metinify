<div id="Onglet_Equipement">

    <?php include 'Appel_Joueurs/Equipement.php'; ?>

    <?php
    /* -------------------------- Preparation des Requetes ------------------------------- */
    $Appel_Case_Equipement = "SELECT item.vnum,
                                         item.count,
                                         item.id AS item_id,
                                         item_proto.locale_name,
                                         item_proto.flag,
                                         item_proto.size
                                  FROM player.item
                                  LEFT JOIN player.item_proto
                                  ON item_proto.vnum = item.vnum
 
                                  WHERE pos = :pos
                                  AND owner_id = :owner_id
                                  AND window = :window
                                  LIMIT 1";

    $Parametres_Appel_Case_Equipement = $Connexion->prepare($Appel_Case_Equipement);

    /* ------------------------------------------------------------------------------------ */

    $Chercher_Chemin = "SELECT item_list.chemin
                                       FROM player.item_list
                                       WHERE item = :item
                                       LIMIT 1";

    $Parametres_Chercher_Chemin = $Connexion->prepare($Chercher_Chemin);
    /* ------------------------------------------------------------------------------------- */
    ?>

    <div id="Equipement">

        <div class="Case_Equipement Case_Arme">
            <?php CheckEquipement(4, $Donnees_Appel_Joueurs_Page->player_id, $Parametres_Appel_Case_Equipement, $Parametres_Chercher_Chemin); ?>
        </div>
        <div class="Case_Equipement Case_Armure">
            <?php CheckEquipement(0, $Donnees_Appel_Joueurs_Page->player_id, $Parametres_Appel_Case_Equipement, $Parametres_Chercher_Chemin); ?>
        </div>
        <div class="Case_Equipement Case_Casque">
            <?php CheckEquipement(1, $Donnees_Appel_Joueurs_Page->player_id, $Parametres_Appel_Case_Equipement, $Parametres_Chercher_Chemin); ?>
        </div>
        <div class="Case_Equipement Case_Bouclier">
            <?php CheckEquipement(10, $Donnees_Appel_Joueurs_Page->player_id, $Parametres_Appel_Case_Equipement, $Parametres_Chercher_Chemin); ?>
        </div>
        <div class="Case_Equipement Case_Bracelet">
            <?php CheckEquipement(3, $Donnees_Appel_Joueurs_Page->player_id, $Parametres_Appel_Case_Equipement, $Parametres_Chercher_Chemin); ?>
        </div>
        <div class="Case_Equipement Case_Boucles">
            <?php CheckEquipement(6, $Donnees_Appel_Joueurs_Page->player_id, $Parametres_Appel_Case_Equipement, $Parametres_Chercher_Chemin); ?>
        </div>
        <div class="Case_Equipement Case_Collier">
            <?php CheckEquipement(5, $Donnees_Appel_Joueurs_Page->player_id, $Parametres_Appel_Case_Equipement, $Parametres_Chercher_Chemin); ?>
        </div>
        <div class="Case_Equipement Case_Chaussure">
            <?php CheckEquipement(2, $Donnees_Appel_Joueurs_Page->player_id, $Parametres_Appel_Case_Equipement, $Parametres_Chercher_Chemin); ?>
        </div>
        <div class="Case_Equipement Case_Fleche">
            <?php CheckEquipement(9, $Donnees_Appel_Joueurs_Page->player_id, $Parametres_Appel_Case_Equipement, $Parametres_Chercher_Chemin); ?>
        </div>

        <div class="Case_Equipement Case_Special1">
            <?php CheckEquipement(7, $Donnees_Appel_Joueurs_Page->player_id, $Parametres_Appel_Case_Equipement, $Parametres_Chercher_Chemin); ?>
        </div>
        <div class="Case_Equipement Case_Special2">
            <?php CheckEquipement(8, $Donnees_Appel_Joueurs_Page->player_id, $Parametres_Appel_Case_Equipement, $Parametres_Chercher_Chemin); ?>
        </div>

    </div>

    <div id="Conteneur_Bonus2">
        <div id="Haut_Bonus2"></div>
        <div id="Milieu_Bonus2">
            <div id="Contenue_Milieu_Bonus_Equipement" style="min-height:100px;">

            </div>
        </div>
        <div id="Bas_Bonus2"></div>
    </div>

    <div id="Detail_Liste_Equipement">

        <?php
        /* ----------------------------------------------- Liste Equipement -------------------------------------------- */
        $Liste_Equipement = "SELECT item.vnum,
                                            item.id AS item_id,
                                            item_proto.locale_name
                                     FROM player.item
                                     LEFT JOIN player.item_proto
                                     ON item_proto.vnum = item.vnum
                                     WHERE owner_id = '" . $Donnees_Appel_Joueurs_Page->player_id . "'
                                     AND window = 'EQUIPMENT'";

        $Parametres_Liste_Equipement = $Connexion->query($Liste_Equipement);
        $Parametres_Liste_Equipement->setFetchMode(PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Equipement = $Parametres_Liste_Equipement->rowCount();
        /* ----------------------------------------------------------------------------------------------------- */
        ?>
        <table id="Tableau_Equipement">

            <thead>
                <tr>
                    <th>Liste de l'équipement</th>
                </tr>
            </thead>

            <tbody>

                <?php if ($Nombre_De_Resultat_Equipement > 0) { ?>

                    <?php while ($Resultat_Liste_Equipement = $Parametres_Liste_Equipement->fetch()) { ?>

                        <tr class="Cursor" onmouseover="this.style.backgroundColor='#333333';" onmouseout="this.style.backgroundColor='transparent';" onclick="Chercher_Infos_Item_Equipement(<?php echo $Resultat_Liste_Equipement->item_id; ?>)">

                            <td>
                                <?php echo utf8_encode($Resultat_Liste_Equipement->locale_name); ?>
                            </td>

                        </tr>

                    <?php } ?>

                <?php } else { ?>

                    <tr>
                        <td colspan="3">Aucuns items dans l'équipement.</td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>

    </div>

</div>
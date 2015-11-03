<?php

function getMapByIndex($mapIndex) {

    $mapArchive = "includes/maps.txt";
    $mapContents = file($mapArchive);
    $returnArray = false;
    foreach ($mapContents AS $aktMap) {

        $splitZeile = explode("|||", $aktMap);
        if (trim($splitZeile[0]) == $mapIndex) {
            $returnArray = array();
            $returnArray = $splitZeile;
        }
    }

    if (is_array($returnArray)) {
        return $returnArray;
    } else {
        return "Inconnu";
    }
}

$mapData = getMapByIndex($Index_Map);
if ($mapData != false) {

    if ($mapData != "Inconnu") {

        @$mapX = @$mapData[4];
        @$mapY = @$mapData[5];

        @$baseX = @$mapData[2];
        @$baseY = @$mapData[3];

        $mapImage = "../../images/maps/" . $mapData[0] . ".jpg";

        if ($Resultat_Appel_Joueur_Connecte == 0) {

            /* ---------------------------- Localisation  ------------------------------- */
            $Localisation = "SELECT exit_x AS x,
                                exit_y AS y
                         FROM player.player 
                         WHERE map_index='" . $mapData[0] . "' 
                         AND id = '" . $Donnees_Appel_Joueurs_Page->player_id . "'
                         LIMIT 1";
            $Parametres_Localisation = $this->objConnection->query($Localisation);
            $Parametres_Localisation->setFetchMode(\PDO::FETCH_OBJ);
            $Nombre_De_Resultat = $Parametres_Localisation->rowCount();
            /* -------------------------------------------------------------------------- */
        } else {

            /* ---------------------------- Localisation  ------------------------------- */
            $Localisation = "SELECT x,
                                y
                         FROM player.player 
                         WHERE map_index='" . $mapData[0] . "' 
                         AND id = '" . $Donnees_Appel_Joueurs_Page->player_id . "'
                         LIMIT 1";
            $Parametres_Localisation = $this->objConnection->query($Localisation);
            $Parametres_Localisation->setFetchMode(\PDO::FETCH_OBJ);
            $Nombre_De_Resultat = $Parametres_Localisation->rowCount();
            /* -------------------------------------------------------------------------- */
        }

        $chaData = array();

        $Infos_Personnage = $Parametres_Localisation->fetch();

        @$chaDataX = ((($Infos_Personnage->x - $baseX) / 200) / 0.5);
        @$chaDataY = ((($Infos_Personnage->y - $baseY) / 200) / 0.5);
        ?>

        <?php if ($Resultat_Appel_Joueur_Connecte == 0) { ?>

            <tr>
                <td class="Colonne_Gauche">
                    <span>Map de sortie :</span>
                </td>
                <td><?php echo @$Array_Maps[$Index_Map] ?></td>
            </tr>
            <tr>
                <td class="Colonne_Gauche">
                    <span>Position :</span>
                </td>
                <td><?php echo floor($chaDataX) ?> - <?php echo floor(@$chaDataY) ?></td>
            </tr>

        <?php } else { ?>
            <tr>
                <td class="Colonne_Gauche">
                    <span>Map :</span>
                </td>
                <td><?php echo @$Array_Maps[$Index_Map] ?></td>
            </tr>
            <tr>
                <td class="Colonne_Gauche">
                    <span>Position :</span>
                </td>
                <td><?php echo floor(@$chaDataX) ?> - <?php echo floor(@$chaDataY) ?></td>
            </tr>

        <?php } ?>

    <?php } else { ?>
        <tr>
            <td class="Colonne_Gauche">
                <img src="../images/icones/carte.png" height="14" width="14"/>&nbsp;
                <span>Map :</span>
            </td>
            <td>Inconnu</td>
        </tr>
        <tr>
            <td class="Colonne_Gauche">
                <img src="../images/icones/position.png" height="14" width="14"/>&nbsp;
                <span>Position :</span>
            </td>
            <td>Inconnu</td>
        </tr>
    <?php } ?>

<?php } ?>
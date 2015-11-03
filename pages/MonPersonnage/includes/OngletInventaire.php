<div class="tab-pane" id="Onglet_Inventaire">

    <div class="row">
        <div class="col-lg-4" style="padding-left: 25px; padding-top: 10px; padding-bottom: 10px;">

            <div id="Inventaire">

                <div class="Bouton_Inventaire_1 Pointer" data-tooltip="Page 1" data-tooltip-position="top" onclick="Page_Inventaire(1);"> I </div>
                <div class="Bouton_Inventaire_2 Pointer" data-tooltip="Page 2" data-tooltip-position="top" onclick="Page_Inventaire(2);"> II </div>
                <div class="Bouton_Inventaire_3 Pointer" data-tooltip="Page 3" data-tooltip-position="top" onclick="Page_Inventaire(3);"> III </div>
                <div class="Bouton_Inventaire_4 Pointer" data-tooltip="Page 4" data-tooltip-position="top" onclick="Page_Inventaire(4);"> IV </div>

                <script type="text/javascript">

                    function Page_Inventaire(page) {

                        $.ajax({
                            type: "POST",
                            url: "pages/MonPersonnage/ajax/ajaxInventairePage" + page + ".php",
                            data: "id=<?php echo $Donnees_Appel_Joueurs_Page->player_id; ?>", // données à transmettre
                            success: function (msg) {

                                $("#Conteneur_Inventaire").fadeOut("slow", function () {
                                    $("#Conteneur_Inventaire").html(msg);
                                    $("#Conteneur_Inventaire").fadeIn("slow");
                                });
                            }
                        });
                        return false;

                    }

                    Page_Inventaire(1);

                </script>

                <div id="Conteneur_Inventaire">


                </div>

            </div>

        </div>
        <div class="col-lg-8">
            <div id="Detail_Liste_Inventaire">

                <?php
                /* ----------------------------------------------- Liste Inventaire -------------------------------------------- */
                $Liste_Inventaire = "SELECT item_proto.locale_name,
                                    item.count,
                                    item.id AS item_id
                                     FROM player.item
                                     LEFT JOIN player.item_proto
                                     ON item_proto.vnum = item.vnum
                                     WHERE owner_id = '" . $Donnees_Appel_Joueurs_Page->player_id . "'
                                     AND window = 'INVENTORY'
                                     ORDER by item_proto.locale_name ASC";

                $Parametres_Liste_Inventaire = $this->objConnection->query($Liste_Inventaire);
                $Parametres_Liste_Inventaire->setFetchMode(\PDO::FETCH_OBJ);
                $Nombre_De_Resultat_Inventaire = $Parametres_Liste_Inventaire->rowCount();
                /* ----------------------------------------------------------------------------------------------------- */
                ?>
                <div class="Tableau_Inventaire">

                    <table class="table table-condensed table-hover" style="border-collapse: collapse; margin-bottom: 0px;">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th width="60">Nombre</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php if ($Nombre_De_Resultat_Inventaire > 0) { ?>

                                <?php while ($Resultat_Liste_Inventaire = $Parametres_Liste_Inventaire->fetch()) { ?>

                                    <?php
                                    if (strlen($Resultat_Liste_Inventaire->locale_name) > 2) {
                                        ?>
                                        <tr>

                                            <td>
                                                <?php echo utf8_encode($Resultat_Liste_Inventaire->locale_name); ?>
                                            </td>

                                            <td>
                                                <?php echo $Resultat_Liste_Inventaire->count; ?>
                                            </td>

                                        </tr>

                                    <?php } ?>

                                <?php } ?>

                            <?php } else { ?>

                                <tr>
                                    <td colspan="3">Aucuns items dans l'inventaire.</td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
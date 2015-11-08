<div class="tab-pane" id="Onglet_Entrepot">

    <div class="row">
        <div class="col-lg-4" style="padding-left: 25px; padding-top: 10px; padding-bottom: 10px;">
            <div id="Entrepot">

                <div data-tooltip="Page 1" class="Bouton_Entrepot_1 Pointer" onclick="Page_Entrepot(1);"> I </div>
                <div data-tooltip="Page 2" class="Bouton_Entrepot_2 Pointer" onclick="Page_Entrepot(2);"> II </div>
                <div data-tooltip="Page 3" class="Bouton_Entrepot_3 Pointer" onclick="Page_Entrepot(3);"> III </div>

                <script type="text/javascript">

                    function Page_Entrepot(page) {

                        $.ajax({
                            type: "POST",
                            url: "pages/MonCompte/ajax/ajaxEntrepotPage" + page + ".php",
                            data: "id=<?php echo $Resultat_Appel_Compte->id; ?>", // données à transmettre
                            success: function (msg) {

                                $("#Conteneur_Entrepot").html(msg);
                            }
                        });
                        return false;

                    }

                    Page_Entrepot(1);

                </script>

                <div id="Conteneur_Entrepot"></div>

            </div>
        </div>
        <div class="col-lg-8">
            <div style="max-height: 380px; overflow-y: auto;">

                <?php
                /* ----------------------------------------------- Liste Inventaire -------------------------------------------- */
                $Liste_Entrepot = "SELECT item_proto.locale_name,
                                    item.count,
                                    item.id AS item_id
                                     FROM player.item
                                     LEFT JOIN player.item_proto
                                     ON item_proto.vnum = item.vnum
                                     WHERE owner_id = '" . $Resultat_Appel_Compte->id . "'
                                     AND window = 'SAFEBOX'
                                     ORDER by item_proto.locale_name ASC";

                $Parametres_Liste_Entrepot = $this->objConnection->query($Liste_Entrepot);
                $Parametres_Liste_Entrepot->setFetchMode(\PDO::FETCH_OBJ);
                $Nombre_De_Resultat_Entrepot = $Parametres_Liste_Entrepot->rowCount();
                /* ----------------------------------------------------------------------------------------------------- */
                ?>
                <div>
                    <table class="table table-condensed table-hover" style="border-collapse: collapse; margin-bottom: 0px;">

                        <thead>
                            <tr>

                                <th>Désignation de l'item</th>
                                <th width="40">Nbr.</th>

                            </tr>
                        </thead>

                        <tbody>

                            <?php if ($Nombre_De_Resultat_Entrepot > 0) { ?>

                                <?php while ($Resultat_Liste_Entrepot = $Parametres_Liste_Entrepot->fetch()) { ?>

                                    <tr>
                                        
                                        <td><?php echo utf8_encode($Resultat_Liste_Entrepot->locale_name); ?></td>
                                        <td align="center"><?php echo $Resultat_Liste_Entrepot->count; ?></td>
                                    </tr>
                                <?php } ?>

                            <?php } else { ?>

                                <tr>
                                    <td colspan="2">Aucuns items dans l'entrepot.</td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
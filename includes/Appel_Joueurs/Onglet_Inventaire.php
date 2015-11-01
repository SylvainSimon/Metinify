<div class="tab-pane" id="Onglet_Inventaire">
    <div id="Inventaire">

        <div class="Bouton_Inventaire_1 Cursor" onclick="Page_Inventaire(1);"> I </div>
        <div class="Bouton_Inventaire_2 Cursor" onclick="Page_Inventaire(2);"> II </div>
        <div class="Bouton_Inventaire_3 Cursor" onclick="Page_Inventaire(3);"> III </div>
        <div class="Bouton_Inventaire_4 Cursor" onclick="Page_Inventaire(4);"> IV </div>

        <script type="text/javascript">
                                                                            
            function Page_Inventaire(page){
	                                                       
                $.ajax({
                    type: "POST",
                    url: "./includes/Appel_Joueurs/Inventaire_Page_"+page+".php",
                    data: "id=<?php echo $Donnees_Appel_Joueurs_Page->player_id; ?>", // données à transmettre
                    success: function(msg){
                                                                                        
                        $("#Conteneur_Inventaire").fadeOut("slow", function(){
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

    <div id="Conteneur_Bonus">
        <div id="Haut_Bonus"></div>
        <div id="Milieu_Bonus">
            <div id="Contenue_Milieu_Bonus" style="min-height:100px;">

            </div>
        </div>
        <div id="Bas_Bonus"></div>
    </div>

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

        $Parametres_Liste_Inventaire = $Connexion->query($Liste_Inventaire);
        $Parametres_Liste_Inventaire->setFetchMode(PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Inventaire = $Parametres_Liste_Inventaire->rowCount();
        /* ----------------------------------------------------------------------------------------------------- */
        ?>
        <div class="Tableau_Inventaire">
            <table id="Tableau_Inventaire" class="width100">

                <thead>
                    <tr>

                        <th width="360">Item</th>
                        <th>Nombre</th>

                    </tr>
                </thead>

                <tbody>

                    <?php if ($Nombre_De_Resultat_Inventaire > 0) { ?>

                        <?php while ($Resultat_Liste_Inventaire = $Parametres_Liste_Inventaire->fetch()) { ?>

                            <?php
                            if (strlen($Resultat_Liste_Inventaire->locale_name) > 2) {
                                ?>
                                <tr class="Cursor" onmouseover="this.style.backgroundColor='#333333';" onmouseout="this.style.backgroundColor='transparent';" onclick="Chercher_Infos_Item(<?php echo $Resultat_Liste_Inventaire->item_id; ?>)">

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
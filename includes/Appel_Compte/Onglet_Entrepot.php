<div id="Onglet_Entrepot">
    <div id="Entrepot">

        <div class="Bouton_Entrepot_1 Cursor" onclick="Page_Entrepot(1);"> I </div>
        <div class="Bouton_Entrepot_2 Cursor" onclick="Page_Entrepot(2);"> II </div>
        <div class="Bouton_Entrepot_3 Cursor" onclick="Page_Entrepot(3);"> III </div>

        <script type="text/javascript">
                                                                            
            function Page_Entrepot(page){
	                                                       
                $.ajax({
                    type: "POST",
                    url: "Appel_Compte/Entrepot_Page_"+page+".php",
                    data: "id=<?php echo $Resultat_Appel_Compte->id; ?>", // données à transmettre
                    success: function(msg){
                                                                                        
                        $("#Conteneur_Entrepot").fadeOut("slow", function(){
                            $("#Conteneur_Entrepot").html(msg);
                            $("#Conteneur_Entrepot").fadeIn("slow");
                        });                   

                    }
                });
                return false;
                            
            }
                            
            Page_Entrepot(1);
                                                                        
        </script>
        
        <div id="Conteneur_Entrepot"></div>

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
        $Liste_Entrepot = "SELECT item_proto.locale_name,
                                    item.count,
                                    item.id AS item_id
                                     FROM player.item
                                     LEFT JOIN player.item_proto
                                     ON item_proto.vnum = item.vnum
                                     WHERE owner_id = '" . $Resultat_Appel_Compte->id . "'
                                     AND window = 'SAFEBOX'
                                     ORDER by item_proto.locale_name ASC";

        $Parametres_Liste_Entrepot = $Connexion->query($Liste_Entrepot);
        $Parametres_Liste_Entrepot->setFetchMode(PDO::FETCH_OBJ);
        $Nombre_De_Resultat_Entrepot = $Parametres_Liste_Entrepot->rowCount();
        /* ----------------------------------------------------------------------------------------------------- */
        ?>
        <div class="Tableau_Inventaire">
            <table id="Tableau_Inventaire">

                <thead>
                    <tr>

                        <th>Désignation de l'item</th>
                        <th width="40">Nbr.</th>

                    </tr>
                </thead>

                <tbody>

                    <?php if ($Nombre_De_Resultat_Entrepot > 0) { ?>

                        <?php while ($Resultat_Liste_Entrepot = $Parametres_Liste_Entrepot->fetch()) { ?>

                            <tr class="Cursor" onmouseover="this.style.backgroundColor='#333333';" onmouseout="this.style.backgroundColor='transparent';" onclick="Chercher_Infos_Item2(<?php echo $Resultat_Liste_Entrepot->item_id; ?>)">

                                <td>
                                    <?php echo utf8_encode($Resultat_Liste_Entrepot->locale_name); ?>
                                </td>

                                <td align="center">
                                    <?php echo $Resultat_Liste_Entrepot->count; ?>
                                </td>

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
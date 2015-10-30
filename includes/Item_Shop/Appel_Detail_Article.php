<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include '../../configPDO.php'; ?>

<?php if (empty($_SESSION["ID"])) { ?>

    <span class="Texte_Blanc_Bold_Shadow">Veuillez vous reconnecter pour accéder à cette page</span>

<?php } else { ?>

    <?php
    /* ------------------------ Liste des articles  ---------------------------- */
    $Detail_Articles = "SELECT itemshop.name_item,
                           itemshop.prix,
                           itemshop.cat,
                           itemshop.info_item,
                           itemshop.nb_item,
                           itemshop.full_description,
                           itemshop.id_item,
                           itemshop.type
                    FROM site.itemshop
                    WHERE itemshop.id = '" . $_POST['id_recu'] . "' 
                    LIMIT 1";
    $Parametres_Detail_Articles = $Connexion->prepare($Detail_Articles);
    $Parametres_Detail_Articles->execute();
    $Parametres_Detail_Articles->setFetchMode(PDO::FETCH_OBJ);
    /* -------------------------------------------------------------------------- */

    $Resultat_Detail_Articles = $Parametres_Detail_Articles->fetch();
    ?>

    <div id="Detail_Item_Titre">

        <?php echo $Resultat_Detail_Articles->name_item; ?>

    </div>

    <div class="Detail_Item_Icone">
        <?php $Size_Image = @getimagesize("../../images/items/" . $Resultat_Detail_Articles->id_item . ".png"); ?>
        <?php if ($Size_Image[1] > $Size_Image[0]) { ?>
            <img class="Position_Icone_Article_1Case_Grande" src="../../images/items/<?php echo $Resultat_Detail_Articles->id_item; ?>.png" width="32" />
        <?php } else { ?>
            <img class="Position_Icone_Article_1Case_Petite" src="../../images/items/<?php echo $Resultat_Detail_Articles->id_item; ?>.png" width="32" />
        <?php } ?>
    </div>

    <div class="Detail_Item_Description">
        <?php echo $Resultat_Detail_Articles->full_description; ?>
    </div>

    <div class="Barre_Choix_Quantité">
        <?php if ($Resultat_Detail_Articles->cat == "8") { ?>

            <div class="Rappel_Prix_Unité">
                Prix : <?php echo $Resultat_Detail_Articles->prix; ?>
                <?php if ($Resultat_Detail_Articles->cat == "7") { ?>
                    <img class="Image_Piece_Detail_Item" src="../../images/versopiece.png" width="16" >
                <?php } else { ?>
                    <img class="Image_Piece_Detail_Item" src="../../images/rectopiece.png" width="16" >
                <?php } ?>
            </div>

            <select disabled="disabled" id="Selecteur_Nombre">
                <option value="1" selected="selected">x1 (<?php echo $Resultat_Detail_Articles->nb_item; ?> jours)</option>
            </select>

            <div onclick="Valider_Mon_Achat(<?php echo $_POST['id_recu']; ?>, document.getElementById('Selecteur_Nombre').value)" class="Bouton_Valider_Achat">
                Je valide mon achat
            </div>

        <?php } else { ?>

            <div class="Rappel_Prix_Unité">
                Prix : <span id="Prix"><?php echo $Resultat_Detail_Articles->prix; ?></span>
                <?php if ($Resultat_Detail_Articles->cat == "7") { ?>
                    <img class="Image_Piece_Detail_Item" src="../../images/versopiece.png" width="16" >
                <?php } else { ?>
                    <img class="Image_Piece_Detail_Item" src="../../images/rectopiece.png" width="16" >
                <?php } ?>
            </div>

            <select id="Selecteur_Nombre" onchange="document.getElementById('Prix').innerHTML = (this.value*<?php echo $Resultat_Detail_Articles->prix; ?>)">
                <option value="1" selected="selected">x1</option>
                <option value="2" >x2</option>
                <option value="5">x5</option>
                <option value="10">x10</option>
                <option value="20">x20</option>
                <option value="50">x50</option>
            </select>

            <div onclick="Valider_Mon_Achat(<?php echo $_POST['id_recu']; ?>, document.getElementById('Selecteur_Nombre').value)" class="Bouton_Valider_Achat">
                Je valide mon achat
            </div>
        <?php } ?>
    </div>

    <script type="text/javascript">
                                            
        function Valider_Mon_Achat(id_item, nombre_item){
                                                
            window.parent.Barre_De_Statut("Transaction en cours...");
            window.parent.Icone_Chargement(1);
                                            
            $.ajax({
                type: "POST",
                url: "Procedure_Achat.php",
                data: "id_item="+id_item+"&nombre_item="+nombre_item,
                success: function(msg){
                                                        
                    if(msg == 5){
                                             
                        window.parent.Barre_De_Statut("Entrepôt plein ou inexistant.");
                        window.parent.Icone_Chargement(2);
                            
                        alert("Votre entrepot n'a plus de place ou n'existe pas.");
                            
                    }else if(msg == 6){
                                                           
                        window.parent.Barre_De_Statut("Vous n'avez pas asser de Tananaies.");
                        window.parent.Icone_Chargement(2);
                                    
                        alert("Vous n'avez pas assez de TanaNaies.")
                                    
                    }else if(msg == 4){
                                                           
                        window.parent.Barre_De_Statut("L'item choisie n'est pas valide.");
                        window.parent.Icone_Chargement(2);
                        alert("L'item n'est pas valide.")
                                                        
                    }else if(msg == 3){
                                                            
                        window.parent.Barre_De_Statut("Vous n'avez pas asser de Vamonaies.");
                        window.parent.Icone_Chargement(2);
                                        
                        alert("Vous n'avez pas assez de Vamonaies.")
                                                    
                    }else if(msg == "Vous n'êtes pas connecté"){
                                                            
                        window.parent.Barre_De_Statut("Vous n'êtes pas/plus connecté.");
                        window.parent.Icone_Chargement(2);
                                                
                        alert(msg);
                                                            
                    }else{

                        window.parent.Barre_De_Statut("Achat effectué avec succès.");
                        window.parent.Icone_Chargement(0);
                                            
                        $("#Tableau_Liste_Article").fadeOut("medium", function(){
                            $("#Tableau_Liste_Article").html(msg);
                            $("#Tableau_Liste_Article").fadeIn("medium");
                        });
                                                        
                    }

                }
            });
        }
                                            
    </script>

<?php } ?>
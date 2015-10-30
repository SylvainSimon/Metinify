<?php

function CheckEquipement($Position_Equipement, $ID_Personnage, $Parametres_Appel_Case_Equipement, $Parametres_Chercher_Chemin) { ?>

    <?php $Window = "EQUIPMENT"; ?>

    <div class="Case_Inventaire">
        <?php
        /* --------------------------- Appel Case  ------------------------------------ */
        $Parametres_Appel_Case_Equipement->execute(array(
            ':pos' => $Position_Equipement,
            ':owner_id' => $ID_Personnage,
            ':window' => $Window));
        $Parametres_Appel_Case_Equipement->setFetchMode(PDO::FETCH_OBJ);
        /* ---------------------------------------------------------------------------- */

        $Nombre_De_Resultat_Case_Equipement = $Parametres_Appel_Case_Equipement->rowCount();


        if ($Nombre_De_Resultat_Case_Equipement > 0) {

            $Donnees_Case_Equipement = $Parametres_Appel_Case_Equipement->fetch();

            /* ------------------------------------- Chercher Chemin ---------------------------------------- */
            $Parametres_Chercher_Chemin->execute(array(
                ':item' => $Donnees_Case_Equipement->vnum));
            $Parametres_Chercher_Chemin->setFetchMode(PDO::FETCH_OBJ);
            $Nombre_De_Resultat_Chercher_Chemin = $Parametres_Chercher_Chemin->rowCount();
            /* ---------------------------------------------------------------------------------------------- */
            ?>
            <?php if ($Nombre_De_Resultat_Chercher_Chemin > 0) { ?>

                <?php $Resultat_Chercher_Chemin = $Parametres_Chercher_Chemin->fetch(); ?>

                <script type="text/javascript">
                                                                                                                                                                                                                                                                                                                
                    function Chercher_Infos_Item_Equipement(item){
                                    
                        window.parent.parent.Barre_De_Statut("Récupération des informations de l'item...");
                        window.parent.parent.Icone_Chargement(1);
                                    
                        $.ajax({
                            type: "POST",
                            url: "Inventaire_Infos_Item.php",
                            data: "id="+item, // données à transmettre
                            success: function(msg){
                                                                                                                                                                                                                                                                                                                                                                                                
                                $("#Contenue_Milieu_Bonus").fadeOut("medium", function(){
                                    $("#Contenue_Milieu_Bonus").html(msg);
                                    window.parent.parent.Barre_De_Statut("Informations récupérés.");
                                    window.parent.parent.Icone_Chargement(0);
                                    $("#Contenue_Milieu_Bonus").fadeIn("medium");
                                });

                            }
                        });
                                                                                                                                                                                                                                                                                                                                    
                    }
                </script>

                <div class="Interieur_Case">
                    <img onmouseover="Chercher_Infos_Item_Equipement(<?php echo $Donnees_Case_Equipement->item_id; ?>)" src="<?php echo $Resultat_Chercher_Chemin->chemin; ?>" style="position: absolute; top:0px; left:0px;" />
                    <?php
                    $flag = $Donnees_Case_Equipement->flag;
                    ?>

                    <?php /* ----------------------------------Comptage nombre------------------------------ */ ?>
                    <?php if ($flag == 4 or $flag == 20 or $flag == 132 or $flag == 2052 or $flag == 8212) { ?>
                        <span style="position: relative; width: 32px; top:50%; right: -15px">
                            <?php if ($Donnees_Case_Equipement->count < 100) { ?>
                                <?php if ($Donnees_Case_Equipement->count < 10) { ?>
                                    &nbsp;&nbsp;&nbsp;<?php echo $Donnees_Case_Equipement->count; ?>
                                <?php } else { ?>
                                    &nbsp;&nbsp;<?php echo $Donnees_Case_Equipement->count; ?>
                                <?php } ?>
                            <?php } else { ?>
                                <?php echo $Donnees_Case_Equipement->count; ?>
                            <?php } ?>
                        </span>
                    <?php } ?>
                    <?php /* -------------------------------------------------------------------------------- */ ?>
                </div>

            <?php } else { ?>


                <?php if ($Donnees_Case_Equipement->size == "1") { ?>
                    <img onmouseover="Chercher_Infos_Item_Equipement(<?php echo $Donnees_Case_Equipement->item_id; ?>)" class="tTip" src="../images/item_inexistant_1.png" title="<?php echo "Icone de " . $Donnees_Case_Equipement->locale_name . " (" . $Donnees_Case_Equipement->vnum . ") introuvable."; ?>" />
                <?php } else if ($Donnees_Case_Equipement->size == "2") { ?>
                    <img onmouseover="Chercher_Infos_Item_Equipement(<?php echo $Donnees_Case_Equipement->item_id; ?>)" class="tTip" src="../images/item_inexistant_2.png" title="<?php echo "Icone de " . $Donnees_Case_Equipement->locale_name . " (" . $Donnees_Case_Equipement->vnum . ") introuvable."; ?>" />
                <?php } else if ($Donnees_Case_Equipement->size == "3") { ?>
                    <img onmouseover="Chercher_Infos_Item_Equipement(<?php echo $Donnees_Case_Equipement->item_id; ?>)" class="tTip" src="../images/item_inexistant_3.png" title="<?php echo "Icone de " . $Donnees_Case_Equipement->locale_name . " (" . $Donnees_Case_Equipement->vnum . ") introuvable."; ?>" />
                <?php } ?>

            <?php } ?>

        <?php } else { ?>
            &nbsp;
        <?php } ?>
    </div>
<?php } ?>
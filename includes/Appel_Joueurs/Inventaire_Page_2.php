<?php include '../../configPDO.php'; ?>
<?php include '../../pages/Tableaux_Arrays.php'; ?>

<?php
/* -------------------------- Preparation des Requetes ------------------------------- */
$Appel_Case = "SELECT item.vnum,
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

$Parametres_Appel_Case = $Connexion->prepare($Appel_Case);
/* ------------------------------------------------------------------------------------ */
$Chercher_Chemin = "SELECT item_list.chemin
                           FROM player.item_list
                           WHERE item = :item
                           LIMIT 1";

$Parametres_Chercher_Chemin = $Connexion->prepare($Chercher_Chemin);
/* ------------------------------------------------------------------------------------- */

$Window = "INVENTORY";
?>

<?php for ($i = 45; $i < 90; $i++) { ?>

    <div class="Case_Inventaire">
        <?php
        /* --------------------------- Appel Case  ------------------------------------ */
        $Parametres_Appel_Case->execute(array(
            ':pos' => $i,
            ':owner_id' => $_POST['id'],
            ':window' => $Window));
        $Parametres_Appel_Case->setFetchMode(PDO::FETCH_OBJ);
        /* ---------------------------------------------------------------------------- */

        $Nombre_De_Resultat_Case = $Parametres_Appel_Case->rowCount();
        ?>

        <?php if ($Nombre_De_Resultat_Case > 0) { ?>

            <?php $Donnees_Case = $Parametres_Appel_Case->fetch(); ?>

            <?php
            /* ------------------------------------- Chercher Chemin ---------------------------------------- */
            $Parametres_Chercher_Chemin->execute(array(
                ':item' => $Donnees_Case->vnum));
            $Parametres_Chercher_Chemin->setFetchMode(PDO::FETCH_OBJ);
            $Nombre_De_Resultat_Chercher_Chemin = $Parametres_Chercher_Chemin->rowCount();
            /* ---------------------------------------------------------------------------------------------- */
            ?>

            <?php if ($Nombre_De_Resultat_Chercher_Chemin > 0) { ?>

                <?php $Resultat_Chercher_Chemin = $Parametres_Chercher_Chemin->fetch(); ?>

                <script type="text/javascript">
                                                                                                                                                                                                                                                                    
                    function Chercher_Infos_Item(item){
                        
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
                        return false;
                                                                                                                                                                                                                                                                                        
                    }
                </script>

                <div class="Interieur_Case">
                        <img onmouseover="Chercher_Infos_Item(<?php echo $Donnees_Case->item_id; ?>)" src="<?php echo $Resultat_Chercher_Chemin->chemin; ?>" style="position: absolute;" />
                    <?php
                    $flag = $Donnees_Case->flag;
                    ?>
                    <?php if ($flag == 4 or $flag == 20 or $flag == 132 or $flag == 2052 or $flag == 8212) { ?>
                        <span style="position: relative; width: 32px; top:50%; right: -15px">
                            <?php if ($Donnees_Case->count < 100) { ?>
                                <?php if ($Donnees_Case->count < 10) { ?>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $Donnees_Case->count; ?>
                                <?php } else { ?>
                                    &nbsp;&nbsp;<?php echo $Donnees_Case->count; ?>
                                <?php } ?>
                            <?php } else { ?>
                                <?php echo $Donnees_Case->count; ?>
                            <?php } ?>
                        </span>

                    <?php } ?>

                </div>

            <?php } else { ?>

                    <?php if ($Donnees_Case->size == "1") { ?>
                        <img onmouseover="Chercher_Infos_Item(<?php echo $Donnees_Case->item_id; ?>)" class="tTip" src="../images/item_inexistant_1.png" title="<?php echo "Icone de " . $Donnees_Case->locale_name . " (" . $Donnees_Case->vnum . ") introuvable."; ?>" />
                    <?php } else if ($Donnees_Case->size == "2") { ?>
                        <img onmouseover="Chercher_Infos_Item(<?php echo $Donnees_Case->item_id; ?>)" class="tTip" src="../images/item_inexistant_2.png" title="<?php echo "Icone de " . $Donnees_Case->locale_name . " (" . $Donnees_Case->vnum . ") introuvable."; ?>" />
                    <?php } else if ($Donnees_Case->size == "3") { ?>
                        <img onmouseover="Chercher_Infos_Item(<?php echo $Donnees_Case->item_id; ?>)" class="tTip" src="../images/item_inexistant_3.png" title="<?php echo "Icone de " . $Donnees_Case->locale_name . " (" . $Donnees_Case->vnum . ") introuvable."; ?>" />
                    <?php } ?>

            <?php } ?>

        <?php } else { ?>
            &nbsp;
        <?php } ?>
    </div>
<?php } ?>
<?php
/* ------------------------ Catégories IS ---------------------------- */
$Liste_Categorie = "SELECT itemshop.cat,
                                       itemshop_categories.nom 
                                FROM site.itemshop,
                                     site.itemshop_categories
                                WHERE itemshop.cat = itemshop_categories.cat
                                GROUP BY itemshop.cat
                                ORDER BY itemshop_categories.nom ASC
                                LIMIT 13";
$Parametres_Liste_Categorie = $Connexion->query($Liste_Categorie);
$Parametres_Liste_Categorie->setFetchMode(PDO::FETCH_OBJ);
/* -------------------------------------------------------------------------- */
?>

<table class="table table-condensed table-hover table-responsive" style="border-collapse: collapse;">
    <?php while ($Resultat_Liste_Categorie = $Parametres_Liste_Categorie->fetch()) { ?>
        <tr>
            <td style="cursor: pointer; border-top: 0px; border-right: 1px solid #444; border-bottom: 1px solid #444;" onclick="Appel_Categorie_ItemShop(<?php echo $Resultat_Liste_Categorie->cat; ?>)">
                <span><?php echo $Resultat_Liste_Categorie->nom; ?></span>
            </td>
        </tr>
    <?php } ?> 
</table>

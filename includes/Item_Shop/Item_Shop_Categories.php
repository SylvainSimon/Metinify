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

    <ul class="Liste_Menu">
        <?php while ($Resultat_Liste_Categorie = $Parametres_Liste_Categorie->fetch()) { ?>
            <li onclick="Appel_Categorie_ItemShop(<?php echo $Resultat_Liste_Categorie->cat; ?>)"><?php echo $Resultat_Liste_Categorie->nom; ?></li>
        <?php } ?> 
    </ul>

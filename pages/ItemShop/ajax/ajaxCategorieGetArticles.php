<?php

namespace Includes;

require __DIR__ . '../../../../core/initialize.php';

class ajaxCategorieGetArticles extends \ScriptHelper {

    public $isProtected = true;
    
    public function run() {
        ?>

        <?php if (empty($_SESSION["ID"])) { ?>

            <span>Veuillez vous reconnecter pour accéder à cette page</span>

        <?php } else { ?>
            <?php
            /* ------------------------ Liste des articles  ---------------------------- */
            $Liste_Articles = "SELECT itemshop.name_item,
                                          itemshop.prix,
                                          itemshop.cat,
                                          itemshop.id,
                                          itemshop.info_item,
                                          itemshop.id_item,
                                          itemshop.type
                                   FROM site.itemshop,
                                        site.itemshop_categories
                                   WHERE itemshop.cat = itemshop_categories.cat
                                   AND itemshop.cat = '" . $_POST['id'] . "'
                                   AND itemshop.actif = '1'
                                   ORDER BY itemshop.name_item ASC";
            $Parametres_Liste_Articles = $this->objConnection->prepare($Liste_Articles);
            $Parametres_Liste_Articles->execute();
            $Parametres_Liste_Articles->setFetchMode(\PDO::FETCH_OBJ);
            /* -------------------------------------------------------------------------- */
            ?>

            <?php while ($Resultat_Liste_Article = $Parametres_Liste_Articles->fetch()) { ?>
                <div class="Article_IS" onclick="Ajax('pages/ItemShop/ItemShopDetails.php?id_recu=<?= $Resultat_Liste_Article->id; ?>');"  data-tooltip-isItemMetin="1" data-tooltip-track="1" data-tooltip="<?php echo $Resultat_Liste_Article->info_item; ?>">
                    <div class="Nom_Article">
                        <?php echo $Resultat_Liste_Article->name_item; ?>
                    </div>
                    <div class="Prix_Article">
                        <span><?php echo $Resultat_Liste_Article->prix; ?></span>
                        <?php if ($Resultat_Liste_Article->cat == "7") { ?>
                            <img style="position: relative; top:-2px" src="../../images/versopiece.png" width="16" height="16" />
                        <?php } else { ?>
                            <img  style="position: relative; top:-2px" src="../../images/rectopiece.png" width="16" height="16" />
                        <?php } ?>
                    </div>

                    <?php $Size_Image = @getimagesize("../../images/items/" . $Resultat_Liste_Article->id_item . ".png"); ?>
                    <?php if ($Size_Image[1] > $Size_Image[0]) { ?>

                        <?php if ($Size_Image[1] > 64) { ?>
                            <img class="Position_Icone_Article_1Case_TresGrande" src="../../images/items/<?php echo $Resultat_Liste_Article->id_item; ?>.png" width="32" />
                        <?php } else { ?>
                            <img class="Position_Icone_Article_1Case_Grande" src="../../images/items/<?php echo $Resultat_Liste_Article->id_item; ?>.png" width="32" />
                        <?php } ?>

                    <?php } else { ?>
                        <img class="Position_Icone_Article_1Case_Petite" src="../../images/items/<?php echo $Resultat_Liste_Article->id_item; ?>.png" width="32" />
                    <?php } ?>


                </div>

            <?php } ?>
        <?php } ?>
        <?php
    }

}

$class = new ajaxCategorieGetArticles();
$class->run();

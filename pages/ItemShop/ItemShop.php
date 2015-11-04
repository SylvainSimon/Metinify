<?php

namespace Pages\ItemShop;

require __DIR__ . '../../../core/initialize.php';

class ItemShop extends \PageHelper {

    public $isProtected = true;
    
    public function run() {

        $Sauvegarder_ID = $_SESSION['ID'];
        $Sauvegarder_Login = $_SESSION['Utilisateur'];

        if (empty($_SESSION['ID'])) {

            echo "Vous n'êtes pas connecté";
            exit();
        }
        ?>

        <link rel="stylesheet" href="../../css/Item_Shop.css">

        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Magasin d'items</h3>

                <div class="box-tools">
                    <a href="pages/ItemShop/ItemShopRechargement.php?idcompte=<?php echo $Sauvegarder_ID; ?>&nomCompte=<?php echo $Sauvegarder_Login; ?>" class="fancybox_Rechargement btn btn-sm btn-primary btn-flat" data-fancybox-type="iframe">Recharger</a>
                </div>
            </div>

            <div class="box-body no-padding">

                <div class="row">

                    <div class="col-lg-3">
                        <div id="ItemShop_Partie_Menu">
                            <?php include_once 'includes/ItemShopCategory.php'; ?>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div id="Item_Shop_Contenue">

                            <div id="Contenue_Categorie">
                                <div id="Tableau_Liste_Article" style="padding: 10px;">

                                </div>
                            </div>
                            <script type="text/javascript">

                                function Appel_Categorie_ItemShop(id) {

                                    window.parent.Barre_De_Statut("Chargement de la catégorie...");
                                    window.parent.Icone_Chargement(1);

                                    $.ajax({
                                        type: "POST",
                                        url: "pages/ItemShop/ajax/ajaxCategorieGetArticles.php",
                                        data: "id=" + id,
                                        success: function (msg) {

                                            $("#Tableau_Liste_Article").html(msg);
                                            Barre_De_Statut("Catégorie chargé.");
                                            Icone_Chargement(0);
                                            redraw();

                                        }
                                    });
                                    return false;

                                }

                                Appel_Categorie_ItemShop(8);

                            </script>

                            <script type="text/javascript">

                                function Detail_Article(id_recu) {

                                    window.parent.Barre_De_Statut("Appel des détails de l'article...");
                                    window.parent.Icone_Chargement(1);

                                    $.ajax({
                                        type: "POST",
                                        url: "pages/ItemShop/ItemShopDetails.php",
                                        data: "id_recu=" + id_recu,
                                        success: function (msg) {

                                            $("#Tableau_Liste_Article").html(msg);
                                            Barre_De_Statut("Chargement terminé.");
                                            Icone_Chargement(0);
                                            redraw();
                                        }
                                    });
                                    return false;

                                }

                            </script>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php
    }

}

$class = new ItemShop();
$class->run();

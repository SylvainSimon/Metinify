<?php

namespace Includes;

require __DIR__ . '../../../core/initialize.php';

class ItemShopDetails extends \PageHelper {

    public $isProtected = true;

    public function run() {
        ?>
        <?php $Sauvegarder_ID = $_SESSION['ID']; ?>
        <?php $Sauvegarder_Login = $_SESSION['Utilisateur']; ?>


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
                    WHERE itemshop.id = '" . $_GET['id_recu'] . "' 
                    LIMIT 1";
        $Parametres_Detail_Articles = $this->objConnection->prepare($Detail_Articles);
        $Parametres_Detail_Articles->execute();
        $Parametres_Detail_Articles->setFetchMode(\PDO::FETCH_OBJ);
        /* -------------------------------------------------------------------------- */

        $Resultat_Detail_Articles = $Parametres_Detail_Articles->fetch();
        ?>

        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Magasin d'items - Détails</h3>

                <div class="box-tools">
                    <a href="pages/ItemShop/ItemShopRechargement.php?idcompte=<?php echo $Sauvegarder_ID; ?>&nomCompte=<?php echo $Sauvegarder_Login; ?>" class="btn btn-sm btn-primary btn-flat" data-fancybox-type="iframe">Recharger</a>
                </div>
            </div>


            <div id="ContenantAchat">
                <div class="box-body">

                    <div style="margin-bottom: 16px;"><?php echo $Resultat_Detail_Articles->name_item; ?></div>

                    <?php $Size_Image = @getimagesize("../../images/items/" . $Resultat_Detail_Articles->id_item . ".png"); ?>
                    <?php if ($Size_Image[1] > $Size_Image[0]) { ?>
                        <img class="Position_Icone_Article_1Case_Grande" src="../../images/items/<?php echo $Resultat_Detail_Articles->id_item; ?>.png" width="32" />
                    <?php } else { ?>
                        <img class="Position_Icone_Article_1Case_Petite" src="../../images/items/<?php echo $Resultat_Detail_Articles->id_item; ?>.png" width="32" />
                    <?php } ?>

                    <div style="margin-top: 16px;">   
                        <?php if ($Resultat_Detail_Articles->full_description == "") { ?>
                            <?php echo $Resultat_Detail_Articles->info_item; ?>
                        <?php } else { ?>
                            <?php echo $Resultat_Detail_Articles->full_description; ?>
                        <?php } ?>
                    </div>


                    <div class="Rappel_Prix_Unité pull-right" style="display: inline; margin-top: 15px;">
                        Total à payer : <span id="Prix"><?php echo $Resultat_Detail_Articles->prix; ?></span>
                        <?php if ($Resultat_Detail_Articles->cat == "7") { ?>
                            <img class="Image_Piece_Detail_Item" src="../../images/versopiece.png" width="24" >
                        <?php } else { ?>
                            <img class="Image_Piece_Detail_Item" src="../../images/rectopiece.png" width="24" >
                        <?php } ?>
                    </div>
                </div>

                <div class="box-footer">

                    <?php if ($Resultat_Detail_Articles->cat == "8") { ?>

                        <div class="pull-left">
                            <select  class="form-control" disabled="disabled" id="Selecteur_Nombre">
                                <option value="1" selected="selected">x1 (<?php echo $Resultat_Detail_Articles->nb_item; ?> jours)</option>
                            </select>
                        </div>

                        <div class="pull-right">
                            <button onclick="Valider_Mon_Achat(<?php echo $_GET['id_recu']; ?>, document.getElementById('Selecteur_Nombre').value)" class="btn btn-primary btn-flat">
                                Payer
                            </button>
                        </div>
                    <?php } else { ?>

                        <div class="pull-left">

                            <select id="Selecteur_Nombre" class="form-control" onchange="$('#Prix').html(this.value *<?php echo $Resultat_Detail_Articles->prix; ?>)">
                                <option value="1" selected="selected">x1</option>
                                <option value="2">x2</option>
                                <option value="5">x5</option>
                                <option value="10">x10</option>
                                <option value="20">x20</option>
                                <option value="50">x50</option>
                            </select>
                        </div>

                        <div class="pull-right">
                            <button onclick="Valider_Mon_Achat(<?php echo $_GET['id_recu']; ?>, document.getElementById('Selecteur_Nombre').value)" class="btn btn-primary btn-flat">
                                Payer
                            </button>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
        <?php
    }

}

$class = new ItemShopDetails();
$class->run();

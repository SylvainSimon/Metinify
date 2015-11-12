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

        <script type="text/javascript">

            function Valider_Mon_Achat(id_item, nombre_item) {

                bootbox.dialog({
                    message: "Confirmez-vous l'achat de cette objet ?",
                    animate: false,
                    className: "myBootBox",
                    title: 'Confirmation de la demande',
                    buttons: {
                        danger: {
                            label: "Annuler",
                            className: "btn-danger",
                            callback: function () {

                            }
                        },
                        success: {
                            label: "Confirmer",
                            className: "btn-primary",
                            callback: function () {

                                window.parent.Barre_De_Statut("Transaction en cours...");
                                window.parent.Icone_Chargement(1);


                                $.ajax({
                                    type: "POST",
                                    url: "pages/ItemShop/ajax/ajaxArticleBuy.php",
                                    data: "id_item=" + id_item + "&nombre_item=" + nombre_item,
                                    success: function (msg) {

                                        if (msg == 5) {

                                            window.parent.Barre_De_Statut("Entrepôt plein ou inexistant.");
                                            window.parent.Icone_Chargement(2);

                                            alert("Votre entrepot n'a plus de place ou n'existe pas.");

                                        } else if (msg == 6) {

                                            window.parent.Barre_De_Statut("Vous n'avez pas asser de Tananaies.");
                                            window.parent.Icone_Chargement(2);

                                            alert("Vous n'avez pas assez de TanaNaies.")

                                        } else if (msg == 4) {

                                            window.parent.Barre_De_Statut("L'item choisie n'est pas valide.");
                                            window.parent.Icone_Chargement(2);
                                            alert("L'item n'est pas valide.")

                                        } else if (msg == 3) {

                                            window.parent.Barre_De_Statut("Vous n'avez pas asser de Vamonaies.");
                                            window.parent.Icone_Chargement(2);

                                            alert("Vous n'avez pas assez de Vamonaies.")

                                        } else if (msg == "Vous n'êtes pas connecté") {

                                            window.parent.Barre_De_Statut("Vous n'êtes pas/plus connecté.");
                                            window.parent.Icone_Chargement(2);

                                            alert(msg);

                                        } else {

                                            window.parent.Barre_De_Statut("Achat effectué avec succès.");
                                            window.parent.Icone_Chargement(0);

                                            $("#ContenantAchat").html(msg);

                                        }

                                    }
                                });
                            }
                        }
                    }
                });

            }

        </script>

        <?php
    }

}

$class = new ItemShopDetails();
$class->run();

function Appel_Categorie_ItemShop(id) {

    Barre_De_Statut("Chargement de la catégorie...");
    Icone_Chargement(1);
    displayLoading();

    $.ajax({
        type: "POST",
        url: "pages/ItemShop/ajax/ajaxCategorieGetArticles.php",
        data: "id=" + id,
        success: function (msg) {

            $("#Tableau_Liste_Article").html(msg);
            Barre_De_Statut("Catégorie chargé.");
            Icone_Chargement(0);

            hideLoading();
            redraw();

        }
    });
    return false;

}

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

                    Barre_De_Statut("Transaction en cours...");
                    Icone_Chargement(1);
                    displayLoading();

                    $.ajax({
                        type: "POST",
                        url: "pages/ItemShop/ajax/ajaxArticleBuy.php",
                        data: "id_item=" + id_item + "&nombre_item=" + nombre_item,
                        success: function (msg) {

                            var data = JSON.parse(msg);

                            if (data.result === 1) {

                                hideLoading();
                                Ajax("pages/ItemShop/ItemShopAchatTerm.php?idTransaction=" + data.idTransaction);

                            } else {

                                if (data.code == 5) {
                                    Barre_De_Statut("Entrepôt plein.");
                                    Icone_Chargement(2);
                                    alert("Votre entrepot n'a plus de place.");

                                } else if (data.code == 8) {
                                    Barre_De_Statut("Entrepôt inexistant.");
                                    Icone_Chargement(2);
                                    alert("Votre entrepot n'existe pas.");

                                } else if (data.code == 6) {

                                    Barre_De_Statut("Vous n'avez pas asser de Tananaies.");
                                    Icone_Chargement(2);

                                    alert("Vous n'avez pas assez de TanaNaies.")

                                } else if (data.code == 4) {

                                    Barre_De_Statut("L'item choisie n'est pas valide.");
                                    Icone_Chargement(2);
                                    alert("L'item n'est pas valide.")

                                } else if (data.code == 3) {

                                    Barre_De_Statut("Vous n'avez pas asser de Vamonaies.");
                                    Icone_Chargement(2);

                                    alert("Vous n'avez pas assez de Vamonaies.")
                                }
                            }
                        }
                    });
                }
            }
        }
    });

}
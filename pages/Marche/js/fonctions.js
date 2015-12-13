function Ajax_Appel_Marche(url, objet) {

    Pace.track(function () {
        
        displayLoading();

        $.ajax({
            type: "POST",
            url: "" + url,
            success: function (msg) {

                hideLoading();
                $("#Contenue_Cadre_Marche").html(msg);

                if (objet !== false) {
                    $(".nav-tabs-custom li").attr("class", "");
                    $(objet).parent("li").attr("class", "active");
                }

                redraw();
            }
        });
    });
}

function Chargement_Formulaire_Vente(id_personnage) {

    $.ajax({
        type: "POST",
        url: "pages/Marche/ajax/ajaxGetSaleForm.php",
        data: "idPlayer=" + id_personnage,
        success: function (msg) {
            
            if (msg == 0) {
                popBootbox("Ce personnage ne vous appartient pas.")
            } else {
                $("#Contenue_Cadre_Vente").html(msg);
            }

            redraw();
        }
    });

}

function Ajax_Appel_Liste(param) {

    Barre_De_Statut("Génération de la liste...");
    Icone_Chargement(1);
    displayLoading();

    $.ajax({
        type: "POST",
        url: "pages/Marche/ajax/ajaxGetArticles.php",
        data: "race=" + $("#Selecteur_Filtre_Ventes_Race").val()
                + "&sexe=" + $("#Selecteur_Filtre_Ventes_Sexe").val()
                + "&level=" + $("#Selecteur_Filtre_Ventes_Level").val()
                + "&ordre=" + $("#Selecteur_Filtre_Ventes_Ordre").val()
                + "&monnaie=" + $("#Selecteur_Filtre_Ventes_Monnaie").val()
                + "&date=" + $("#Selecteur_Filtre_Ventes_Date").val(),
        success: function (msg) {

            hideLoading();

            $("#Tableau_Liste_Article").html(msg);
            Barre_De_Statut("Liste d'articles généré.");
            Icone_Chargement(0);

            redraw();

        }
    });
    return false;
}

function Acquisition_Article(id) {

    bootbox.dialog({
        message: "Confirmez-vous l'achat de ce personnage ?",
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

                    displayLoading();

                    Barre_De_Statut("Réalisation de l'achat...");
                    Icone_Chargement(1);

                    $.ajax({
                        type: "POST",
                        url: "pages/Marche/ajax/ajaxBuyPlayer.php",
                        data: {"idMarchePersonnage": id},
                        success: function (msg) {

                            hideLoading();

                            var json = JSON.parse(msg);

                            if (json.result) {

                                Fonction_Reteneuse_Vamonaies(json.cash);
                                Fonction_Reteneuse_Tananaies(json.mileage);

                                Ajax('pages/MonPersonnage/MonPersonnage.php?id=' + json.idPlayer + '')

                            } else {
                                popBootbox(json.reasons);
                                Barre_De_Statut(json.reasons);
                                Icone_Chargement(2);
                            }
                        }
                    });
                }
            }
        }
    });
}


function SaleCancel(idMarchePersonnage) {

    bootbox.dialog({
        message: "Confirmez-vous l'annulation de la vente de ce personnage ?",
        animate: false,
        className: "myBootBox",
        title: 'Confirmation de l\'annulation',
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

                    Barre_De_Statut("Annulation de la vente...");
                    Icone_Chargement(1);
                    displayLoading();

                    $.ajax({
                        type: "POST",
                        url: "pages/Marche/ajax/ajaxSaleCancel.php",
                        data: "idMarchePersonnage=" + idMarchePersonnage,
                        success: function (msg) {

                            hideLoading();

                            json = JSON.parse(msg);

                            if (json.result) {

                                Ajax_Appel_Marche('pages/Marche/MarcheMySales.php');

                            } else {
                                popBootbox(json.reasons, "Erreur");
                                Barre_De_Statut(json.reasons);
                                Icone_Chargement(2);
                            }
                        }
                    });
                }
            }
        }
    });
}
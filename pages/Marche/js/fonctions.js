function Ajax_Appel_Marche(url, objet) {

    Barre_De_Statut("Appel de l'onglet...");
    Icone_Chargement(1);

    $.ajax({
        type: "POST",
        url: "" + url,
        success: function (msg) {

            $("#Contenue_Cadre_Marche").html(msg);
            Barre_De_Statut("Chargement terminé.");
            Icone_Chargement(0);

            if (objet !== false) {
                $(".nav-tabs-custom li").attr("class", "");
                $(objet).parent("li").attr("class", "active");
            }

            redraw();

        }
    });
    return false;

}

function Ajax_Appel_Liste(param) {

    Barre_De_Statut("Génération de la liste...");
    Icone_Chargement(1);

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

            $("#Tableau_Liste_Article").html(msg);
            Barre_De_Statut("Liste d'articles généré.");
            Icone_Chargement(0);

            redraw();

        }
    });
    return false;
}

function Ouverture_Dialogue_Achat(id_message) {

    Barre_De_Statut("En attente de la confirmation...");
    Icone_Chargement(1);
    $("#dialog_Confirmation_Acheter_Article").dialog("open");
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

                    Barre_De_Statut("Réalisation de l'achat...");
                    Icone_Chargement(1);
                    $.ajax({
                        type: "POST",
                        url: "pages/Marche/ajax/SQL_Procedure_Achat_Personnage.php",
                        data: "id_marche_personnage=" + id,
                        success: function (msg) {

                            try {

                                Parse_Json = JSON.parse(msg);
                                if (Parse_Json.result == "WIN") {

                                    $.ajax({
                                        type: "POST",
                                        url: "ajax/Update_Vamonaies.php",
                                        success: function (msg) {
                                            Fonction_Reteneuse_Vamonaies(msg);
                                        }
                                    });
                                    $.ajax({
                                        type: "POST",
                                        url: "ajax/Update_Tananaies.php",
                                        success: function (msg) {
                                            Fonction_Reteneuse_Tananaies(msg);
                                        }
                                    });
                                    Ajax_Appel_Marche('pages/Marche/MarchePlace.php');
                                } else if (Parse_Json.result == "FAIL") {

                                    Barre_De_Statut(Parse_Json.reasons);
                                    Icone_Chargement(2);
                                }

                            } catch (e) {

                                Barre_De_Statut("Annulation échoué.");
                                Icone_Chargement(2);
                            }
                        }
                    });
                }
            }
        }
    });
}


function Retirer_De_La_Vente(id) {

    bootbox.dialog({
        message: "Confirmez-vous l'annulation de la vente de ce personnage ?",
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

                    Barre_De_Statut("Annulation de la vente...");
                    Icone_Chargement(1);
                    $.ajax({
                        type: "POST",
                        url: "pages/Marche/ajax/SQL_Retirer_Vente.php",
                        data: "id_marche_personnage=" + id,
                        success: function (msg) {
                            try {

                                Parse_Json = JSON.parse(msg);
                                if (Parse_Json.result == "WIN") {

                                    Ajax_Appel_Marche('pages/Marche/MarchePlace.php');
                                } else if (Parse_Json.result == "FAIL") {

                                    Barre_De_Statut(Parse_Json.reasons);
                                    Icone_Chargement(2);
                                }

                            } catch (e) {

                                Barre_De_Statut("Annulation échoué.");
                                Icone_Chargement(2);
                            }
                        }
                    });
                }
            }
        }
    });
}
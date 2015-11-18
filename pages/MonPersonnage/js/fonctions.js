function Ajax_Appel_MonPersonnage(url, objet) {

    Barre_De_Statut("Appel de l'onglet...");
    Icone_Chargement(1);
    displayLoading();

    $.ajax({
        type: "POST",
        url: "" + url,
        success: function (msg) {

            hideLoading();

            $("#Contenue_Cadre_MonPersonnage").html(msg);

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

function Deblocage_Yangs(id) {

    bootbox.dialog({
        message: "Confirmez-vous le déblocage de vos yangs.<br/>Ceux-ci seront ramenés à 1 500 000",
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

                    Barre_De_Statut("Réinitialisation des yangs en cours...");
                    Icone_Chargement(1);

                    $.ajax({
                        type: "POST",
                        url: "pages/MonPersonnage/ajax/ajaxRepaireYang.php",
                        data: "id_perso=" + id,
                        success: function (msg) {

                            if (msg == "NOT_YOU") {
                                Barre_De_Statut("Ce personnage ne vous appartient pas.");
                                Icone_Chargement(2);
                            } else if (msg == "YANGS") {
                                Barre_De_Statut("Ce personnage n'as pas de problème de yangs.");
                                Icone_Chargement(2);
                            } else {

                                Barre_De_Statut("Yangs réinitialisé.");
                                Icone_Chargement(0);
                            }

                        }
                    });

                }
            }
        }
    });
}

function Deblocage_Personnage(id) {

    bootbox.dialog({
        message: "Confirmez-vous le déblocage du personnage.<br/>Celui-ci sera ramené à sa map d'origine.",
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

                    Barre_De_Statut("Réinitialisation des coordonées du personnage...");
                    Icone_Chargement(1);
                    $.ajax({
                        type: "POST",
                        url: "pages/MonPersonnage/ajax/ajaxRepairePosition.php",
                        data: "id_perso=" + id,
                        success: function (msg) {

                            if (msg == "NOT_EMPIRE") {

                                Barre_De_Statut("Ce personnage n'as pas d'empire.");
                                Icone_Chargement(2);
                            } else if (msg == "NOT_YOU") {

                                Barre_De_Statut("Ce personnage ne vous appartient pas.");
                                Icone_Chargement(2);
                            } else {

                                Barre_De_Statut("Coordonées réinitialisé.");
                                Icone_Chargement(0);
                            }

                        }
                    });


                }
            }
        }
    });
}
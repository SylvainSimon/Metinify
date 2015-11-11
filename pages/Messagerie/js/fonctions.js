function Ajax_Appel_Messagerie(url, objet) {

    window.parent.Barre_De_Statut("Appel de l'onglet...");
    window.parent.Icone_Chargement(1);

    $.ajax({
        type: "POST",
        url: "" + url,
        success: function (msg) {

            $("#Contenue_Cadre_Messagerie").html(msg);
            window.parent.Barre_De_Statut("Chargement terminé.");
            window.parent.Icone_Chargement(0);

            redraw();

            if (objet !== false) {
                $(".nav-tabs-custom li").attr("class", "");
                $(objet).parent("li").attr("class", "active");
            }
        }
    });
    return false;

}

function Ajax_Ouverture_Ticket(id_ticket) {

    window.parent.Barre_De_Statut("Ouverture de la discussion...");
    window.parent.Icone_Chargement(1);

    $.ajax({
        type: "POST",
        url: "pages/Messagerie/MessagerieView.php",
        data: "id_ticket=" + id_ticket,
        success: function (msg) {

            $("#Contenue_Cadre_Messagerie").html(msg);
            window.parent.Barre_De_Statut("Chargement terminé.");
            window.parent.Icone_Chargement(0);

        }
    });
    return false;

}
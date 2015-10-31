function Ajax_Connexion(url) {

    if (url.indexOf("Barre_Deconnexion") != -1) {
        Barre_De_Statut("Deconnexion en cours...");
        Icone_Chargement(1);
    }

    $.ajax({
        type: "POST",
        url: "" + url,
        success: function (msg) {

            $("#Ajax_Connexion").html(msg);

            redraw();
        }
    });
    return false;
}
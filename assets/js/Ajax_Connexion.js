function Ajax_Connexion(url) {

    $.ajax({
        type: "POST",
        url: "" + url,
        success: function (msg) {
            $("#Ajax_Connexion").html(msg);
            redraw();
            Actualisation_Messages_Sans_Boucle();
        }
    });
    return false;
}
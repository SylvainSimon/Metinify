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
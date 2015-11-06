function Ajax_Classement(url) {

    Barre_De_Statut("Appel de la page...");
    Icone_Chargement(1);

    $.ajax({
        type: "POST",
        url: "" + url,
        success: function (msg) {

            nav = document.getElementById("Changement_de_Page");

            $("#Changement_de_Page").html(msg);
            Barre_De_Statut("Chargement terminé.");
            Icone_Chargement(0);

            var scripts = nav.getElementsByTagName('script');
            for (var i = 0; i < scripts.length; i++)
            {
                if (window.execScript)
                {
                    window.execScript(scripts[i].text.replace('<!--', ''));
                }
                else
                {
                    window.eval(scripts[i].text);
                }
            }
        }
    });
    return false;
}
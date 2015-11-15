function Recherche_Guildes(term) {

    if (term.length > 2) {
        Barre_De_Statut("Recherche de la guilde en cours...");
        Icone_Chargement(1);

        displayLoading();

        $.ajax({
            type: "POST",
            url: "pages/Classements/ajax/ClassementGuildesSearch.php",
            data: "recherche=" + term,
            success: function (msg) {

                hideLoading();
                
                $("#pagedeclassement").html(msg);
                Barre_De_Statut("Recherche terminé.");
                Icone_Chargement(0);

            }
        });
    } else {
        popBootbox("Votre reche doit contenir au minimum 2 caractères");
    }
}
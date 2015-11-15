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
        popBootbox("Votre recherche doit contenir au minimum 2 caractères");
    }
}

function Recherche_Joueurs_PVP(term) {

    if (term.length > 2) {

        Barre_De_Statut("Recherche du joueur en cours...");
        Icone_Chargement(1);
        displayLoading();

        $.ajax({
            type: "POST",
            url: "pages/Classements/ajax/ClassementJoueursPvPSearch.php",
            data: "recherche=" + term,
            success: function (msg) {

                hideLoading();

                $("#pagedeclassement").html(msg);
                Barre_De_Statut("Recherche terminé.");
                Icone_Chargement(0);

            }
        });
    } else {
        popBootbox("Votre recherche doit contenir au minimum 2 caractères");
    }
}

function Recherche_Joueurs_PVE(term) {

    if (term.length > 2) {

        Barre_De_Statut("Recherche du joueur en cours...");
        Icone_Chargement(1);
        displayLoading();

        $.ajax({
            type: "POST",
            url: "pages/Classements/ajax/ClassementJoueursPvESearch.php",
            data: "recherche=" + term,
            success: function (msg) {

                hideLoading();

                $("#pagedeclassement").html(msg);
                Barre_De_Statut("Recherche terminé.");
                Icone_Chargement(0);

            }
        });
    } else {
        popBootbox("Votre recherche doit contenir au minimum 2 caractères");
    }
}
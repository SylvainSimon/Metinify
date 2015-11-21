function Update_Monnaie(nombre_monnaies) {

    nombre_monnaies = $('#inputAmount').val();

    if ($("#inputAccount").val() == "") {

        window.parent.Barre_De_Statut("Vous n'avez pas indiquer de compte.");
        window.parent.Icone_Chargement(2);

    } else {
        window.parent.Barre_De_Statut("Distribution en cours...");
        window.parent.Icone_Chargement(1);

        $.ajax({
            type: "POST",
            url: "pages/Admin/ajax/SQL_Update_Monnaies.php",
            data: "nombre_monnaies=" + nombre_monnaies + "&transaction=" + $("#inputTransactionType").val() + "&devise=" + $("#selectDevise").val() + "&compte=" + $("#inputAccount").val(),
            success: function (msg) {
                try {
                    Parse_Json = JSON.parse(msg);

                    if (Parse_Json.result == "WIN") {

                        window.parent.Barre_De_Statut("Transaction effectué.");
                        window.parent.Icone_Chargement(0);

                    } else if (Parse_Json.result == "FAIL") {

                        window.parent.Barre_De_Statut(Parse_Json.reasons);
                        window.parent.Icone_Chargement(2);

                    }

                } catch (e) {

                    window.parent.Barre_De_Statut("Problème lors de la récuperation.");
                    window.parent.Icone_Chargement(2);
                }
            }
        });
    }
}
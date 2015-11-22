function Update_Monnaie(nombre_monnaies) {

    nombre_monnaies = $('#inputAmount').val();

    if ($("#inputAccount").val() == "") {

        Barre_De_Statut("Vous n'avez pas indiquer de compte.");
        Icone_Chargement(2);

    } else {
        
        Barre_De_Statut("Distribution en cours...");
        Icone_Chargement(1);
        displayLoading();

        $.ajax({
            type: "POST",
            url: "pages/Admin/ajax/ajaxGererMonnaieExecute.php",
            data: "nombre_monnaies=" + nombre_monnaies + "&transaction=" + $("#inputTransactionType").val() + "&devise=" + $("#selectDevise").val() + "&compte=" + $("#inputAccount").val(),
            success: function (msg) {

                hideLoading();

                var json = JSON.parse(msg);

                if (json.result) {
                    popBootbox("Les monnaies ont bien été modifiés");
                    Barre_De_Statut("Transaction effectué.");
                    Icone_Chargement(0);
                } else {
                    popBootbox(json.reasons);
                    Barre_De_Statut(json.reasons);
                    Icone_Chargement(2);
                }
            }
        });
    }
}
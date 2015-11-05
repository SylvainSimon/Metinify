function Assignation_Ticket(numero_discussion) {

    window.parent.Barre_De_Statut("Assignation et déplacement du ticket...");
    window.parent.Icone_Chargement(1);

    $.ajax({
        type: "POST",
        url: "pages/Messagerie/ajax/ajaxDiscussionAssign.php",
        data: "Numero_Discussion=" + numero_discussion,
        success: function (msg) {

            if (msg == "NULL") {

                window.parent.Barre_De_Statut("Le message n'existe plus.");
                window.parent.Icone_Chargement(2);

            } else {

                Ajax_Ouverture_Ticket(msg);
            }
        }
    });
}
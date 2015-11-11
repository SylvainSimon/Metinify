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

function displayLoadingChat() {
    $(".box.direct-chat").append('<div class="overlay"><i class="fa fa-spin material-icons md-icon-spin"></i></div>');
}
function hideLoadingChat() {
    $(".box.direct-chat .overlay").remove();
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

function Fonction_Remplacement(montexte) {

    window.parent.Barre_De_Statut("Vérification des mots utilisés...");
    window.parent.Icone_Chargement(1);

    $.ajax({
        type: "POST",
        url: "pages/Messagerie/ajax/ajaxVerificationBadWord.php",
        data: "Message_Texte=" + montexte,
        success: function (msg) {

            window.parent.Barre_De_Statut("Chargement terminé.");
            window.parent.Icone_Chargement(0);

            $("#Textarea_Nouveau_Ticket").val == "";
            $("#Textarea_Nouveau_Ticket").val(msg);
        }
    });

}

function Longueur_minimal() {
    if (document.getElementById('Textarea_Nouveau_Ticket').value.length < 50) {
        Longueur_Minimal = 1;
    } else {
        Longueur_Minimal = 0;
    }
}


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

function Objet_selectionner() {
    if (document.getElementById('Selecteur_Objet_Ticket').value != "--") {
        Objet_Selectionner = 0;
    } else {
        Objet_Selectionner = 1
    }

}

function Valider_Formulaire_Nouveau_Ticket() {

    Longueur_minimal();

    window.parent.Barre_De_Statut("Envoie du nouveau ticket...");
    window.parent.Icone_Chargement(1);

    if (Longueur_Minimal + Objet_Selectionner == 0) {

        $.ajax({
            type: "POST",
            url: "pages/Messagerie/ajax/ajaxDiscussionCreate.php",
            data: "Nouveau_Ticket_Objet=" + $("#Selecteur_Objet_Ticket").val() + "&Nouveau_Ticket_Message=" + $("#Textarea_Nouveau_Ticket").val(),
            success: function (msg) {

                console.log(msg);

                if (msg == 1) {

                    window.parent.Barre_De_Statut("Message envoyé avec succès.");
                    window.parent.Icone_Chargement(0);

                    Ajax_Appel_Messagerie("pages/Messagerie/MessagerieInbox.php");
                }
                else {

                    window.parent.Barre_De_Statut("Envoie du ticket échoué.");
                    window.parent.Icone_Chargement(2);
                }
            }
        });
        return false;
    } else {

        var Message_Erreur = "";

        if (Objet_Selectionner == 1) {

            Message_Erreur += "Veuillez séléctionner un objet pour votre demande.\n";
        }

        if (Longueur_Minimal == 1) {

            Message_Erreur += "Votre message est trop cours.\n";
        }

        alert(Message_Erreur);

        window.parent.Barre_De_Statut("Envoie annulé.");
        window.parent.Icone_Chargement(2);

        return false;
    }
}

function verifPseudo() {
    pseudo = document.getElementById("SaisiePseudo").value;

    for (i = 0; i < pseudo.length; i++) {

        if ((pseudo.charCodeAt(i) >= 32 && pseudo.charCodeAt(i) < 45) ||
                (pseudo.charCodeAt(i) > 45 && pseudo.charCodeAt(i) < 48) ||
                (pseudo.charCodeAt(i) > 57 && pseudo.charCodeAt(i) < 65) ||
                (pseudo.charCodeAt(i) > 90 && pseudo.charCodeAt(i) < 95) ||
                (pseudo.charCodeAt(i) > 95 && pseudo.charCodeAt(i) < 97) ||
                (pseudo.charCodeAt(i) > 122) && (pseudo.charCodeAt(i) < 128) ||
                (pseudo.charCodeAt(i) > 144) && (pseudo.charCodeAt(i) < 147)) {

            document.getElementById('ReponseDuTestPseudo').innerHTML = "<span class='text-red'>Caractère(s) non-autorisé(s)</span>";

            UtilisateurSyntax = 1;

            return;
        } else {

            UtilisateurSyntax = 0;
        }
    }
    if (pseudo.length < 2) {

        document.getElementById('ReponseDuTestPseudo').innerHTML = "<span class='text-red'>Nom d\'utilisateur trop court</span>";

        UtilisateurSyntax = 1;
    }

    else if (texte = RequeteAJAX('pages/Messagerie/ajax/ajaxVerificationPseudo.php?pseudo=' + escape(pseudo)))
    {
        if (texte == 1) {
            document.getElementById('ReponseDuTestPseudo').innerHTML = "<span class='text-red'>Nom d'utilisateur déjà utilisé</span>";

            UtilisateurDispo = 1;
        }
        else if (texte == 2) {

            document.getElementById('ReponseDuTestPseudo').innerHTML = "<span class='text-green'>Nom d'utilisateur libre</span>";

            UtilisateurDispo = 0;

        } else {

            document.getElementById('ReponseDuTestPseudo').innerHTML = texte;

            UtilisateurDispo = 1;

        }
    }
}

function RequeteAJAX(fichier) {

    if (window.XMLHttpRequest) // FIREFOX
        xhr_object = new XMLHttpRequest();
    else if (window.ActiveXObject) // IE
        xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
    else
        return(false);
    xhr_object.open("GET", fichier, false);
    xhr_object.send(null);
    if (xhr_object.readyState == 4)
        return(xhr_object.responseText);
    else
        return(false);
}

function VerificationFormulairePseudo() {

    if ((UtilisateurSyntax + UtilisateurDispo) == 0) {

        $.ajax({
            type: "POST",
            url: "pages/Messagerie/ajax/ajaxPseudoCreate.php",
            data: "Pseudo=" + $("#SaisiePseudo").val(),
            success: function (msg) {
                if (msg == 1) {
                    Ajax("pages/Messagerie/Messagerie.php");
                }
            }
        });
        return false;

    } else {

        messagederreur = "";

        if (UtilisateurSyntax == 1) {
            messagederreur += "- Nom d'utilisateur non-correct\n";
            verifPseudo();
        }
        if ((UtilisateurDispo == 1) && (UtilisateurSyntax == 0)) {
            messagederreur += "- Le nom d'utilisateur n'est pas disponible.\n";
            verifPseudo();
        }

        alert(messagederreur);

        messagederreur = "";

    }
}
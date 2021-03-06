function Ajax_Appel_Messagerie(url, objet) {

    displayLoading();

    $.ajax({
        type: "POST",
        url: "" + url,
        success: function (msg) {

            $("#Contenue_Cadre_Messagerie").html(msg);

            hideLoading();
            redraw();

            if (objet !== false) {
                $(".nav-tabs-custom li").attr("class", "");
                $(objet).parent("li").attr("class", "active");
            }
        }
    });
}

function displayLoadingChat() {
    $(".box.direct-chat").append('<div class="overlay"><i class="fa fa-spin material-icons md-icon-spin"></i></div>');
}
function hideLoadingChat() {
    $(".box.direct-chat .overlay").remove();
}

function DiscussionOpen(idSupportDiscussion) {

    Barre_De_Statut("Ouverture de la discussion...");
    Icone_Chargement(1);
    displayLoading();

    $.ajax({
        type: "POST",
        url: "pages/Messagerie/MessagerieView.php",
        data: {"idSupportDiscussion": idSupportDiscussion},
        success: function (msg) {

            $("#Contenue_Cadre_Messagerie").html(msg);
            Barre_De_Statut("Chargement terminé.");
            Icone_Chargement(0);
            hideLoading();
            redraw();
        }
    });
    return false;

}

function DiscussionArchivage(idDiscussion, withReloadDatatable) {

    bootbox.dialog({
        message: "Êtes vous sûr de vouloir clôturer le ticket ?<br/>Le traitement de la demande sera considéré comme terminé.",
        animate: false,
        className: "myBootBox",
        title: "Confirmation de la clôture",
        buttons: {
            danger: {
                label: "Annuler",
                className: "btn-danger",
                callback: function () {

                }
            },
            success: {
                label: "Confirmer",
                className: "btn-primary",
                callback: function () {

                    Barre_De_Statut("Archivage en cours...");
                    Icone_Chargement(1);

                    $.ajax({
                        type: "POST",
                        url: "pages/Messagerie/ajax/ajaxDiscussionArchivage.php",
                        data: {"idDiscussion": idDiscussion},
                        success: function (msg) {

                            var json = JSON.parse(msg);

                            if (json.result) {
                                
                                toastr.success("Le ticket à été cloturé avec succès.", "Ticket clôturé");

                                if (withReloadDatatable) {
                                    parent.oTable.fnStandingRedraw();
                                } else {
                                    Ajax_Appel_Messagerie("pages/Messagerie/MessagerieInbox.php");
                                }
                            } else {
                                
                                popBootbox(json.message);
                                Barre_De_Statut(json.message);
                                Icone_Chargement(2);
                            }
                        }
                    });

                }
            }
        }
    });
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

        messagederreur = "";
    }
}
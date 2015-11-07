var UtilisateurSyntax = 1;
var UtilisateurDispo = 1;

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
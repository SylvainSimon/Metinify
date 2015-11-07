function Ajax(url) {

    Barre_De_Statut("Appel de la page...");
    Icone_Chargement(1);

    $.ajax({
        type: "POST",
        url: "" + url,
        success: function (msg) {

            nav = document.getElementById("Contenue_Principal");

            $("#Contenue_Principal").html(msg);
            Barre_De_Statut("Chargement terminé.");
            Icone_Chargement(0);

            redraw();

        },
        error: function () {

            Ajax('pages/Page_Introuvable.php');
        }
    });
    return false;
}

function Barre_De_Statut(statut) {

    $("#Phrase_Statut").html(statut);
}

function Icone_Chargement(etat) {

    if (etat == 1) {
        $('#Icone_Chargement').attr("class", "fa fa-spin material-icons md-icon-spin");
        $('#Icone_Chargement').show();
    }

    if (etat == 2) {
        $('#Icone_Chargement').attr("class", "material-icons md-icon-close text-red");
        $('#Icone_Chargement').show();
    }

    if (etat == 0) {
        $('#Icone_Chargement').attr("class", "material-icons md-icon-done text-success");
        $('#Icone_Chargement').show();
    }

    if (etat == 99) {
        $('#Icone_Chargement').attr("class", "material-icons md-icon-tv");
        $('#Icone_Chargement').show();
    }
}

function Actualisation_Messages_Sans_Boucle() {

    $.ajax({
        type: "POST",
        url: "pages/Messagerie/ajax/ajaxMessageVerifyNew.php",
        success: function (msg) {


            var mon_title = "VamosMt2 :: Site Officiel";

            try {

                Parse_Json = JSON.parse(msg);

                if (Parse_Json.result == "WIN") {

                    if (Parse_Json.nombre_attente != "NON") {

                        if (Parse_Json.nombre_recu > 0) {
                            mon_title = "(" + Parse_Json.nombre_recu + ") VamosMt2 :: Site Officiel";
                        }

                        if (Parse_Json.nombre_attente > 0) {
                            mon_title = "(" + Parse_Json.nombre_attente + ") VamosMt2 :: Site Officiel";
                        }

                        if ((Parse_Json.nombre_recu > 0) && (Parse_Json.nombre_attente > 0)) {
                            mon_title = "(" + Parse_Json.nombre_recu + ") (" + Parse_Json.nombre_attente + ") VamosMt2 :: Site Officiel";
                        }

                        if ((Parse_Json.nombre_recu == 0) && (Parse_Json.nombre_attente == 0)) {

                            mon_title = "VamosMt2 :: Site Officiel";
                        }

                        chiffre_message_avant = parseInt($("#Nombre_Message_Non_Lu").html());
                        chiffre_message_apres = parseInt(Parse_Json.nombre_recu);

                        if (chiffre_message_apres > chiffre_message_avant) {
                            if (getCookie("cookieAudio") == null) {

                            } else if (getCookie("cookieAudio") == "On") {

                                document.getElementById('Mp3Audio').play();

                            } else if (getCookie("cookieAudio") == "Off") {

                            }
                        }

                        document.title = mon_title;

                    } else {
                        if (Parse_Json.nombre_recu > 0) {
                            mon_title = "(" + Parse_Json.nombre_attente + ") VamosMt2 :: Site Officiel"
                        }
                        if (Parse_Json.nombre_recu == 0) {
                            mon_title = "VamosMt2 :: Site Officiel"
                        }

                        chiffre_message_avant = parseInt($("#Nombre_Message_Non_Lu").val());
                        chiffre_message_apres = parseInt(Parse_Json.nombre_recu);

                        if (chiffre_message_apres > chiffre_message_avant) {

                            if (getCookie("cookieAudio") == null) {

                            } else if (getCookie("cookieAudio") == "On") {

                                document.getElementById('Mp3Audio').play();

                            } else if (getCookie("cookieAudio") == "Off") {

                            }
                        }

                        document.title = mon_title;
                    }

                    $("#Messagerie_Notification").html(Parse_Json.reasons);

                } else if (Parse_Json.result == "FAIL") {

                    $("#Messagerie_Notification").html(Parse_Json.reasons);
                }

            } catch (e) {

                $("#Messagerie_Notification").html("Erreur de connection au serveur.");
            }
        }
    });
    return false;
}



function Actualisation_Messages() {

    $.ajax({
        type: "POST",
        url: "pages/Messagerie/ajax/ajaxMessageVerifyNew.php",
        success: function (msg) {


            var mon_title = "VamosMt2 :: Site Officiel";

            try {

                Parse_Json = JSON.parse(msg);

                if (Parse_Json.result == "WIN") {

                    if (Parse_Json.nombre_attente != "NON") {

                        if (Parse_Json.nombre_recu > 0) {
                            mon_title = "(" + Parse_Json.nombre_recu + ") VamosMt2 :: Site Officiel";
                        }

                        if (Parse_Json.nombre_attente > 0) {
                            mon_title = "(" + Parse_Json.nombre_attente + ") VamosMt2 :: Site Officiel";
                        }

                        if ((Parse_Json.nombre_recu > 0) && (Parse_Json.nombre_attente > 0)) {
                            mon_title = "(" + Parse_Json.nombre_recu + ") (" + Parse_Json.nombre_attente + ") VamosMt2 :: Site Officiel";
                        }

                        if ((Parse_Json.nombre_recu == 0) && (Parse_Json.nombre_attente == 0)) {

                            mon_title = "VamosMt2 :: Site Officiel";
                        }

                        chiffre_message_avant = parseInt($("#Nombre_Message_Non_Lu").html());
                        chiffre_message_apres = parseInt(Parse_Json.nombre_recu);

                        if (chiffre_message_apres > chiffre_message_avant) {
                            if (getCookie("cookieAudio") == null) {

                            } else if (getCookie("cookieAudio") == "On") {

                                document.getElementById('Mp3Audio').play();

                            } else if (getCookie("cookieAudio") == "Off") {

                            }
                        }

                        document.title = mon_title;

                    } else {
                        if (Parse_Json.nombre_recu > 0) {
                            mon_title = "(" + Parse_Json.nombre_attente + ") VamosMt2 :: Site Officiel"
                        }
                        if (Parse_Json.nombre_recu == 0) {
                            mon_title = "VamosMt2 :: Site Officiel"
                        }

                        chiffre_message_avant = parseInt($("#Nombre_Message_Non_Lu").val());
                        chiffre_message_apres = parseInt(Parse_Json.nombre_recu);

                        if (chiffre_message_apres > chiffre_message_avant) {

                            if (getCookie("cookieAudio") == null) {

                            } else if (getCookie("cookieAudio") == "On") {

                                document.getElementById('Mp3Audio').play();

                            } else if (getCookie("cookieAudio") == "Off") {

                            }
                        }

                        document.title = mon_title;
                    }

                    $("#Messagerie_Notification").html(Parse_Json.reasons);

                } else if (Parse_Json.result == "FAIL") {

                    $("#Messagerie_Notification").html(Parse_Json.reasons);
                }

            } catch (e) {

                $("#Messagerie_Notification").html("Erreur de connection au serveur.");
            }

            setTimeout("Actualisation_Messages()", 20000);
        }
    });
    return false;
}

function SoundNotificationToggle(init) {

    if (init == 1) {
        if (Cookies.get('cookieAudio') !== undefined) {
            if (Cookies.get('cookieAudio') == "On") {
                $("#Icone_Sons").attr("class", "material-icons md-icon-volume-up md-24 text-blue");
            } else if (Cookies.get('cookieAudio') == "Off") {
                $("#Icone_Sons").attr("class", "material-icons md-icon-volume-off md-24 text-red");
            }
        } else {
            Cookies.set('cookieAudio', 'On');
            $("#Icone_Sons").attr("class", "material-icons md-icon-volume-up md-24 text-blue");
        }
    } else {

        if (Cookies.get('cookieAudio') !== undefined) {
            if (Cookies.get('cookieAudio') == "On") {
                Cookies.set('cookieAudio', 'Off');
                $("#Icone_Sons").attr("class", "material-icons md-icon-volume-off md-24 text-red");
            } else if (Cookies.get('cookieAudio') == "Off") {
                Cookies.set('cookieAudio', 'On');
                $("#Icone_Sons").attr("class", "material-icons md-icon-volume-up md-24 text-blue");
            }
        } else {
            Cookies.set('cookieAudio', 'Off');
            $("#Icone_Sons").attr("class", "material-icons md-icon-volume-off md-24 text-red");
        }
    }
}
$(document).ready(function () {
    $("#Formulaire_Connexion").submit(function () {

        Barre_De_Statut("Contact du serveur...");
        Icone_Chargement(1);

        $("#overlayMt2").html('<div style="position: relative;top: 45%;width: 305px; margin: 0 auto 0 auto;"><h2>Connexion du compte...</h2></div>');
        $("#overlayMt2").css('display', "inline");

        $.ajax({
            type: "POST",
            url: "ajax/ajaxConnexionSubmit.php",
            data: "Utilisateur=" + $("#login").val() + "&Mot_De_Passe=" + $("#password").val(),
            success: function (msg) {

                try {

                    json = JSON.parse(msg);

                    if (json.result == "1") {

                        Barre_De_Statut("Connexion réussi.");
                        Icone_Chargement(0);

                        if (json.withRefresh) {
                            $("#overlayMt2").css('display', "none");
                            $("#overlayMt2").html(json.data);
                            $("#overlayMt2").css('display', "inline");
                            location.reload(false);
                        } else {
                            $("#Menu_Inscription_MonCompte").css("display", "inline");
                            $("#Menu_Inscription_MonCompte2").css("display", "none");
                            $("#Lien_Mon_Compte").attr("onclick", "Ajax('pages/MonCompte/modules/MonCompte.php');");

                            $("#Menu_Support").css("display", "inline");
                            $("#Menu_Support2").css("display", "none");
                            $("#Lien_Support").attr("onclick", "Ajax('pages/Messagerie/Messagerie.php');");

                            $("#Menu_Telechargement_ItemShop").css("display", "inline");
                            $("#Lien_Item_Shop").attr("onclick", "Ajax('pages/ItemShop/ItemShop.php?type=Item_Shop');");

                            $("#Menu_Telechargement_Equipe").css("display", "inline");
                            $("#Lien_Marche").attr("onclick", "Ajax('pages/Marche/Marche.php');");

                            Ajax_Connexion('pages/_Home/includes/headbarConnected.php');

                            if (json.isBanned) {
                                Ajax("pages/_LegacyPages/Bannissement.php");
                            } else if (json.isUnconfimed) {
                                Ajax("pages/_LegacyPages/AttenteConfirmation.php");
                            } else {
                                Ajax("pages/_LegacyPages/News.php");
                            }
                            $("#overlayMt2").css('display', "none");
                        }

                    } else if (json.result == "2") {

                        $("#overlayMt2").css('display', "none");
                        document.getElementById("login").value = "";
                        document.getElementById("password").value = "";

                        popBootbox(json.reasons);
                        Barre_De_Statut(json.reasons);
                        Icone_Chargement(2);

                    }

                } catch (e) {

                    $("#overlayMt2").css('display', "none");
                    popBootbox("La connexion de votre compté à échoué");
                    Barre_De_Statut("La connexion a échoué.");
                    Icone_Chargement(2);
                }

            }
        });
        return false;
    });
});
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
                    Parse_Json = JSON.parse(msg);

                    if (Parse_Json.result == "1") {

                        Barre_De_Statut("Connexion réussi.");
                        Icone_Chargement(0);

                        if (Parse_Json.withRefresh) {
                            $("#overlayMt2").css('display', "none");
                            $("#overlayMt2").html(Parse_Json.data);
                            $("#overlayMt2").css('display', "inline");
                            location.reload(false);
                        } else {

                            document.getElementById('Menu_Inscription_MonCompte').style.display = 'inline';
                            document.getElementById('Menu_Inscription_MonCompte2').style.display = 'none';
                            $("#Lien_Mon_Compte").attr("onclick", "Ajax('pages/MonCompte/modules/MonCompte.php');");

                            document.getElementById('Menu_Telechargement_ItemShop').style.display = 'inline';
                            $("#Lien_Item_Shop").attr("onclick", "Ajax('pages/ItemShop/ItemShop.php?type=Item_Shop');");

                            document.getElementById('Menu_Support2').style.display = 'none';
                            document.getElementById('Menu_Support').style.display = 'inline';
                            $("#Lien_Support").attr("onclick", "Ajax('pages/Messagerie/Messagerie.php');");

                            document.getElementById('Menu_Telechargement_Equipe2').style.display = 'none';
                            document.getElementById('Menu_Telechargement_Equipe').style.display = 'inline';

                            $("#Lien_Marche").attr("onclick", "Ajax('pages/Marche/Marche.php');");

                            Ajax_Connexion('pages/_Home/includes/headbarConnected.php');
                            Ajax("pages/_LegacyPages/News.php");
                            $("#overlayMt2").css('display', "none");
                        }

                    } else if (Parse_Json.result == "2") {

                        $("#overlayMt2").css('display', "none");
                        document.getElementById("login").value = "";
                        document.getElementById("password").value = "";

                        popBootbox(Parse_Json.reasons);
                        Barre_De_Statut(Parse_Json.reasons);
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
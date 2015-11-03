$(document).ready(function () {
    $("#Formulaire_Connexion").submit(function () {

        Barre_De_Statut("Contact du serveur...");
        Icone_Chargement(1);

        $.ajax({
            type: "POST",
            url: "ajax/SQL_Connexion.php",
            data: "Utilisateur=" + $("#login").val() + "&Mot_De_Passe=" + $("#password").val(),
            success: function (msg) {

                try {
                    Parse_Json = JSON.parse(msg);

                    if (Parse_Json.result == "1") {

                        Barre_De_Statut("Connexion réussi.");
                        Icone_Chargement(0);

                        Ajax_Connexion('includes/Barre_Superieur_Connectes.php');

                        document.getElementById('Menu_Inscription_MonCompte').style.display = 'inline';
                        document.getElementById('Menu_Inscription_MonCompte2').style.display = 'none';

                        $("#Lien_Mon_Compte").attr("onclick", "Ajax('pages/MonCompte/MonCompte.php?id=" + Parse_Json.id + "');");

                        document.getElementById('Menu_Telechargement_ItemShop').style.display = 'inline';

                        $("#Lien_Item_Shop").attr("onclick", "Ajax('pages/ItemShop/ItemShop.php?type=Item_Shop');");

                        document.getElementById('Menu_Support2').style.display = 'none';
                        document.getElementById('Menu_Support').style.display = 'inline';
                        document.getElementById('Lien_Support').href = "pages/Messagerie/Messagerie.php";

                        document.getElementById('Menu_Telechargement_Equipe2').style.display = 'none';
                        document.getElementById('Menu_Telechargement_Equipe').style.display = 'inline';
                        document.getElementById('Lien_Marche').href = "includes/Marche/Marche.php";

                        if (Parse_Json.data != "") {

                            $("#Barre_Social").append(Parse_Json.data);
                        }

                    } else if (Parse_Json.result == "2") {

                        document.getElementById("login").value = "";
                        document.getElementById("password").value = "";

                        Barre_De_Statut(Parse_Json.reasons);
                        Icone_Chargement(2);

                    } else if (Parse_Json.result == "3") {

                        document.getElementById("login").value = "";
                        document.getElementById("password").value = "";

                        Ajax("pages/Bannissement.php?id=" + Parse_Json.id);

                        Barre_De_Statut(Parse_Json.reasons);
                        Icone_Chargement(2);
                    }

                } catch (e) {
                    Barre_De_Statut("La connexion a échoué.");
                    Icone_Chargement(2);
                }

            }
        });
        return false;
    });
});
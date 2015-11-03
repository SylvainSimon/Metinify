<?php

namespace Pages;

require __DIR__ . '../../../core/initialize.php';

class PasswordForgottenForm extends \PageHelper {

    public function run() {
        ?>
        <div class="Cadre_Principal">

            <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                <h1>Mot de passe oublié</h1>
            </div>
            <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
                <hr class="Hr_Haut"/>
                Indiquez les informations relatives à votre compte afin de faire une demande de nouveau mot de passe.

                <form action="#" id="Formulaire_Mot_de_Passe" method="POST">
                    <table id="Table_Oublie_Mot_De_Passe">

                        <tr>
                            <td>Nom de compte : </td>
                            <td><input id="SaisieCompte" class="Zone_Saisie_Mot_De_Passe_Oublie" type="text" autofocus="autofocus" placeholder="Utilisateur" /></td>
                            <td>Indiquez un compte existant</td>
                        </tr>
                        <tr>
                            <td>E-mail : </td>
                            <td><input id="SaisieEmailOublie" class="Zone_Saisie_Mot_De_Passe_Oublie" type="text" placeholder="truc@machine.com"/></td>
                            <td>Indiquez l'email du compte</td>
                        </tr>

                    </table>

                    Pour recevoir ce mail, cliquez sur le bouton "Envoyer".<br/>
                    Si vous êtes là par erreur, vous pouvez toujours annuler la demande.<br/>
                    <hr class="Hr_Bas">
                    <input type="button" class="Bouton_Envoyer_Changer_Email Bouton_Normal" value="Envoyer" onclick="Envoyer_Formulaire_Oublie_MDP()"/>
                    <input type="button" class="Bouton_Annuler_Changer_Email Bouton_Normal" value="Annuler" onclick="Ajax('pages/Accueil.php');" />

                </form>

                <br/>
            </div>
        </div>

        <script type="text/javascript">

            function Envoyer_Formulaire_Oublie_MDP() {

                Barre_De_Statut("Contact du serveur...");
                Icone_Chargement(1);

                $.ajax({
                    type: "POST",
                    url: "ajax/SQL_Mot_De_Passe_Oublie.php",
                    data: "Mot_De_Passe_Oublie_Compte=" + $("#SaisieCompte").val() + "&Mot_De_Passe_Oublie_Email=" + $("#SaisieEmailOublie").val(),
                    success: function (msg) {

                        if (msg == 1) {

                            Ajax("pages/MonCompte/PasswordForgottenTerm.php?Resultat=oui");
                        }
                        else {

                            Barre_De_Statut("Aucun comptes trouvés pour ces infos.");
                            Icone_Chargement(2);

                            document.getElementById('SaisieCompte').value = "";
                            document.getElementById('SaisieEmailOublie').value = "";
                        }
                    }
                });
                return false;
            }
        </script>
        <?php
    }

}

$class = new PasswordForgottenForm();
$class->run();

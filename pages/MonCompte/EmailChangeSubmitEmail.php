<?php

namespace Pages\MonCompte;

require __DIR__ . '../../../core/initialize.php';

class EmailChangeSubmitEmail extends \PageHelper {

    public function run() {
        ?>
        <div class="Cadre_Principal">

            <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                <h1>Formulaire de changement</h1>
            </div>
            <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
                <hr class="Hr_Haut"/>
                Indiquez le nouvel e-mail que vous souhaitez définir pour votre compte.

                <table class="Table_Modele">
                    <tr>
                        <td class="Colonne_Gauche_Formulaire">
                            Nouvelle e-mail :
                        </td>
                        <td>
                            <input type="text" id="ChampsSaisiemail" class="Zone_Saisie_Modele"/>
                        </td>
                        <td class="Colonne_Droite_Formulaire">
                            Indiquez une nouvelle adresse e-mail.
                        </td>
                    </tr>

                </table>

                Si vous êtes là par erreur, vous pouvez toujours annuler la demande.<br/>
                <hr class="Hr_Bas">
                <input type="button" class="Bouton_Envoyer_Changer_Email Bouton_Normal" value="Changer" onclick="Changer_Email();" />
                <input type="button" class="Bouton_Annuler_Changer_Email Bouton_Normal" value="Annuler" onclick="Ajax('pages/Accueil.php');" />

            </div>
        </div>
        <script type="text/javascript">

            function Changer_Email() {

                Barre_De_Statut("Changement de l'email...");
                Icone_Chargement(1);

                reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');

                if (reg.test(document.getElementById("ChampsSaisiemail").value)) {

                    $.ajax({
                        type: "POST",
                        url: "pages/MonCompte/ajax/ajaxEmailChangeExecute.php",
                        data: "emailapres=" + $("#ChampsSaisiemail").val(), // données à transmettre
                        success: function (msg) {

                            if (msg == 1) {

                                Ajax("pages/MonCompte/EmailChangeTerm.php");
                            }
                            else {

                                Barre_De_Statut("Erreur lors de la définition de l'e-mail.");
                                Icone_Chargement(2);
                            }
                        }
                    });
                    return false;

                } else {

                    Barre_De_Statut("Vérifiez la syntaxe de l'email.");
                    Icone_Chargement(2);
                }
            }

        </script>
    <?php
    }

}
$class = new EmailChangeSubmitEmail();
$class->run();

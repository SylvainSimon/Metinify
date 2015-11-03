<?php

namespace Pages\MonCompte;

require __DIR__ . '../../core/initialize.php';

class EmailChangeSendEmail extends \PageHelper {

    public function run() {
        ?>
        <div class="Cadre_Principal">

            <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal_1();">                  
                <h1>Envoie du mail</h1>
            </div>
            <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1">
                <hr class="Hr_Haut"/>
                Un mail vien de vous être envoyé, merci de noter, ci-après, le code unique.<br/>

                <form action="javascript:void(0)" id="Formulaire_Verif_Changer_Mail" name="FormInscription" method="POST">
                    <table class="Table_Modele">
                        <tr> 
                            <td class="Colonne_Gauche_Formulaire">
                                Code confidentielle :
                            </td>  
                            <td>
                                <input type="text" class="Zone_Saisie_Inscription" id="Code_Confidentiel" placeholder="Code confidentiel" name="Code_Confidentiel">
                            </td>
                            <td class="Colonne_Droite_Formulaire"> 
                                Indiquez le code reçu par E-mail.
                            </td>
                        </tr>
                    </table>
                    <hr class="Hr_Bas">

                    <input class="Bouton_Formulaire_Inscription Bouton_Normal" style="position: relative; left:285px !important;" type="button" onclick="Verification_Code_Confidentiel();" value="Valider" />

                </form>

            </div>
        </div>

        <script type="text/javascript">

            function Verification_Code_Confidentiel() {

                Barre_De_Statut("Vérification du code...");
                Icone_Chargement(1);

                $.ajax({
                    type: "POST",
                    url: "ajax/SQL_Changer_Mail_Verif_Code.php",
                    data: "code=" + $("#Code_Confidentiel").val(),
                    success: function (msg) {

                        if (msg == 1) {

                            Ajax("pages/MonCompte/EmailChangeSubmitEmail.php");
                        }
                        else {

                            Barre_De_Statut("Le code de vérification est incorrect.");
                            Icone_Chargement(2);
                        }
                    }
                });
                return false;
            }

        </script>
        <?php
    }

}

$class = new EmailChangeSendEmail();
$class->run();

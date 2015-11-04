<?php

namespace Pages\MonCompte;

require __DIR__ . '../../../core/initialize.php';

class EmailChangeForm extends \PageHelper {

    public $isProtected = true;
    
    public function run() {
        ?>

        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Changement d'e-mail</h3>
            </div>

            <div class="box-body">
                Grâce à cette fonction, vous allez pouvoir changer votre adresse e-mail.<br/><br/>

                A la suite de ce formulaire, vous recevrez un code confidentiel par e-mail qui vous permettra
                de la modifier en toute sécurité.<br/><br/>

                Pour recevoir ce mail, cliquez sur le bouton "Envoyer".<br/>
                Si vous êtes là par erreur, vous pouvez toujours annuler la demande.
            </div>

            <div class="box-footer">

                <div class="pull-left">
                    <input type="button" class="btn btn-danger btn-flat" value="Annuler" onclick="Ajax('pages/_LegacyPages/Accueil.php');" />
                </div>

                <div class="pull-right">
                    <input type="button" class="btn btn-success btn-flat" value="Envoyer" onclick="ChangerMail();" />
                </div>
            </div>

        </div>

        <script type="text/javascript">

            function ChangerMail() {

                Barre_De_Statut("Envoie du mail...");
                Icone_Chargement(1);

                $.ajax({
                    type: "POST",
                    url: "pages/MonCompte/ajax/ajaxEmailChangeSendEmail.php",
                    success: function (msg) {

                        if (msg == 1) {

                            Barre_De_Statut("Mail envoyé correctement...");
                            Icone_Chargement(0);

                            Ajax("pages/MonCompte/EmailChangeSendEmail.php");
                        }
                        else {

                            Barre_De_Statut("Erreur lors de l'envoie du mail.");
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

$class = new EmailChangeForm();
$class->run();

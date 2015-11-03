<?php

namespace Pages\MonCompte;

require __DIR__ . '../../../core/initialize.php';

class PasswordChangeSendEmail extends \PageHelper {

    public function run() {
        ?>
        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Envoie du mail</h3>
            </div>

            <form action="javascript:void(0)" id="Formulaire_Verif_Changer_Mail" name="FormInscription" method="POST">

                <div class="box-body">

                    Un mail vien de vous être envoyé, merci de noter, ci-après, le code unique.<br/>


                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group ">
                                <label for="Code_Confidentiel">
                                    Code confidentielle
                                </label>

                                <div class="input-group col-xs-12">

                                    <input type="text" class="form-control input-sm text" id="Code_Confidentiel" placeholder="Code confidentiel" name="Code_Confidentiel">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="box-footer">
                    <input class="btn btn-success btn-flat" type="button" onclick="Verification_Code_Confidentiel();" value="Valider" />
                </div>

            </form>
        </div>

        <script type="text/javascript">

            function Verification_Code_Confidentiel() {

                Barre_De_Statut("Vérification du code...");
                Icone_Chargement(1);

                $.ajax({
                    type: "POST",
                    url: "ajax/SQL_Changer_Mot_De_Passe_Verif_Code.php",
                    data: "code=" + $("#Code_Confidentiel").val(),
                    success: function (msg) {

                        if (msg == 1) {

                            Ajax("pages/MonCompte/PasswordChangeTerm.php");
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
$class = new PasswordChangeSendEmail();
$class->run();

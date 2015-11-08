<?php

namespace Pages;

require __DIR__ . '../../../core/initialize.php';

class PasswordForgottenForm extends \PageHelper {

    public function run() {
        ?>

        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Mot de passe oublié</h3>

            </div>
            <form action="#" id="Formulaire_Mot_de_Passe" method="POST">

                <div class="box-body">

                    Indiquez les informations relatives à votre compte afin de faire une demande de nouveau mot de passe.
                    <br/>
                    <br/>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group ">
                                <label for="SaisieCompte">
                                    Nom de compte
                                </label>

                                <div class="input-group col-xs-12">
                                    <input id="SaisieCompte" class="form-control input-sm text" type="text" autofocus="autofocus" placeholder="Utilisateur" />
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="SaisieEmailOublie">
                                    E-mail
                                </label>

                                <div class="input-group col-xs-12">
                                    <input id="SaisieEmailOublie" class="form-control input-sm text" type="text" placeholder="truc@machine.com"/>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="pull-left">
                        <input type="button" class="btn btn-danger btn-flat" value="Annuler" onclick="Ajax('pages/_LegacyPages/News.php');" />
                    </div>

                    <div class="pull-right">
                        <input type="button" class="btn btn-success btn-flat" value="Envoyer" onclick="Envoyer_Formulaire_Oublie_MDP();" />
                    </div>        
                </div>  
            </form>

        </div>

        <script type="text/javascript">

            function Envoyer_Formulaire_Oublie_MDP() {

                Barre_De_Statut("Contact du serveur...");
                Icone_Chargement(1);

                $.ajax({
                    type: "POST",
                    url: "pages/MonCompte/ajax/ajaxPasswordForgottenSendEmail.php",
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

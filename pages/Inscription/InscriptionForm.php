<?php

namespace Pages\Inscription;

require __DIR__ . '../../../core/initialize.php';

class InscriptionForm extends \PageHelper {

    public function run() {
        ?>
        <script src='https://www.google.com/recaptcha/api.js'></script>

        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Création de compte</h3>
            </div>

            <script type="text/javascript" src="pages/Inscription/js/InscriptionControleForm.min.js"></script>
            <form action="javascript:void(0)" id="FormInscription" name="FormInscription" method="POST">

                <div class="box-body">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group ">
                                <label for="SaisieUtilisateur">
                                    Identifiant
                                </label>

                                <div class="input-group col-xs-12">
                                    <input type="text" name="user" onBlur="verifNomDutilisateur(this.value)" id="SaisieUtilisateur" class="form-control input-sm text" value="" required maxlength="16">
                                </div>

                                <span class="help-block">    
                                    <ul class="list-unstyled">
                                        <li id="ReponseDuTestNomDutilisateur"></li>
                                    </ul>
                                </span>
                            </div>

                            <div class="form-group ">
                                <label for="SaisieMDP">
                                    Mot de passe
                                </label>

                                <div class="input-group col-xs-12">
                                    <input type="password" name="password" onKeyUp="verifMDP()" id="SaisieMDP" class="form-control input-sm text" value="" required>
                                </div>

                                <span class="help-block">    
                                    <ul class="list-unstyled">
                                        <li id="ReponseDuTestMotDePasse"></li>
                                    </ul>
                                </span>
                            </div>

                            <div class="form-group" style="margin-bottom: 0px;">
                                <label for="SaisieMDP">
                                    Répétez mot de passe
                                </label>

                                <div class="input-group col-xs-12">
                                    <input type="password" name="password2" onKeyUp="verifRepeterMDP()" id="SaisieRepeterMDP" class="form-control input-sm text" value="" required>
                                </div>

                                <span class="help-block">    
                                    <ul class="list-unstyled">
                                        <li id="ReponseDuTestRepeterMotDePasse"></li>
                                    </ul>
                                </span>
                            </div>

                        </div>

                        <div class="col-lg-6">

                            <div class="form-group ">
                                <label for="SaisieMDP">
                                    E-mail
                                </label>

                                <div class="input-group col-xs-12">
                                    <input type="text" name="email" onBlur="VerifSyntaxEmail()" onKeyUP="VerifSyntaxEmail()" id="SaisieMail" class="form-control input-sm text" value="" required>
                                </div>

                                <span class="help-block">    
                                    <ul class="list-unstyled">
                                        <li id="ReponseDuTestMail"></li>
                                    </ul>
                                </span>
                            </div>

                            <div class="g-recaptcha" data-theme="dark" data-sitekey="6LfT8xATAAAAAMk0k4j72_t40uAGZ5-NAoQOXNmj"></div>

                        </div>
                    </div>
                </div>

                <div class="box-footer">

                    <div class="pull-right">
                        En cliquant, j'accepte les <a style="cursor: pointer;" onclick="Ajax('pages/_LegacyPages/CGU.php');" >CGU</a> ainsi que le <a style="cursor: pointer;" onclick="Ajax('pages/regles.php');" >règlement de jeu</a>.
                        <input type="button" class="btn btn-success btn-flat" onclick="VerificationFormulaire();" value="Envoyer" />
                    </div>
                </div>
            </form>

        </div>

        <?php

    }

}

$class = new InscriptionForm();
$class->run();

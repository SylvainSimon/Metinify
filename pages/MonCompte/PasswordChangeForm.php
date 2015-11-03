<?php

namespace Pages\MonCompte;

require __DIR__ . '../../../core/initialize.php';

class PasswordChangeForm extends \PageHelper {

    public function run() {
        ?>
        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Changement mot de passe</h3>
            </div>

            <script type="text/javascript" src="./js/Controle_Changer_Mot_De_Passe.js"></script>
            <form action="javascript:void(0)" method="POST">

                <div class="box-body">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group ">
                                <label for="Saisie_Ancien_Mot_De_Passe">
                                    Mot de passe actuel
                                </label>

                                <div class="input-group col-xs-12">
                                    <input maxlength="18" autofocus="autofocus" id="Saisie_Ancien_Mot_De_Passe" placeholder="●●●●●●●●" class="form-control input-sm text" type="password" onKeyUp="OldMDP(this.value);" name="user"/>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="Saisie_Ancien_Mot_De_Passe">
                                    Nouveau mot de passe
                                </label>

                                <div class="input-group col-xs-12">
                                    <input maxlength="18" id="Saisie_Nouveau_Mot_De_Passe" class="form-control input-sm text" placeholder="●●●●●●●●" type="password" name="password" onKeyUp="NouveauMDP(this.value);"/>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="SaisieRepeterNewMDP">
                                    Nouveau mot de passe
                                </label>

                                <div class="input-group col-xs-12">
                                    <input maxlength="18" id="SaisieRepeterNewMDP" class="form-control input-sm text" placeholder="●●●●●●●●" type="password" name="password" onKeyUp="RepeterNouveauMDP(this.value);"/>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="box-footer">

                    <div class="pull-left">
                        <input type="button" class="btn btn-danger btn-flat" value="Annuler" onclick="Ajax('pages/Accueil.php');" />
                    </div>

                    <div class="pull-right">
                        <input type="button" class="btn btn-success btn-flat" value="Valider" onclick="VerificationNewMDP();" />
                    </div>
                </div>
            </form>
        </div>
        <?php
    }

}

$class = new PasswordChangeForm();
$class->run();

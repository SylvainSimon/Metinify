<?php

namespace Pages\MonCompte;

require __DIR__ . '../../../core/initialize.php';

class CodeEntrepotChangeForm extends \PageHelper {

    public $isProtected = true;
    
    public function run() {
        ?>

        <div class="box box-default flat">

            <div class="box-header">
                <h3 class="box-title">Changement du code d'entrepôt</h3>
            </div>

            <form action="javascript:void(0)" method="POST">
                <script type="text/javascript" src="pages/MonCompte/js/CodeEntrepotFormControl.js"></script>

                <div class="box-body">

                    Changez ici le code qui sert à ouvrir votre entrepôt dans le jeu.
                    <br/>
                    <br/>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group ">
                                <label for="Champs_Saisie_Ancien_Code_Entrepot">
                                    Code d'entrepôt
                                </label>

                                <div class="input-group col-xs-12">
                                    <input type="password" maxlength="6" autofocus="autofocus" placeholder="●●●●●●●" id="Champs_Saisie_Ancien_Code_Entrepot" class="form-control input-sm text"/>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="Champs_Saisie_Nouveau_Code_Entrepot">
                                    Nouveau code
                                </label>

                                <div class="input-group col-xs-12">
                                    <input type="password" maxlength="6" placeholder="●●●●●●●" id="Champs_Saisie_Nouveau_Code_Entrepot" class="form-control input-sm text" onkeyup="Verification_Longueur_Code(this.value);"/>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label for="Champs_Saisie_Repeter_Nouveau_Code_Entrepot">
                                    Répétez code
                                </label>

                                <div class="input-group col-xs-12">
                                    <input type="password" maxlength="6" placeholder="●●●●●●●" id="Champs_Saisie_Repeter_Nouveau_Code_Entrepot" class="form-control input-sm text" onkeyup="Verifier_Mot_De_Passe_Identique();"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    Pour faire le changement, cliquez sur le bouton "Changer".<br/>
                    Si vous êtes là par erreur, vous pouvez toujours annuler la demande.<br/>
                </div>

                <div class="box-footer">
                    <div class="pull-left">
                        <input type="button" class="btn btn-danger btn-flat" value="Annuler" onclick="Ajax('pages/_LegacyPages/Accueil.php');" />
                    </div>

                    <div class="pull-right">
                        <input type="button" class="btn btn-success btn-flat" value="Changer" onclick="Changement_Code_Entrepot();" />
                    </div>        
                </div>

            </form>

        </div>
        <?php
    }

}

$class = new CodeEntrepotChangeForm();
$class->run();

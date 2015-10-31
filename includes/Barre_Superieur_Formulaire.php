<script type="text/javascript" src="js/Controle_Connexion.js"></script>

<div class="col-md-8 col-sm-6" style="padding-left: 40px;">
    <span>Bienvenue <span class="Bold">Visiteur</span> (<?php echo $_SERVER["REMOTE_ADDR"]; ?>) <a href="javascript:void(0);" onclick="Ajax('pages/Mot_De_Passe_Oublie_Formulaire.php')">Mot de passe oublié ?</a></span>
</div>
<div class="col-md-4 col-sm-6 pull-right">
    <form class="pull-right" action="#" method="POST" id="Formulaire_Connexion">

        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-xs-5">
                        <div class="input-group"  style="margin-bottom: 8px; margin-top: 8px;">
                            <span class="input-group-addon"><i class="material-icons md-icon-account-circle md-dark"></i></span>
                            <input name="login" id="login" maxlength="16" autofocus="autofocus" type="text" class="form-control input-sm" placeholder="Utilisateur" />
                        </div>
                    </div>
                    <div class="col-xs-7" style="padding-right: 5px;">

                        <div class="col-xs-9">
                            <div class="input-group"  style="margin-bottom: 8px; margin-top: 8px;">
                                <span class="input-group-addon"><i class="material-icons md-icon-lock md-dark"></i></span>
                                <input name="mdp" id="password" type="password" class="form-control input-sm" placeholder="●●●●●●●●"/>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <input style="display: inherit; margin-bottom: 8px; margin-top: 8px;" name="envoyer2" type="submit" class="btn btn-primary btn-flat btn-sm" src="images/ok2.gif" value="OK" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

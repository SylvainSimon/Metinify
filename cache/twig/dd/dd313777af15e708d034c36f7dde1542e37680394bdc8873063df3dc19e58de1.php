<?php

/* headbarForm.html5.twig */
class __TwigTemplate_74e1578f372a64e0ee65d5bf6fb3be11edff6c2d87f64c82e9450fb6cbe15434 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<script type=\"text/javascript\" src=\"assets/js/Controle_Connexion.js\"></script>

<div class=\"col-md-8 col-sm-6\" style=\"padding-left: 40px;\">
    <span>Bienvenue <span class=\"Bold\">Visiteur</span> (";
        // line 4
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["request"]) ? $context["request"] : null), "server", array()), "get", array(0 => "REMOTE_ADDR"), "method"), "html", null, true);
        echo ") <a href=\"javascript:void(0);\" onclick=\"Ajax('pages/MonCompte/modules/PasswordForgottenForm.php')\">Mot de passe perdu ?</a></span>
</div>
<div class=\"col-md-4 col-sm-6 pull-right\">
    <form class=\"pull-right\" action=\"#\" method=\"POST\" id=\"Formulaire_Connexion\">

        <div class=\"row\">
            <div class=\"col-md-12\">
                <div class=\"row\">
                    <div class=\"col-xs-5\">
                        <div class=\"input-group\"  style=\"margin-bottom: 8px; margin-top: 8px;\">
                            <span class=\"input-group-addon\"><i class=\"material-icons md-icon-account-circle md-dark\"></i></span>
                            <input name=\"login\" id=\"login\" maxlength=\"16\" autofocus=\"autofocus\" type=\"text\" class=\"form-control input-sm\" placeholder=\"Utilisateur\" />
                        </div>
                    </div>
                    <div class=\"col-xs-7\" style=\"padding-right: 5px;\">

                        <div class=\"col-xs-9\">
                            <div class=\"input-group\"  style=\"margin-bottom: 8px; margin-top: 8px;\">
                                <span class=\"input-group-addon\"><i class=\"material-icons md-icon-lock md-dark\"></i></span>
                                <input name=\"mdp\" id=\"password\" type=\"password\" class=\"form-control input-sm\" placeholder=\"●●●●●●●●\"/>
                            </div>
                        </div>
                        <div class=\"col-xs-3\">
                            <input style=\"display: inherit; margin-bottom: 8px; margin-top: 8px;\" name=\"envoyer2\" type=\"submit\" class=\"btn btn-primary btn-flat btn-sm\" src=\"images/ok2.gif\" value=\"OK\" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
";
    }

    public function getTemplateName()
    {
        return "headbarForm.html5.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  24 => 4,  19 => 1,);
    }
}
/* <script type="text/javascript" src="assets/js/Controle_Connexion.js"></script>*/
/* */
/* <div class="col-md-8 col-sm-6" style="padding-left: 40px;">*/
/*     <span>Bienvenue <span class="Bold">Visiteur</span> ({{ request.server.get("REMOTE_ADDR") }}) <a href="javascript:void(0);" onclick="Ajax('pages/MonCompte/modules/PasswordForgottenForm.php')">Mot de passe perdu ?</a></span>*/
/* </div>*/
/* <div class="col-md-4 col-sm-6 pull-right">*/
/*     <form class="pull-right" action="#" method="POST" id="Formulaire_Connexion">*/
/* */
/*         <div class="row">*/
/*             <div class="col-md-12">*/
/*                 <div class="row">*/
/*                     <div class="col-xs-5">*/
/*                         <div class="input-group"  style="margin-bottom: 8px; margin-top: 8px;">*/
/*                             <span class="input-group-addon"><i class="material-icons md-icon-account-circle md-dark"></i></span>*/
/*                             <input name="login" id="login" maxlength="16" autofocus="autofocus" type="text" class="form-control input-sm" placeholder="Utilisateur" />*/
/*                         </div>*/
/*                     </div>*/
/*                     <div class="col-xs-7" style="padding-right: 5px;">*/
/* */
/*                         <div class="col-xs-9">*/
/*                             <div class="input-group"  style="margin-bottom: 8px; margin-top: 8px;">*/
/*                                 <span class="input-group-addon"><i class="material-icons md-icon-lock md-dark"></i></span>*/
/*                                 <input name="mdp" id="password" type="password" class="form-control input-sm" placeholder="●●●●●●●●"/>*/
/*                             </div>*/
/*                         </div>*/
/*                         <div class="col-xs-3">*/
/*                             <input style="display: inherit; margin-bottom: 8px; margin-top: 8px;" name="envoyer2" type="submit" class="btn btn-primary btn-flat btn-sm" src="images/ok2.gif" value="OK" />*/
/*                         </div>*/
/*                     </div>*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/*     </form>*/
/* </div>*/
/* */

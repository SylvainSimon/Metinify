<?php

/* News.html5.twig */
class __TwigTemplate_182d4392e6bb2d9c4fe687d14c0420076327c6cd3860bbd6f2747b6e2da4a31b extends Twig_Template
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
        if ((twig_length_filter($this->env, (isset($context["arrObjAdminNews"]) ? $context["arrObjAdminNews"] : null)) > 0)) {
            // line 2
            echo "
    ";
            // line 3
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["arrObjAdminNews"]) ? $context["arrObjAdminNews"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["objAdminNews"]) {
                // line 4
                echo "
        <div class=\"box box-default flat\">

            <div class=\"box-header\">
                <h3 class=\"box-title\">";
                // line 8
                echo twig_escape_filter($this->env, $this->getAttribute($context["objAdminNews"], "titreMessage", array()), "html", null, true);
                echo "</h3>

                <div class=\"box-tools\" style=\"padding-top: 5px;\">
                    <i data-tooltip-position=\"left\" data-tooltip=\"";
                // line 11
                echo twig_escape_filter($this->env, $this->env->getExtension('datetime_extension')->getFormatedDateTime($this->getAttribute($context["objAdminNews"], "date", array())), "html", null, true);
                echo "\" class=\"material-icons md-icon-event md-20\"></i>
                </div>
            </div>

            <div class=\"box-body\">

                ";
                // line 17
                if (($this->getAttribute($context["objAdminNews"], "lienIllustration", array()) != "")) {
                    // line 18
                    echo "                    <div class=\"Texte_News\">
                        <img class=\"Image_News\" style=\"float: left;\" height=\"100\" src=\"";
                    // line 19
                    echo twig_escape_filter($this->env, $this->getAttribute($context["objAdminNews"], "lienIllustration", array()), "html", null, true);
                    echo "\" />
                        <div style=\"position: relative; padding-right: 4px; left:4px;\">";
                    // line 20
                    echo twig_escape_filter($this->env, $this->getAttribute($context["objAdminNews"], "contenueMessage", array()), "html", null, true);
                    echo "</div>
                    </div>
                ";
                } else {
                    // line 23
                    echo "                    ";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["objAdminNews"], "contenueMessage", array()), "html", null, true);
                    echo "
                ";
                }
                // line 25
                echo "

                <div style=\"position: absolute; bottom: 2px; right: 6px; color: grey;\">
                    <small>Publié par ";
                // line 28
                echo twig_escape_filter($this->env, $this->getAttribute($context["objAdminNews"], "pseudoMessagerie", array()), "html", null, true);
                echo "</small>
                </div>
            </div>
        </div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['objAdminNews'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
        }
    }

    public function getTemplateName()
    {
        return "News.html5.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  75 => 28,  70 => 25,  64 => 23,  58 => 20,  54 => 19,  51 => 18,  49 => 17,  40 => 11,  34 => 8,  28 => 4,  24 => 3,  21 => 2,  19 => 1,);
    }
}
/* {% if arrObjAdminNews|length > 0 %}*/
/* */
/*     {% for objAdminNews in arrObjAdminNews %}*/
/* */
/*         <div class="box box-default flat">*/
/* */
/*             <div class="box-header">*/
/*                 <h3 class="box-title">{{ objAdminNews.titreMessage }}</h3>*/
/* */
/*                 <div class="box-tools" style="padding-top: 5px;">*/
/*                     <i data-tooltip-position="left" data-tooltip="{{ getFormatedDateTime(objAdminNews.date) }}" class="material-icons md-icon-event md-20"></i>*/
/*                 </div>*/
/*             </div>*/
/* */
/*             <div class="box-body">*/
/* */
/*                 {% if objAdminNews.lienIllustration != "" %}*/
/*                     <div class="Texte_News">*/
/*                         <img class="Image_News" style="float: left;" height="100" src="{{ objAdminNews.lienIllustration }}" />*/
/*                         <div style="position: relative; padding-right: 4px; left:4px;">{{ objAdminNews.contenueMessage }}</div>*/
/*                     </div>*/
/*                 {% else %}*/
/*                     {{ objAdminNews.contenueMessage }}*/
/*                 {% endif %}*/
/* */
/* */
/*                 <div style="position: absolute; bottom: 2px; right: 6px; color: grey;">*/
/*                     <small>Publié par {{ objAdminNews.pseudoMessagerie }}</small>*/
/*                 </div>*/
/*             </div>*/
/*         </div>*/
/*     {% endfor %}*/
/* {% endif %}*/

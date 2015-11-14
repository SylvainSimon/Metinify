<?php

/* ClassementJoueurTopPVE.html5.twig */
class __TwigTemplate_ed441f0be7b42d92719744627daf2fa90ee4e9d5cc858b8d820f587ba423ebef extends Twig_Template
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
        echo "<div class=\"box box-default flat\">

    <div class=\"box-header\">
        <h3 class=\"box-title\">Classement PVE</h3>
    </div>

    <div class=\"box-body no-padding\">

        <table class=\"table table-hover table-condensed table-responsive\" style=\"border-collapse: collapse;\">

            <thead>
                <tr>
                    <th>Joueur</th>
                    <th style=\"text-align: right;\">Score</th>
                </tr>
            </thead>

            <tbody>
                ";
        // line 19
        if ((twig_length_filter($this->env, (isset($context["arrObjPlayers"]) ? $context["arrObjPlayers"] : null)) > 0)) {
            // line 20
            echo "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["arrObjPlayers"]) ? $context["arrObjPlayers"] : null));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["key"] => $context["objPlayer"]) {
                // line 21
                echo "                        <tr>
                            <td style=\"line-height: 10px;\">

                                ";
                // line 24
                if (($this->getAttribute($context["loop"], "index", array()) == 1)) {
                    // line 25
                    echo "                                    <i class=\"material-icons md-icon-star\" style=\"color:#F3EC12;\"></i>
                                ";
                } elseif (($this->getAttribute(                // line 26
$context["loop"], "index", array()) == 2)) {
                    // line 27
                    echo "                                    <i class=\"material-icons md-icon-star text-gray\"></i>
                                ";
                } elseif (($this->getAttribute(                // line 28
$context["loop"], "index", array()) == 3)) {
                    // line 29
                    echo "                                    <i class=\"material-icons md-icon-star\" style=\"color:#813838;\"></i>
                                ";
                } elseif (($this->getAttribute(                // line 30
$context["loop"], "index", array()) == 4)) {
                    // line 31
                    echo "                                    <i class=\"material-icons md-icon-bookmark\" style=\"color:#F3EC12; opacity: 0.5\"></i>
                                ";
                } elseif (($this->getAttribute(                // line 32
$context["loop"], "index", array()) == 5)) {
                    // line 33
                    echo "                                    <i class=\"material-icons md-icon-bookmark text-gray\" style=\"opacity: 0.5\"></i>
                                ";
                } elseif (($this->getAttribute(                // line 34
$context["loop"], "index", array()) == 6)) {
                    // line 35
                    echo "                                    <i class=\"material-icons md-icon-bookmark\" style=\"color:#813838; opacity: 0.5\"></i>
                                ";
                } else {
                    // line 37
                    echo "                                    ";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["loop"], "index", array()), "html", null, true);
                    echo "
                                ";
                }
                // line 39
                echo "                                <span style=\"vertical-align: text-top;\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["objPlayer"], "name", array()), "html", null, true);
                echo "</span>
                            </td>
                            <td style=\"text-align: right;\">
                                ";
                // line 42
                echo twig_escape_filter($this->env, $this->getAttribute($context["objPlayer"], "scorePve", array()), "html", null, true);
                echo "
                            </td>
                        </tr>
                    ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['objPlayer'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 46
            echo "                ";
        }
        // line 47
        echo "            </tbody>
        </table>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "ClassementJoueurTopPVE.html5.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  129 => 47,  126 => 46,  108 => 42,  101 => 39,  95 => 37,  91 => 35,  89 => 34,  86 => 33,  84 => 32,  81 => 31,  79 => 30,  76 => 29,  74 => 28,  71 => 27,  69 => 26,  66 => 25,  64 => 24,  59 => 21,  41 => 20,  39 => 19,  19 => 1,);
    }
}
/* <div class="box box-default flat">*/
/* */
/*     <div class="box-header">*/
/*         <h3 class="box-title">Classement PVE</h3>*/
/*     </div>*/
/* */
/*     <div class="box-body no-padding">*/
/* */
/*         <table class="table table-hover table-condensed table-responsive" style="border-collapse: collapse;">*/
/* */
/*             <thead>*/
/*                 <tr>*/
/*                     <th>Joueur</th>*/
/*                     <th style="text-align: right;">Score</th>*/
/*                 </tr>*/
/*             </thead>*/
/* */
/*             <tbody>*/
/*                 {% if arrObjPlayers|length > 0 %}*/
/*                     {% for key, objPlayer in arrObjPlayers %}*/
/*                         <tr>*/
/*                             <td style="line-height: 10px;">*/
/* */
/*                                 {% if loop.index == 1 %}*/
/*                                     <i class="material-icons md-icon-star" style="color:#F3EC12;"></i>*/
/*                                 {% elseif loop.index == 2 %}*/
/*                                     <i class="material-icons md-icon-star text-gray"></i>*/
/*                                 {% elseif loop.index == 3 %}*/
/*                                     <i class="material-icons md-icon-star" style="color:#813838;"></i>*/
/*                                 {% elseif loop.index == 4 %}*/
/*                                     <i class="material-icons md-icon-bookmark" style="color:#F3EC12; opacity: 0.5"></i>*/
/*                                 {% elseif loop.index == 5 %}*/
/*                                     <i class="material-icons md-icon-bookmark text-gray" style="opacity: 0.5"></i>*/
/*                                 {% elseif loop.index == 6 %}*/
/*                                     <i class="material-icons md-icon-bookmark" style="color:#813838; opacity: 0.5"></i>*/
/*                                 {% else %}*/
/*                                     {{ loop.index }}*/
/*                                 {% endif %}*/
/*                                 <span style="vertical-align: text-top;">{{ objPlayer.name }}</span>*/
/*                             </td>*/
/*                             <td style="text-align: right;">*/
/*                                 {{ objPlayer.scorePve }}*/
/*                             </td>*/
/*                         </tr>*/
/*                     {% endfor %}*/
/*                 {% endif %}*/
/*             </tbody>*/
/*         </table>*/
/*     </div>*/
/* </div>*/

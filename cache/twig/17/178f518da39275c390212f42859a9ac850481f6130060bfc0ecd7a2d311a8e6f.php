<?php

/* leftMenu.html5.twig */
class __TwigTemplate_897f3e68f435740e7f5213759473f9703effe6ce72df951a5689bb5c994b3ef4 extends Twig_Template
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
        echo "<nav id=\"mainnav\">
    <ul class=\"sidebar-menu\">
        
        <li class=\"pointer\"><a onclick=\"Ajax('pages/_LegacyPages/News.php')\">Accueil</a></li>
        <li class=\"pointer\"><a onclick=\"Ajax('pages/_LegacyPages/Presentation.php')\">Présentation</a></li>

        ";
        // line 7
        if (((isset($context["isConnected"]) ? $context["isConnected"] : null) == false)) {
            // line 8
            echo "            <li id=\"Menu_Inscription_MonCompte2\" class=\"pointer\"><a onclick=\"Ajax('pages/Inscription/InscriptionForm.php')\">Inscription</a></li>
            <li id=\"Menu_Inscription_MonCompte\" class=\"pointer\" style=\"display: none;\"><a id=\"Lien_Mon_Compte\" onclick=\"\">Mon compte</a></li>
        ";
        } else {
            // line 11
            echo "            <li id=\"Menu_Inscription_MonCompte\" class=\"pointer\"><a id=\"Lien_Mon_Compte\" onclick=\"Ajax('pages/MonCompte/modules/MonCompte.php')\">Mon compte</a></li>
            <li id=\"Menu_Inscription_MonCompte2\" class=\"pointer\" style=\"display: none;\"><a onclick=\"Ajax('pages/Inscription/InscriptionForm.php')\">Inscription</a></li>
        ";
        }
        // line 14
        echo "
        <li class=\"treeview\">
            <a href=\"#\">
                <span>Classements</span>
                <i class=\"material-icons md-icon-arrow-down pull-right\"></i>
            </a>
            <ul class=\"treeview-menu\">
                <li>
                    <a class=\"pointer\" onclick=\"Ajax('pages/Classements/ClassementJoueursPvE.php')\">Joueurs PVE</a>
                    <a class=\"pointer\" onclick=\"Ajax('pages/Classements/ClassementJoueursPvP.php')\">Joueurs PVP</a>
                    <a class=\"pointer\" onclick=\"Ajax('pages/Classements/ClassementGuildes.php')\">Guildes</a>
                </li>
            </ul>
        </li>

        ";
        // line 29
        if (((isset($context["isConnected"]) ? $context["isConnected"] : null) == false)) {
            // line 30
            echo "            <li id=\"Menu_Telechargement_ItemShop2\" class=\"pointer\" style=\"display: inline;\"><a onclick=\"Ajax('pages/_LegacyPages/Telechargement.php')\">Téléchargement</a></li>
            <li id=\"Menu_Telechargement_ItemShop\" class=\"pointer\" style=\"display: none;\"><a id=\"Lien_Item_Shop\" onclick=\"\" >Item-Shop</a></li>
        ";
        } else {
            // line 33
            echo "            <li id=\"Menu_Telechargement_ItemShop\" class=\"pointer\" style=\"display: inline;\"><a id=\"Lien_Item_Shop\" onclick=\"Ajax('pages/ItemShop/ItemShop.php')\">Item-Shop</a></li>
            <li id=\"Menu_Telechargement_ItemShop2\" class=\"pointer\"><a onclick=\"Ajax('pages/_LegacyPages/Telechargement.php')\">Téléchargement</a></li>
        ";
        }
        // line 36
        echo "
        ";
        // line 37
        if (((isset($context["isConnected"]) ? $context["isConnected"] : null) == false)) {
            // line 38
            echo "            <li id=\"Menu_Telechargement_Equipe2\" class=\"pointer\" style=\"display: inline;\"><a onclick=\"Ajax('pages/_LegacyPages/Calendrier.php')\">Calendrier des events</a></li>
            <li id=\"Menu_Telechargement_Equipe\" class=\"pointer\" style=\"display: none;\"><a id=\"Lien_Marche\" onclick=\"\" >Marché des personnages</a></li>
        ";
        } else {
            // line 41
            echo "            <li id=\"Menu_Telechargement_Equipe\" class=\"pointer\" style=\"display: inline;\"><a id=\"Lien_Marche\" onclick=\"Ajax('pages/Marche/Marche.php')\">Marché des personnages</a></li>
            <li id=\"Menu_Telechargement_Equipe2\" class=\"pointer\" style=\"display: none;\"><a onclick=\"Ajax('pages/_LegacyPages/Calendrier.php')\">Calendrier</a></li>
        ";
        }
        // line 44
        echo "
        <li><a onclick=\"window.open('http://forum.vamosmt2.org/forum/')\">Notre forum</a></li>

        ";
        // line 47
        if (((isset($context["isConnected"]) ? $context["isConnected"] : null) == false)) {
            // line 48
            echo "            <li id=\"Menu_Support2\" class=\"pointer\"><a onclick=\"Ajax('pages/_LegacyPages/Contacts.php')\">Support</a></li>
            <li id=\"Menu_Support\" class=\"pointer\" style=\"display: none;\"><a id=\"Lien_Support\" onclick=\"\">Support</a></li>
        ";
        } else {
            // line 51
            echo "            <li id=\"Menu_Support\" class=\"pointer\"><a id=\"Lien_Support\" onclick=\"Ajax('pages/Messagerie/Messagerie.php')\">Support</a></li>
            <li id=\"Menu_Support2\" class=\"pointer\" style=\"display: none;\"><a onclick=\"Ajax('pages/_LegacyPages/Contacts.php');\">Support</a></li>
        ";
        }
        // line 54
        echo "    </ul>
</nav>";
    }

    public function getTemplateName()
    {
        return "leftMenu.html5.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  100 => 54,  95 => 51,  90 => 48,  88 => 47,  83 => 44,  78 => 41,  73 => 38,  71 => 37,  68 => 36,  63 => 33,  58 => 30,  56 => 29,  39 => 14,  34 => 11,  29 => 8,  27 => 7,  19 => 1,);
    }
}
/* <nav id="mainnav">*/
/*     <ul class="sidebar-menu">*/
/*         */
/*         <li class="pointer"><a onclick="Ajax('pages/_LegacyPages/News.php')">Accueil</a></li>*/
/*         <li class="pointer"><a onclick="Ajax('pages/_LegacyPages/Presentation.php')">Présentation</a></li>*/
/* */
/*         {% if isConnected == false %}*/
/*             <li id="Menu_Inscription_MonCompte2" class="pointer"><a onclick="Ajax('pages/Inscription/InscriptionForm.php')">Inscription</a></li>*/
/*             <li id="Menu_Inscription_MonCompte" class="pointer" style="display: none;"><a id="Lien_Mon_Compte" onclick="">Mon compte</a></li>*/
/*         {% else %}*/
/*             <li id="Menu_Inscription_MonCompte" class="pointer"><a id="Lien_Mon_Compte" onclick="Ajax('pages/MonCompte/modules/MonCompte.php')">Mon compte</a></li>*/
/*             <li id="Menu_Inscription_MonCompte2" class="pointer" style="display: none;"><a onclick="Ajax('pages/Inscription/InscriptionForm.php')">Inscription</a></li>*/
/*         {% endif %}*/
/* */
/*         <li class="treeview">*/
/*             <a href="#">*/
/*                 <span>Classements</span>*/
/*                 <i class="material-icons md-icon-arrow-down pull-right"></i>*/
/*             </a>*/
/*             <ul class="treeview-menu">*/
/*                 <li>*/
/*                     <a class="pointer" onclick="Ajax('pages/Classements/ClassementJoueursPvE.php')">Joueurs PVE</a>*/
/*                     <a class="pointer" onclick="Ajax('pages/Classements/ClassementJoueursPvP.php')">Joueurs PVP</a>*/
/*                     <a class="pointer" onclick="Ajax('pages/Classements/ClassementGuildes.php')">Guildes</a>*/
/*                 </li>*/
/*             </ul>*/
/*         </li>*/
/* */
/*         {% if isConnected == false %}*/
/*             <li id="Menu_Telechargement_ItemShop2" class="pointer" style="display: inline;"><a onclick="Ajax('pages/_LegacyPages/Telechargement.php')">Téléchargement</a></li>*/
/*             <li id="Menu_Telechargement_ItemShop" class="pointer" style="display: none;"><a id="Lien_Item_Shop" onclick="" >Item-Shop</a></li>*/
/*         {% else %}*/
/*             <li id="Menu_Telechargement_ItemShop" class="pointer" style="display: inline;"><a id="Lien_Item_Shop" onclick="Ajax('pages/ItemShop/ItemShop.php')">Item-Shop</a></li>*/
/*             <li id="Menu_Telechargement_ItemShop2" class="pointer"><a onclick="Ajax('pages/_LegacyPages/Telechargement.php')">Téléchargement</a></li>*/
/*         {% endif %}*/
/* */
/*         {% if isConnected == false %}*/
/*             <li id="Menu_Telechargement_Equipe2" class="pointer" style="display: inline;"><a onclick="Ajax('pages/_LegacyPages/Calendrier.php')">Calendrier des events</a></li>*/
/*             <li id="Menu_Telechargement_Equipe" class="pointer" style="display: none;"><a id="Lien_Marche" onclick="" >Marché des personnages</a></li>*/
/*         {% else %}*/
/*             <li id="Menu_Telechargement_Equipe" class="pointer" style="display: inline;"><a id="Lien_Marche" onclick="Ajax('pages/Marche/Marche.php')">Marché des personnages</a></li>*/
/*             <li id="Menu_Telechargement_Equipe2" class="pointer" style="display: none;"><a onclick="Ajax('pages/_LegacyPages/Calendrier.php')">Calendrier</a></li>*/
/*         {% endif %}*/
/* */
/*         <li><a onclick="window.open('http://forum.vamosmt2.org/forum/')">Notre forum</a></li>*/
/* */
/*         {% if isConnected == false %}*/
/*             <li id="Menu_Support2" class="pointer"><a onclick="Ajax('pages/_LegacyPages/Contacts.php')">Support</a></li>*/
/*             <li id="Menu_Support" class="pointer" style="display: none;"><a id="Lien_Support" onclick="">Support</a></li>*/
/*         {% else %}*/
/*             <li id="Menu_Support" class="pointer"><a id="Lien_Support" onclick="Ajax('pages/Messagerie/Messagerie.php')">Support</a></li>*/
/*             <li id="Menu_Support2" class="pointer" style="display: none;"><a onclick="Ajax('pages/_LegacyPages/Contacts.php');">Support</a></li>*/
/*         {% endif %}*/
/*     </ul>*/
/* </nav>*/

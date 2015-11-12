<nav id="mainnav">
    <ul class="sidebar-menu">
        
        <li class="pointer"><a onclick="Ajax('pages/_LegacyPages/News.php')">Accueil</a></li>
        <li class="pointer"><a onclick="Ajax('pages/_LegacyPages/Presentation.php')">Présentation</a></li>


        <?php if ($session->get("ID") === null) { ?>
            <li id="Menu_Inscription_MonCompte2" class="pointer"><a onclick="Ajax('pages/Inscription/InscriptionForm.php')">Inscription</a></li>
            <li id="Menu_Inscription_MonCompte" class="pointer" style="display: none;"><a id="Lien_Mon_Compte" onclick="">Mon compte</a></li>
        <?php } else { ?>
            <li id="Menu_Inscription_MonCompte" class="pointer"><a id="Lien_Mon_Compte" onclick="Ajax('pages/MonCompte/modules/MonCompte.php?id=<?php echo $this->objAccount->getId(); ?>')">Mon compte</a></li>
            <li id="Menu_Inscription_MonCompte2" class="pointer" style="display: none;"><a onclick="Ajax('pages/Inscription/InscriptionForm.php')">Inscription</a></li>
        <?php } ?>

        <li class="treeview">
            <a href="#">
                <span>Classements</span>
                <i class="material-icons md-icon-arrow-down pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="pointer" onclick="Ajax('pages/Classements/ClassementJoueursPvE.php')">Joueurs PVE</a>
                    <a class="pointer" onclick="Ajax('pages/Classements/ClassementJoueursPvP.php')">Joueurs PVP</a>
                    <a class="pointer" onclick="Ajax('pages/Classements/ClassementGuildes.php')">Guildes</a>
                </li>
            </ul>
        </li>

        <?php if ($session->get("ID") === null) { ?>
            <li id="Menu_Telechargement_ItemShop2" class="pointer" style="display: inline;"><a onclick="Ajax('pages/_LegacyPages/Telechargement.php')">Téléchargement</a></li>
            <li id="Menu_Telechargement_ItemShop" class="pointer" style="display: none;"><a id="Lien_Item_Shop" onclick="" >Item-Shop</a></li>
        <?php } else { ?>
            <li id="Menu_Telechargement_ItemShop" class="pointer" style="display: inline;"><a id="Lien_Item_Shop" onclick="Ajax('pages/ItemShop/ItemShop.php?id=<?php echo $this->objAccount->getId(); ?>')">Item-Shop</a></li>
            <li id="Menu_Telechargement_ItemShop2" class="pointer"><a onclick="Ajax('pages/_LegacyPages/Telechargement.php')">Téléchargement</a></li>
        <?php } ?>

        <?php if ($session->get("ID") === null) { ?>
            <li id="Menu_Telechargement_Equipe2" class="pointer" style="display: inline;"><a onclick="Ajax('pages/_LegacyPages/Calendrier.php')">Calendrier des events</a></li>
            <li id="Menu_Telechargement_Equipe" class="pointer" style="display: none;"><a id="Lien_Marche" onclick="" >Marché des personnages</a></li>
        <?php } else { ?>
            <li id="Menu_Telechargement_Equipe" class="pointer" style="display: inline;"><a id="Lien_Marche" onclick="Ajax('pages/Marche/Marche.php')">Marché des personnages</a></li>
            <li id="Menu_Telechargement_Equipe2" class="pointer" style="display: none;"><a onclick="Ajax('pages/_LegacyPages/Calendrier.php')">Calendrier</a></li>
        <?php } ?>

        <li><a onclick="window.open('http://forum.vamosmt2.org/forum/')">Notre forum</a></li>

        <?php if ($session->get("ID") === null) { ?>
            <li id="Menu_Support2" class="pointer"><a onclick="Ajax('pages/_LegacyPages/Contacts.php')">Support</a></li>
            <li id="Menu_Support" class="pointer" style="display: none;"><a id="Lien_Support" onclick="">Support</a></li>
        <?php } else { ?>
            <li id="Menu_Support" class="pointer"><a id="Lien_Support" onclick="Ajax('pages/Messagerie/Messagerie.php')">Support</a></li>
            <li id="Menu_Support2" class="pointer" style="display: none;"><a onclick="Ajax('pages/_LegacyPages/Contacts.php');">Support</a></li>
            <?php } ?>
    </ul>
</nav>

<script type="text/javascript">

    $(document).ready(function () {
        $(".fancybox_Rechargement").fancybox({
            padding: 0,
            closeBtn: false,
            autoSize: false,
            scrolling: 'no',
            scrollOutside: false,
            fitToView: true,
            autoWidth: true,
            height: 450,
            closeClick: false,
            topRatio: 0.5,
            openEffect: 'elastic',
            closeEffect: 'elastic',
            openSpeed: 400,
            closeSpeed: 200
        });
    });

    $(document).ready(function () {
        $(".fancybox_Trailer").fancybox({
            minWidth: 1200,
            minHeight: 521,
            maxHeight: 521,
            padding: 0,
            closeBtn: false,
            scrolling: 'no',
            scrollOutside: false,
            fitToView: true,
            autoSize: false,
            closeClick: false,
            openEffect: 'elastic',
            closeEffect: 'elastic',
            openSpeed: 400,
            closeSpeed: 200
        });
    });
</script>
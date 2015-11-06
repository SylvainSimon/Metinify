<nav id="mainnav">
    <ul class="sidebar-menu">
        <li><a href="javascript:void(0)" onclick="Ajax('pages/_LegacyPages/Accueil.php')">Accueil</a></li>
        <li><a href="javascript:void(0)" onclick="Ajax('pages/_LegacyPages/Presentation.php')">Présentation</a></li>


        <?php if (empty($_SESSION['Utilisateur'])) { ?>
            <li id="Menu_Inscription_MonCompte2"><a href="javascript:void(0)" onclick="Ajax('pages/Inscription/InscriptionForm.php')">Inscription</a></li>
            <li id="Menu_Inscription_MonCompte" style="display: none;"><a id="Lien_Mon_Compte" href="javascript:void(0)" onclick="">Mon compte</a></li>
        <?php } else { ?>
            <li id="Menu_Inscription_MonCompte"><a id="Lien_Mon_Compte" href="javascript:void(0)" onclick="Ajax('pages/MonCompte/MonCompte.php?id=<?php echo $_SESSION['ID']; ?>')">Mon compte</a></li>
            <li id="Menu_Inscription_MonCompte2" style="display: none;"><a href="javascript:void(0)" onclick="Ajax('pages/Inscription/InscriptionForm.php')">Inscription</a></li>
        <?php } ?>

        <li class="treeview">
            <a href="#">
                <span>Classements</span>
                <i class="material-icons md-icon-arrow-down pull-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="#" onclick="Ajax('pages/Classements/ClassementJoueursPvE.php')">Joueurs PVE</a>
                    <a href="#" onclick="Ajax('pages/Classements/ClassementJoueursPvP.php')">Joueurs PVP</a>
                    <a href="#" onclick="Ajax('pages/Classements/ClassementGuildes.php')">Guildes</a>
                </li>
            </ul>
        </li>
        
        <?php if (empty($_SESSION['Utilisateur'])) { ?>
            <li id="Menu_Telechargement_ItemShop2" style="display: inline;"><a href="javascript:void(0)" onclick="Ajax('pages/_LegacyPages/Telechargement.php')">Téléchargement</a></li>
            <li id="Menu_Telechargement_ItemShop" style="display: none;"><a id="Lien_Item_Shop" href="javascript:void(0)" onclick="" >Item-Shop</a></li>
        <?php } else { ?>
            <li id="Menu_Telechargement_ItemShop" style="display: inline;"><a id="Lien_Item_Shop" href="javascript:void(0)" onclick="Ajax('pages/ItemShop/ItemShop.php?id=<?php echo $_SESSION['ID']; ?>')">Item-Shop</a></li>
            <li id="Menu_Telechargement_ItemShop2"><a href="javascript:void(0)" onclick="Ajax('pages/_LegacyPages/Telechargement.php')">Téléchargement</a></li>
        <?php } ?>

        <?php if (empty($_SESSION['Utilisateur'])) { ?>
            <li id="Menu_Telechargement_Equipe2" style="display: inline;"><a href="javascript:void(0)" onclick="Ajax('pages/_LegacyPages/Calendrier.php')">Calendrier des events</a></li>
            <li id="Menu_Telechargement_Equipe" style="display: none;"><a id="Lien_Marche" href="javascript:void(0)" onclick="" >Marché des personnages</a></li>
        <?php } else { ?>
            <li id="Menu_Telechargement_Equipe" style="display: inline;"><a id="Lien_Marche" href="javascript:void(0)" onclick="Ajax('pages/Marche/Marche.php')">Marché des personnages</a></li>
            <li id="Menu_Telechargement_Equipe2" style="display: none;"><a href="javascript:void(0)" onclick="Ajax('pages/_LegacyPages/Calendrier.php')">Calendrier</a></li>
        <?php } ?>

        <li><a href="javascript:void(0)" onclick="window.open('http://forum.vamosmt2.org/forum/')">Notre forum</a></li>

        <?php if (empty($_SESSION['Utilisateur'])) { ?>
            <li id="Menu_Support2"><a href="javascript:void(0)" onclick="Ajax('pages/_LegacyPages/Contacts.php')">Support</a></li>
            <li id="Menu_Support" style="display: none;"><a id="Lien_Support" href="javascript:void(0)" onclick="">Support</a></li>
        <?php } else { ?>
            <li id="Menu_Support"><a href="javascript:void(0)" id="Lien_Support" onclick="Ajax('pages/Messagerie/Messagerie.php')">Support</a></li>
            <li id="Menu_Support2" style="display: none;"><a href="javascript:void(0)" onclick="Ajax('pages/_LegacyPages/Contacts.php');">Support</a></li>
            <?php } ?>
    </ul>
</nav>

<script type="text/javascript">
    $(document).ready(function () {
        $(".fancybox_Mon_Compte").fancybox({
            minWidth: 1200,
            minHeight: 550,
            maxHeight: 550,
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

    $(document).ready(function () {
        $(".fancybox_Marche").fancybox({
            minWidth: 1200,
            minHeight: 550,
            maxHeight: 550,
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

    $(document).ready(function () {
        $(".fancybox_Vote").fancybox({
            minWidth: 1200,
            minHeight: 550,
            maxHeight: 550,
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

    $(document).ready(function () {
        $(".fancybox_Messagerie").fancybox({
            minWidth: 1000,
            minHeight: 550,
            maxHeight: 550,
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

    $(document).ready(function () {
        $(".fancybox_ItemShop").fancybox({
            minWidth: 780,
            minHeight: 550,
            maxHeight: 550,
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
        $(".fancybox_Statistiques").fancybox({
            minWidth: 1000,
            minHeight: 550,
            maxHeight: 550,
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
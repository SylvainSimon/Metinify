<?php @session_write_close(); ?>
<?php

function check_ssl() {
    // Check if accessed via SSL
    if ($_SERVER['HTTPS'] != 'on') {
        // If not, redirect
        $newurl = 'https://vamosmt2.org';
        header("location: $newurl");
    }
}

check_ssl();
?>

<?php @session_start(); ?>
<?php include 'configPDO.php'; ?>


<!DOCTYPE html>
<html>
    <head>

        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <link rel="icon" type="image/ico" href="favicon.ico" />
        <title>VamosMT2 :: Site Officiel</title>

        <link href="./css/css/Bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="./css/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="./css/css/styles.css" rel="stylesheet" type="text/css" />

        <link href="css/jquery-ui-1.8.23.custom.css" rel="stylesheet" type="text/css" />
        <link href="css/jquery.fancybox.css" rel="stylesheet" type="text/css" />

        <script src='./components/jquery/jquery.min.js' type='text/javascript'></script>
        <script src='./components/jquery-ui/jquery-ui.min.js' type='text/javascript'></script>
        <script src='./vendor/almasaeed2010/adminlte/dist/js/app.min.js' type='text/javascript'></script>

        <script src="js/Jquery_Sliders.js" type='text/javascript'></script>
        <script src="js/Jquery_Superbox.js" type="text/javascript"></script>
        <script src="js/Ajax.js" type='text/javascript'></script>
        <script src="js/Ajax_Connexion.js" type='text/javascript'></script>
        <script src="js/Ajax_Classement.js" type="text/javascript"></script>

        <script src="js/jquery.contextMenu.js" type='text/javascript'></script>
        <script src="js/jquery_coutdown.js" type='text/javascript'></script>
        <script src="js/jquery.fancybox.js" type='text/javascript'></script>
        <script src="js/modernizr-latest.js" type='text/javascript'></script>

        <!--[if lt IE 9]>
        <script src="./vendor/afarkas/html5shiv/dist/html5shiv.min.js"></script>
        <script src="./vendor/rogeriopradoj/respond/dest/respond.min.js"></script>
        <![endif]-->

    </head>

    <body class="skin-red">
        <div class="wrapper">

            <?php include_once 'includes/Barre_Superieur.php'; ?>

            <div class="clear"></div>

            <aside class="main-sidebar" style="background: #131313; border-right: 1px solid #3E3E3E;">
                <section class="sidebar">
                    <?php include_once 'includes/Menu_Primaire.php'; ?>

                </section>
            </aside>

            <div class="content-wrapper">

            <div id="logo"></div>

                
                <div class="col-md-12">

                    <div class="row">
                        <nav class="col-md-2">
                            <?php include_once 'includes/Sidebar_Gauche.php'; ?>
                        </nav>

                        <nav id="Sidebar_Droite" class="col-md-2">
                            <?php include_once 'includes/Sidebar_Droite.php'; ?>
                        </nav>

                        <div id="Contenue_Principal" class="col-md-8"></div> 
                    </div>
                </div>
            </div>

            <footer>
                <?php include_once 'includes/Footer.php'; ?> 
            </footer>
        </div>
    </body>

    <a style="display: none;" id="Lien_Statistiques" href="includes/Statistiques/Statistiques.php" class="fancybox_Statistiques" data-fancybox-type="iframe"></a>

    <script type="text/javascript" >
        $(function () {

            if (getCookie("cookieAudio") == null) {
                setCookie("cookieAudio", "On");
            }

            $.contextMenu({
                selector: 'body',
                zIndex: 99999,
                duration: 500, show: "slideDown", hide: "slideUp",
                callback: function (key, options) {
                    if (key == "apropos") {
                        Ajax('pages/Presentation.php');
                    } else if (key == "facebook") {
                        window.open("https://www.facebook.com/groups/vamosmt2", "_blank");
                    } else if (key == "twitter") {
                        window.open("https://twitter.com/VamosMT2", "_blank");
                    } else if (key == "youtube") {
                        window.open("https://www.youtube.com/VamosMt2", "_blank");
                    } else if (key == "teamspeack") {
                        window.open("ts3server://ts3.vamosmt2.org", "_top");
                    } else if (key == "equipe") {
                        Ajax('pages/Equipe.php');
                    } else if (key == "pilori") {
                        Ajax('pages/Pilori.php');
                    } else if (key == "stati") {
                        $("#Lien_Statistiques").click();
                        Barre_De_Statut("Ouverture des statistiques...");
                        Icone_Chargement(1);
                    } else if (key == "calen") {
                        Ajax("pages/Calendrier.php");
                    } else if (key == "securite") {
                        Ajax("pages/Securite.php");
                    }
                },
                items: {
                    "facebook": {name: " Notre page Facebook ", icon: "facebook"},
                    "twitter": {name: " Notre page Twitter ", icon: "twitter"},
                    "youtube": {name: " Notre chaîne Youtube ", icon: "youtube"},
                    "teamspeack": {name: " Se connecter au TeamSpeak ", icon: "teamspeack"},
                    "sep1": "---------",
                    "calen": {name: " Calendrier des events ", icon: "calen"},
                    "stati": {name: " Statistiques ", icon: "stati"},
                    "pilori": {name: " Pilori ", icon: "pilori"},
                    "securite": {name: " Conseils de s&eacute;curit&eacute; ", icon: "equipe"},
                    "sep2": "---------",
                    "apropos": {name: " A propos de VamosMt2... ", icon: "apropo"}
                }
            });

        });
    </script>
    <script type="text/javascript">
<?php if (isset($_GET["version"])) { ?>
            Ajax('pages/Version.php');
<?php } elseif (isset($_GET["ok"])) { ?>
            Ajax('pages/Bienvenue.php');
<?php } elseif (isset($_GET["paypal"])) { ?>
            Ajax('pages/Paypal.php');
<?php } else { ?>
            Ajax('pages/Accueil.php');
<?php } ?>
    </script>  
</html>
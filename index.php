<?php
require __DIR__ . '/core/initialize.php';

class IndexWebsite extends PageHelper {

    public function __construct() {
        parent::__construct();
        global $session;

        if ($session->get("estAdmin") !== null) {
            parent::LoadAdminSessionValues();
        }
    }

    public function run() {

        global $request;
        global $config;
        global $session;
        $cacheManager = \CacheHelper::getCacheManager();
        ?>

        <!DOCTYPE html>
        <html>
            <head>

                <meta charset="UTF-8">
                <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

                <link rel="icon" type="image/png" href="images/favicon.png" />

                <title><?= $config["nameServer"] ?> :: Site Officiel</title>

                <link href="./css/css/Bootstrap.css" rel="stylesheet" type="text/css" />
                <link href="./css/css/AdminLTE.css" rel="stylesheet" type="text/css" />
                <link href="./vendor/almasaeed2010/adminlte/plugins/select2/select2.min.css" rel="stylesheet" type="text/css" />
                <link href="assets/js/toastr/build/toastr.min.css" rel="stylesheet" type="text/css" />
                <link href="assets/js/datatables/extras/Responsive/css/dataTables.responsive.min.css" rel="stylesheet" type="text/css" />

                <link href="./css/css/styles.css" rel="stylesheet" type="text/css" />

                <script src='./components/jquery/jquery.min.js' type='text/javascript'></script>
                <script src='./components/jquery-ui/jquery-ui.min.js' type='text/javascript'></script>
                <script src='./components/bootstrap/js/tab.js' type='text/javascript'></script>
                <script src='./components/bootstrap/js/modal.js' type='text/javascript'></script>
                <script src='./components/bootstrap/js/dropdown.js' type='text/javascript'></script>

                <script src='./vendor/almasaeed2010/adminlte/plugins/slimScroll/jquery.slimscroll.min.js' type='text/javascript'></script>
                <script src='./vendor/almasaeed2010/adminlte/plugins/select2/select2.min.js' type='text/javascript'></script>
                <script data-pace-options='{ "restartOnRequestAfter": 10 }' src='./vendor/almasaeed2010/adminlte/plugins/pace/pace.js' type='text/javascript'></script>
                <script src='./vendor/almasaeed2010/adminlte/plugins/select2/i18n/fr.js' type='text/javascript'></script>
                <script src='./vendor/almasaeed2010/adminlte/dist/js/app.min.js' type='text/javascript'></script>

                <script src="assets/js/toastr/build/toastr.min.js" type='text/javascript'></script>
                <script src="assets/js/jquery.cookie/js.cookie.min.js" type='text/javascript'></script>
                <script src="assets/js/fonctions.min.js" type='text/javascript'></script>

                <?php if ($config["templateMod"] == "christmas") { ?>
                    <script src="assets/js/snowstorm/snowstorm.min.js" type='text/javascript'></script>
                    <script type="text/javascript">
                        snowStorm.followMouse = false;
                        snowStorm.usePositionFixed = true;
                    </script>
                    <link href="./css/css/modes/christmas.css" rel="stylesheet" type="text/css" />
                <?php } ?>

                <?php if ($config["templateMod"] == "halloween") { ?>
                    <link href="./css/css/modes/halloween.css" rel="stylesheet" type="text/css" />
                <?php } ?>

                <script src="assets/js/Ajax.js" type='text/javascript'></script>

                <?php if ($config["contextMenu"]["activate"]) { ?>
                    <script src="assets/js/jquery.contextMenu/jquery.contextMenu.min.js" type='text/javascript'></script>
                <?php } ?>

                <script src="assets/js/jquery.countdown/jquery.countdown.min.js" type='text/javascript'></script>
                <script src="assets/js/bootbox/bootbox.min.js" type='text/javascript'></script>

                <link href="assets/js/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />

                <script src="assets/js/datatables/js/jquery.dataTables.min.js" type='text/javascript'></script>
                <script src="assets/js/datatables/js/dataTables.bootstrap.min.js" type='text/javascript'></script>
                <script src="assets/js/datatables/js/jquery.dataTables.columnFilter.min.js" type='text/javascript'></script>
                <script src="assets/js/datatables/js/jquery.dataTables.StandingRedraw.min.js" type='text/javascript'></script>
                <script src="assets/js/datatables/extras/Responsive/js/dataTables.responsive.min.js" type='text/javascript'></script>

                <link href="assets/js/featherlight/release/featherlight.min.css" rel="stylesheet" type="text/css" />
                <script src="assets/js/featherlight/release/featherlight.min.js" type='text/javascript'></script>

                <link href="vendor/almasaeed2010/adminlte/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
                <link href="vendor/almasaeed2010/adminlte/plugins/iCheck/minimal/blue.css" rel="stylesheet" type="text/css" />
                <script src="vendor/almasaeed2010/adminlte/plugins/iCheck/icheck.min.js" type='text/javascript'></script>

                <!--[if lt IE 9]>
                <script src="./vendor/afarkas/html5shiv/dist/html5shiv.min.js"></script>
                <script src="./vendor/rogeriopradoj/respond/dest/respond.min.js"></script>
                <![endif]-->

                <!--[if lt IE 11]>
                <link rel="icon" type="image/ico" href="images/favicon.ico" />
                <![endif]-->

            </head>

            <body class="skin-red fixed" >

                <div class="wrapper">

                    <div style="position: fixed; top: 11px; left:8px; z-index: 999990;">
                        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                            <i class="material-icons md-icon-menu md-24"></i>
                        </a>
                    </div>

                    <div id="Barre_Haut">
                        <div id="Ajax_Connexion">
                            <?php
                            if (!$this->isConnected) {
                                $templateHeadbar = $this->objTwig->loadTemplate("headbarForm.html5.twig");
                                echo $templateHeadbar->render([]);
                            } else {
                                $templateHeadbar = $this->objTwig->loadTemplate("headbarConnected.html5.twig");
                                echo $templateHeadbar->render(["objAccount" => $this->objAccount]);
                            }
                            ?>

                        </div>
                    </div>

                    <div class="clear"></div>

                    <aside class="main-sidebar" style="background: #131313; border-right: 1px solid #3E3E3E;">
                        <section class="sidebar">
                            <?php
                            $templateMenu = $this->objTwig->loadTemplate("leftMenu.html5.twig");
                            echo $templateMenu->render(["isConnected" => $this->isConnected]);
                            ?>
                        </section>
                    </aside>

                    <div class="content-wrapper">

                        <div id="logo">
                            <img height="75" width="360" src="./images/logo.svg" onerror="this.src='./images/logo.png'">
                        </div>


                        <div class="col-md-12" style="padding-bottom: 60px;">
                            <div class="row">
                                <?php if ($this->isAdmin && !$this->isBanned) { ?>
                                    <?php include 'pages/Admin/Accueil_Seconde.php'; ?>
                                <?php } else { ?>
                                    <?php include 'pages/_LegacyPages/Accueil.php'; ?>
                                <?php } ?>

                            </div>
                        </div>

                    </div>

                    <footer>
                        <div class="col-md-12">
                            <?php
                            $templateFooter = $this->objTwig->loadTemplate("footer.html5.twig");
                            echo $templateFooter->render(["isConnected" => $this->isConnected]);
                            ?>
                            <div class="clearfix"></div>
                        </div>
                    </footer>
                </div>
                <div id="overlayMt2"></div>
            </body>

            <script type="text/javascript">

        <?php if ($config["contextMenu"]["activate"]) { ?>
                        $(function () {
                            
                            var arrItems = {};
            <?php if ($config["contextMenu"]["facebook"]) { ?>
                <?php if ($config["sociale"]["facebook"]["activate"]) { ?>
                                    arrItems["facebook"] = {name: "Page Facebook"};
                <?php } ?>
            <?php } ?>
            <?php if ($config["contextMenu"]["twitter"]) { ?>
                <?php if ($config["sociale"]["twitter"]["activate"]) { ?>
                                    arrItems["twitter"] = {name: "Page Twitter"};
                <?php } ?>
            <?php } ?>
            <?php if ($config["contextMenu"]["youtube"]) { ?>
                <?php if ($config["sociale"]["youtube"]["activate"]) { ?>
                                    arrItems["youtube"] = {name: "Chaîne Youtube"};
                <?php } ?>
            <?php } ?>

            <?php if ($config["contextMenu"]["teamspeack"]) { ?>
                <?php if ($config["sociale"]["teamspeack"]["activate"]) { ?>
                                    arrItems["teamspeack"] = {name: "TeamSpeak"};
                <?php } ?>
            <?php } ?>
            <?php if ($config["contextMenu"]["calendar"]) { ?>
                                arrItems["calen"] = {name: "Calendrier"};
            <?php } ?>
            <?php if ($config["contextMenu"]["statistiques"]) { ?>
                                arrItems["stati"] = {name: "Statistiques"};
            <?php } ?>
            <?php if ($config["contextMenu"]["pilori"]) { ?>
                                arrItems["pilori"] = {name: "Pilori"};
            <?php } ?>
                
                            $.contextMenu({
                                selector: 'body',
                                zIndex: 99999,
                                duration: 500, show: "slideDown", hide: "slideUp",
                                callback: function (key, options) {
                                    if (key == "facebook") {
                                        window.open("<?= $config["sociale"]["facebook"]["url"] ?>", "_blank");
                                    } else if (key == "twitter") {
                                        window.open("<?= $config["sociale"]["twitter"]["url"] ?>", "_blank");
                                    } else if (key == "youtube") {
                                        window.open("<?= $config["sociale"]["youtube"]["url"] ?>", "_blank");
                                    } else if (key == "teamspeack") {
                                        window.open("ts3server://<?= $config["sociale"]["teamspeack"]["url"] ?>", "_top");
                                    } else if (key == "pilori") {
                                        Ajax('pages/_LegacyPages/Pilori.php');
                                    } else if (key == "stati") {
                                        Ajax("pages/Statistiques/Statistiques.php");
                                    } else if (key == "calen") {
                                        Ajax("pages/_LegacyPages/Calendrier.php");
                                    }
                                },
                                items: arrItems
                            });
                        });
        <?php } ?>

        <?php if ($request->query->get("ok") !== null) { ?>
                        Ajax('pages/_LegacyPages/AccountActivationTerm.php');
        <?php } elseif ($request->query->get("paypal") !== null) { ?>
                        Ajax('pages/_LegacyPages/PaypalTerm.php');
        <?php } else { ?>

            <?php if ($session->get("estAdmin") !== null) { ?>
                            Ajax('pages/Admin/Bienvenu.php');
            <?php } ?>

        <?php } ?>
            </script>  

            <?php if ($this->isConnected) { ?>
                <script type="text/javascript">Actualisation_Messages_Sans_Boucle();</script> 
            <?php } ?>

        </html>
        <?php
    }

}

$class = new IndexWebsite();
$class->run();

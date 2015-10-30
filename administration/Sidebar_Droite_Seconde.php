<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php if (empty($_SESSION["Administration_PannelAdmin_Jeton"]) || ($_SESSION["Administration_PannelAdmin_Jeton"] != $_POST["numero"])) { ?>
    <div class="Menu_Sidebar">
        <div class="Menu_Sidebar_Haut Pointer No_Select" onclick="Slider_Sidebar_Droite_2();">Serveur Classyd</div>
        <div class="Menu_Sidebar_Milieu" id="Div_Sidebar_Droite_2">
            L'accès à cette section vous est interdite.
        </div>
    </div>
    <?php exit(); ?>
<?php } ?>
<?php @include '../configPDO.php'; ?>
<?php
/* ------------------------ Vérification Données ---------------------------- */
$Recuperation_Droits = "SELECT * 
                        FROM $BDD_Site.administration_users
                        WHERE id_compte = :id_compte
                        LIMIT 1";
$Parametres_Recuperation_Droits = $Connexion->prepare($Recuperation_Droits);
$Parametres_Recuperation_Droits->execute(array(':id_compte' => $_SESSION["ID"]));
$Parametres_Recuperation_Droits->setFetchMode(PDO::FETCH_OBJ);
$Donnees_Recuperation_Droits = $Parametres_Recuperation_Droits->fetch();
/* -------------------------------------------------------------------------- */
?>

<div class="Menu_Sidebar">
    <div class="Menu_Sidebar_Haut Pointer No_Select" onclick="Slider_Sidebar_Droite_1();">Module gestion</div>
    <div class="Menu_Sidebar_Milieu" id="Div_Sidebar_Droite_1">
        <table class="Table_Menu_Administration">
            <?php if ($Donnees_Recuperation_Droits->gerer_monnaies == 1) { ?>
                <tr data-fancybox-type="iframe" class="fancybox_monnaies" href="administration/includes/Gestion_Monnaies.php"><td>- Gestion des monnaies</td></tr>

                <script type="text/javascript">
                    $(document).ready(function() {
                        $(".fancybox_monnaies").fancybox({
                            minWidth	: 800,
                            minHeight	: 540,
                            maxHeight	: 540,
                            padding     : 0,
                            closeBtn    : false,
                            scrolling   : 'no',
                            scrollOutside   : false,
                            fitToView	: true,
                            autoSize	: false,
                            closeClick	: false,
                            openEffect	: 'elastic',
                            closeEffect	: 'elastic',
                            openSpeed   : 400,
                            closeSpeed   : 200
                        });
                    });    
                </script>
            <?php } ?>
            <?php if ($Donnees_Recuperation_Droits->gerer_news == 1) { ?>
                <tr data-fancybox-type="iframe" class="fancybox_news" href="administration/includes/Gestion_News.php"><td>- Gestion des news</td></tr>

                <script type="text/javascript">
                    $(document).ready(function() {
                        $(".fancybox_news").fancybox({
                            minWidth	: 1200,
                            minHeight	: 550,
                            maxHeight	: 550,
                            padding     : 0,
                            closeBtn    : false,
                            scrolling   : 'no',
                            scrollOutside   : false,
                            fitToView	: true,
                            autoSize	: false,
                            closeClick	: false,
                            openEffect	: 'elastic',
                            closeEffect	: 'elastic',
                            openSpeed   : 400,
                            closeSpeed   : 200
                        });
                    });    
                </script>
            <?php } ?>
        </table>
    </div>
</div>

<div class="Menu_Sidebar">
    <div class="Menu_Sidebar_Haut Pointer No_Select" onclick="Slider_Sidebar_Droite_2();">Serveur Classyd</div>
    <div class="Menu_Sidebar_Milieu" id="Div_Sidebar_Droite_2">

        <script type="text/javascript" src="js/Actualisation_Status.js"></script>

        <table class="Table_Status_Serveurs">
            <tr><td colspan="3"><div class="barre"></div></td></tr>
            <tr class="Pointer" onmouseover="this.style.backgroundColor='#666666';" onmouseout="this.style.backgroundColor='transparent';">
                <td>
                    Status du serveur :
                </td>		
                <?php
                $port = '3306';
                $ip = '94.23.6.155';

                if (!$sock = @fsockopen($ip, $port, $num, $error, 0.5)) {
                    ?> <td id="ServeurClassyd" class="Align_Right"><img class="Ombre_Grise_2 Deplacement_Bouton_Status" title="Hors-Ligne" src="images/offline.gif" /></td> <?php
            } else {
                    ?> <td id="ServeurClassyd" class="Align_Right"><img class="Ombre_Grise_2 Deplacement_Bouton_Status" title="En Ligne" src="images/online.gif" /></td> <?php
                    fclose($sock);
                }
                ?>
            </tr>
            <tr><td colspan="3"><div class="barre"></div></td></tr>

            <tr title="A 5 minute près" class="Pointer" onmouseover="this.style.backgroundColor='#666666';" onmouseout="this.style.backgroundColor='transparent';">

                <td>
                    Joueurs connectés :
                </td>

                <?php
                /* ------------------------------ Vérification connecte ---------------------------------------------- */
                $Comptage_Connectes = "SELECT id FROM player.player
                          WHERE player.last_play >= (NOW() - INTERVAL 90 MINUTE)";
                $Parametres_Comptage_Connectes = $Connexion->prepare($Comptage_Connectes);
                $Parametres_Comptage_Connectes->execute();
                $Parametres_Comptage_Connectes->setFetchMode(PDO::FETCH_OBJ);
                $Nombre_De_Resultat = $Parametres_Comptage_Connectes->rowCount();
                /* -------------------------------------------------------------------------------------------------- */
                ?>

                <td id="nombreconnecter" class="Align_Right Decalage_Nombre_Co"><?php echo $Nombre_De_Resultat; ?></td>
            </tr>

            <tr><td colspan="3"><div class="barre"></div></td></tr>
        </table>

        <script type="text/javascript">
            setInterval("ServeurClassyd()", "60000");
        </script>
        <script type="text/javascript">
            setInterval("JoueursConnectes()", "30000");
        </script>

    </div>
</div>
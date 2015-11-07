<?php
/* ------------------------ Vérification Données ---------------------------- */
$Recuperation_Droits = "SELECT * 
FROM site.administration_users
WHERE id_compte = :id_compte
LIMIT 1";
$Parametres_Recuperation_Droits = $this->objConnection->prepare($Recuperation_Droits);
$Parametres_Recuperation_Droits->execute(array(':id_compte' => $_SESSION["ID"]));
$Parametres_Recuperation_Droits->setFetchMode(\PDO::FETCH_OBJ);
$Donnees_Recuperation_Droits = $Parametres_Recuperation_Droits->fetch();
/* -------------------------------------------------------------------------- */
?>

<div class="box box-default flat">
    <div class="box-header">
        <h3 class="box-title">Gestion</h3>
    </div>
    <div class="box-body no-padding hidden-sm hidden-xs">

        <table class="table table-condensed" style="border-collapse: collapse;">
            <?php if ($Donnees_Recuperation_Droits->gerer_monnaies == 1) { ?>
                <tr data-fancybox-type="iframe" class="fancybox_monnaies" href="administration/includes/Gestion_Monnaies.php"><td>- Gestion des monnaies</td></tr>

                <script type="text/javascript">
                    $(document).ready(function () {
                        $(".fancybox_monnaies").fancybox({
                            minWidth: 800,
                            minHeight: 540,
                            maxHeight: 540,
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
            <?php } ?>
            <?php if ($Donnees_Recuperation_Droits->gerer_news == 1) { ?>
                <tr data-fancybox-type="iframe" class="fancybox_news" href="administration/includes/Gestion_News.php"><td>- Gestion des news</td></tr>

                <script type="text/javascript">
                    $(document).ready(function () {
                        $(".fancybox_news").fancybox({
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
                </script>
            <?php } ?>
        </table>
    </div>
</div>


<?php include 'pages/_Home/includes/StatutServer.php'; ?>

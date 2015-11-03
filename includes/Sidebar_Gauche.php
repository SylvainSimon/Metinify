<?php
srand();
$files = array("ClassementJoueursPvETop5.php", "ClassementJoueursPvETop5.php");
$rand = array_rand($files);
include ("pages/Classements/includes/".$files[$rand]);
?>

<?php include './pages/Fonctions_Utiles.php'; ?>

<script type="text/javascript">

    $(function () {
        $.superbox.settings = {
            closeTxt: "Fermer",
            loadTxt: "Chargement...",
            boxWidth: "1200",
            boxHeight: "445"
        };
        $.superbox();
    });
</script>

<div class="info-box flat box-telechargement-exe" onclick="Ajax('pages/_LegacyPages/Telechargement.php')">
    
    <span class="info-box-icon"><i class="material-icons md-icon-download md-36"></i></span>

    <div class="info-box-content">
        <span class="info-box-text">Télécharger</span>

        <?php
        $url = 'http://vamosmt2.org:81/Installateur%20VamosMT2%20Client%20officiel%202014-2015.exe';
        $headers = get_headers($url, true);

        if (isset($headers['Content-Length'])) {
            $size = $headers['Content-Length'];
        } else {
            $size = 0;
        }
        ?>

        <span class="info-box-number"><?php echo Formatage_Taille($size); ?></span>
    </div>
    <!-- /.info-box-content -->
</div>

<div class="box box-default flat">
    <div class="box-body no-padding">
        <a href="trailer.php" onclick="Icone_Chargement(1);
                Barre_De_Statut('Ouverture du trailer...')" class="fancybox_Trailer" data-fancybox-type="iframe">

            <img class="ImageVideoNouveaute" src="./images/trailer.png" />
        </a>
    </div>
</div>
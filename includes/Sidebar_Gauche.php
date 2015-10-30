<?php @include '../configPDO.php'; ?>
<?php
srand();

$files = array("Top_5_PvE.php", "Top_5_PvE.php");
$rand = array_rand($files);
include ($files[$rand]);
?>


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

<div class="info-box flat" style="background-color: #6D1A0C !important; cursor: pointer;" onclick="window.open('http://vamosmt2.org:81/Installateur%20VamosMT2%20Client%20officiel%202014-2015.exe', '_self')">
    
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
    <div class="box-header">
        <h3 class="box-title">Trailer</h3>
    </div>
    <div class="box-body no-padding">
        <a href="trailer.php" onclick="Icone_Chargement(1);
                Barre_De_Statut('Ouverture du trailer...')" class="fancybox_Trailer" data-fancybox-type="iframe">

            <img class="ImageVideoNouveaute" src="./images/trailer.png" />
        </a>
    </div>
</div>
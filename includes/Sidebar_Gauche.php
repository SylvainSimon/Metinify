<?php @include '../configPDO.php'; ?>
 <?php

srand();

$files = array("Top_5_PvE.php", "Top_5_PvE.php");

$rand = array_rand($files);

include ($files[$rand]);

?>


<script type="text/javascript">

    $(function(){
        $.superbox.settings = {
            closeTxt: "Fermer",
            loadTxt: "Chargement...",
            boxWidth: "1200",
            boxHeight: "445"
        };
        $.superbox();
    });
</script>

<div class="Menu_Sidebar">
    <div class="Menu_Sidebar_Haut Pointer No_Select" onclick="Slider_Sidebar_Gauche_2();">Télécharger le client</div>
    <div class="Menu_Sidebar_Milieu" id="Div_Sidebar_Gauche_2">
        <img src="images/telecharger.png" width="198" class="Bouton_Telecharger_Accueil Pointer" onclick="window.open('http://vamosmt2.org:81/Installateur%20VamosMT2%20Client%20officiel%202014-2015.exe', '_self')"/>
    </div>
</div>
<div class="Menu_Sidebar">
    <div class="Menu_Sidebar_Haut Pointer No_Select" onclick="Slider_Sidebar_Gauche_3();">Trailer officiel</div>
    <div class="Menu_Sidebar_Milieu" id="Div_Sidebar_Gauche_3">
        <a href="trailer.php" onclick="Icone_Chargement(1); Barre_De_Statut('Ouverture du trailer...')" class="fancybox_Trailer" data-fancybox-type="iframe"><div class="ImageVideoNouveauté"></div></a>
    </div>
</div>
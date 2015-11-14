<?php
$typeTop = array("PVE", "PVP");
$typeResult = array_rand($typeTop);
if ($cacheManager->isExisting("arrObjPlayersTop" . $typeResult)) {
    $arrObjPlayers = $cacheManager->get("arrObjPlayersTop" . $typeResult);
} else {
    $arrObjPlayers = Player\PlayerHelper::getPlayerRepository()->findTop($typeTop[$typeResult], 6);
    $cacheManager->set("arrObjPlayersTop" . $typeResult, $arrObjPlayers, 21600);
}

$templateTop = $this->objTwig->loadTemplate("ClassementJoueurTop" . $typeTop[$typeResult] . ".html5.twig");
$view = $templateTop->render(["arrObjPlayers" => $arrObjPlayers]);
echo $view;
?>

<div class="info-box flat box-telechargement-exe" onclick="Ajax('pages/_LegacyPages/Telechargement.php')">

    <span class="info-box-icon"><i class="material-icons md-icon-download md-36"></i></span>

    <div class="info-box-content">
        <span class="info-box-text">Télécharger</span>

        <?php
        $urlClient = $config->linkClient;
        if ($cacheManager->isExisting("sizeOfClient")) {
            $size = $cacheManager->get("sizeOfClient");
        } else {
            $size = \FonctionsUtiles::sizeOfFileExt($urlClient);
            $cacheManager->set("sizeOfClient", $size, 21600);
        }
        ?>

        <span class="info-box-number"><?php echo \FonctionsUtiles::Formatage_Taille($size); ?></span>
    </div>
</div>

<div class="box box-default flat">
    <div class="box-body no-padding">
        <a href="trailer.php" onclick="Icone_Chargement(1);
                Barre_De_Statut('Ouverture du trailer...')" class="fancybox_Trailer" data-fancybox-type="iframe">

            <img class="ImageVideoNouveaute" src="./images/trailer.png" />
        </a>
    </div>
</div>
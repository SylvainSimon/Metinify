<nav class="col-lg-2 col-md-3 hidden-sm hidden-xs">
    <?php
    include 'pages/_Home/Sidebar_Gauche.php';
    ?>
</nav>

<div id="Contenue_Principal" class="col-lg-8 col-md-6 col-sm-12">
    <?php if ($this->isConnected) { ?>
        <?php if ($this->objAccount->getStatus() == StatusHelper::BANNI) { ?>
            <?php include 'pages/_LegacyPages/Bannissement.php'; ?>
        <?php } elseif ($this->objAccount->getStatus() == StatusHelper::NON_CONFIRME) { ?>
            <?php include 'pages/_LegacyPages/AttenteConfirmation.php'; ?>
        <?php } else { ?>
            <?php
            $arrObjActualites = \Site\SiteHelper::getActualitesRepository()->findNews(4);
            $templateTop = $this->objTwig->loadTemplate("News.html5.twig");
            $view = $templateTop->render(["arrObjActualites" => $arrObjActualites]);
            echo $view;
            ?>
        <?php } ?>
    <?php } else { ?>
        <?php
        $arrObjActualites = \Site\SiteHelper::getActualitesRepository()->findNews(4);
        $templateTop = $this->objTwig->loadTemplate("News.html5.twig");
        $view = $templateTop->render(["arrObjActualites" => $arrObjActualites]);
        echo $view;
        ?>
    <?php } ?>
</div> 

<nav class="col-lg-2 col-md-3 hidden-sm hidden-xs">
    <?php
    include 'pages/_Home/Sidebar_Droite.php';
    ?>
</nav>
<nav class="col-lg-2 col-md-3 hidden-sm hidden-xs">
    <?php
    include 'pages/_Home/Sidebar_Gauche.php';
    ?>
</nav>

<div id="Contenue_Principal" class="col-lg-8 col-md-6 col-sm-12">
    <?php
    $arrObjAdminNews = \Site\SiteHelper::getAdminNewsRepository()->findNews(4);
    $templateTop = $this->objTwig->loadTemplate("News.html5.twig");
    $view = $templateTop->render(["arrObjAdminNews" => $arrObjAdminNews]);
    echo $view;
    ?>

</div> 

<nav class="col-lg-2 col-md-3 hidden-sm hidden-xs">
    <?php
    include 'pages/_Home/Sidebar_Droite.php';
    ?>
</nav>
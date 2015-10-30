<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php if (empty($_SESSION["Administration_PannelAdmin_Jeton"]) || ($_SESSION["Administration_PannelAdmin_Jeton"] != $_POST["numero"])) { ?>
<div class="Cadre_Principal">
    <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal(1);">                  
        <h1>Accès interdit</h1>
    </div>
    <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1"> 
        Vous n'avez pas le droit d'accèder à cette section.
    </div>
</div>
    <?php exit(); ?>
<?php } ?>
<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php @include '../configPDO.php'; ?>
<?php @include '../pages/Fonctions_Utiles.php'; ?>

<div class="Cadre_Principal">

    <div class="Cadre_Principal_Haut Pointer No_Select" onclick="Slider_Cadre_Principal(1);">                  
        <h1>Accueil de l'administration</h1>
    </div>
    <div class="Cadre_Principal_Milieu" id="Div_Cadre_Principal_1"> 
        Bienvenue sur le panneau d'administration.
    </div>

</div>
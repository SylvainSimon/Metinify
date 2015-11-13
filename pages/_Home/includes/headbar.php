<div style="position: fixed; top: 11px; left:8px; z-index: 999990;">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <i class="material-icons md-icon-menu md-24"></i>
    </a>
</div>

<?php if (!$this->isConnected) { ?>

    <div id="Barre_Haut">
        <div id="Ajax_Connexion">
            <?php
            $templateHeadbar = $this->objTwig->loadTemplate("headbarForm.html5.twig");
            $view = $templateHeadbar->render([]);
            echo $view;
            ?>
        </div>
    </div>

<?php } else { ?>

    <div id="Barre_Haut">
        <div id="Ajax_Connexion">
            <?php
            $templateHeadbar = $this->objTwig->loadTemplate("headbarConnected.html5.twig");
            $view = $templateHeadbar->render([]);
            echo $view;
            ?>
        </div>
    </div>

<?php } ?>

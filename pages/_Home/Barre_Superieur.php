<div style="position: fixed; top: 11px; left:8px; z-index: 9999999;">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <i class="material-icons md-icon-menu md-24"></i>
    </a>
</div>

<?php if (empty($_SESSION['Utilisateur'])) { ?>

    <div id="Barre_Haut">
        <div id="Ajax_Connexion">
            <?php include 'includes/Barre_Superieur_Formulaire.php'; ?>
        </div>
    </div>

<?php } else { ?>

    <div id="Barre_Haut">
        <div id="Ajax_Connexion">
            <?php include 'includes/Barre_Superieur_Connectes.php'; ?>
        </div>
    </div>

<?php } ?>
</div>
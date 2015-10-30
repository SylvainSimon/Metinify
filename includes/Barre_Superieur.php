<?php @session_write_close(); ?>
<?php @session_start(); ?>

<?php if (empty($_SESSION['Utilisateur'])) { ?>

    <div id="Barre_Haut">
        <div id="Ajax_Connexion">
            <?php include 'Barre_Superieur_Formulaire.php'; ?>
        </div>
    </div>

<?php } else { ?>

    <div id="Barre_Haut">
        <div id="Ajax_Connexion">
            <?php include 'Barre_Superieur_Connectes.php'; ?>
        </div>
    </div>

<?php } ?>
</div>
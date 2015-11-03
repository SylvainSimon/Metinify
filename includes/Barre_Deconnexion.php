<?php
require __DIR__ . '../../core/initialize.php';

if (!empty($_SESSION['Administration_PannelAdmin'])) {

    /* -------------- Suppression jetons ----------------------------------------------------- */
    $Delete_Jetons = "DELETE 
                      FROM site.administration_pannel_jetons
                      WHERE id_compte = :id_compte
                      AND jeton = :jeton";

    $Parametres_Delete_Jetons = $this->objConnection->prepare($Delete_Jetons);
    $Parametres_Delete_Jetons->execute(
            array(
                ':id_compte' => $_SESSION["ID"],
                ':jeton' => $_SESSION["Administration_PannelAdmin_Jeton"]
            )
    );
    /* -------------------------------------------------------------------------------------------- */
    ?>
    <script type="text/javascript">
        $("#Icone_Administration_Acces").remove();
        Retablissement_Du_Decors();
    </script>
<?php } else { ?>
    <script type="text/javascript">

        Ajax('pages/_LegacyPages/Accueil.php');
    </script>
<?php } ?>

<?php SessionHelper::destroySession(); ?>

<script type="text/javascript">

    document.getElementById('Menu_Inscription_MonCompte').style.display = 'none';
    document.getElementById('Menu_Inscription_MonCompte2').style.display = 'inline';

    document.getElementById('Menu_Telechargement_ItemShop').style.display = 'none';
    document.getElementById('Menu_Telechargement_ItemShop2').style.display = 'inline';

    document.getElementById('Menu_Support').style.display = 'none';
    document.getElementById('Menu_Support2').style.display = 'inline';

    document.getElementById('Menu_Telechargement_Equipe').style.display = 'none';
    document.getElementById('Menu_Telechargement_Equipe2').style.display = 'inline';

</script>

<script type="text/javascript">
    Ajax_Connexion('includes/Barre_Superieur_Formulaire.php');
</script>

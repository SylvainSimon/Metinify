<?php

namespace Home;

require __DIR__ . '../../../../core/initialize.php';

$session = \SessionHelper::getSession();
$etaitAdmin = $session->get("Administration_PannelAdmin");
$connexion = \PDOHelper::getConnexion();

if ($session->get("Administration_PannelAdmin")) {

    /* -------------- Suppression jetons ----------------------------------------------------- */
    $Delete_Jetons = "DELETE 
                      FROM site.administration_pannel_jetons
                      WHERE id_compte = :id_compte
                      AND jeton = :jeton";

    $Parametres_Delete_Jetons = $connexion->prepare($Delete_Jetons);
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
    </script>
<?php } else { ?>
    <script type="text/javascript">
        Ajax('pages/_LegacyPages/News.php');
    </script>
<?php } ?>

<?php \SessionHelper::destroySession(); ?>

<script type="text/javascript">

<?php if ($etaitAdmin !== null) { ?>
        $("#overlayMt2").html('<div style="position: relative;top: 45%;width: 431px; margin: 0 auto 0 auto;"><h2>Sortie de l\'administration...</h2></div>');
        $("#overlayMt2").css('display', "inline");
        location.reload(false);
<?php } else { ?>
        document.getElementById('Menu_Inscription_MonCompte').style.display = 'none';
        document.getElementById('Menu_Inscription_MonCompte2').style.display = 'inline';

        document.getElementById('Menu_Telechargement_ItemShop').style.display = 'none';
        document.getElementById('Menu_Telechargement_ItemShop2').style.display = 'inline';

        document.getElementById('Menu_Support').style.display = 'none';
        document.getElementById('Menu_Support2').style.display = 'inline';

        document.getElementById('Menu_Telechargement_Equipe').style.display = 'none';
        document.getElementById('Menu_Telechargement_Equipe2').style.display = 'inline';
        Ajax_Connexion('pages/_Home/includes/Barre_Superieur_Formulaire.php');
<?php } ?>
</script>

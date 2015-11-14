<?php

namespace Home;

require __DIR__ . '../../../../core/initialize.php';

$session = \SessionHelper::getSession();
$etaitAdmin = $session->get("Administration_PannelAdmin");
\SessionHelper::destroySession();
?>

<script type="text/javascript">

<?php if ($etaitAdmin !== null) { ?>
        $("#overlayMt2").html('<div style="position: relative;top: 45%;width: 431px; margin: 0 auto 0 auto;"><h2>Sortie de l\'administration...</h2></div>');
        $("#overlayMt2").css('display', "inline");
        location.reload(false);
<?php } else { ?>
        Ajax('pages/_LegacyPages/News.php');

        document.getElementById('Menu_Inscription_MonCompte').style.display = 'none';
        document.getElementById('Menu_Inscription_MonCompte2').style.display = 'inline';

        document.getElementById('Menu_Telechargement_ItemShop').style.display = 'none';
        document.getElementById('Menu_Telechargement_ItemShop2').style.display = 'inline';

        document.getElementById('Menu_Support').style.display = 'none';
        document.getElementById('Menu_Support2').style.display = 'inline';

        document.getElementById('Menu_Telechargement_Equipe').style.display = 'none';
        document.getElementById('Menu_Telechargement_Equipe2').style.display = 'inline';
        Ajax_Connexion('pages/_Home/includes/headbarForm.php');
<?php } ?>
</script>

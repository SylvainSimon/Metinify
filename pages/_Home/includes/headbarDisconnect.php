<?php

namespace Home;

require __DIR__ . '../../../../core/initialize.php';

$session = \SessionHelper::getSession();
$etaitAdmin = $session->get("estAdmin");
\SessionHelper::destroySession();
?>

<script type="text/javascript">

<?php if ($etaitAdmin !== null) { ?>
        $("#overlayMt2").html('<div style="position: relative;top: 45%;width: 431px; margin: 0 auto 0 auto;"><h2>Sortie de l\'administration...</h2></div>');
        $("#overlayMt2").css('display', "inline");
        location.reload(false);
<?php } else { ?>
        Ajax('pages/_LegacyPages/News.php');

        $("#Menu_Inscription_MonCompte").css("display", "none");
        $("#Menu_Inscription_MonCompte2").css("display", "inline");

        $("#Menu_Telechargement_ItemShop").css("display", "none");
        $("#Menu_Telechargement_ItemShop2").css("display", "inline");

        $("#Menu_Support").css("display", "none");
        $("#Menu_Support2").css("display", "inline");

        Ajax_Connexion('pages/_Home/includes/headbarForm.php');
<?php } ?>
</script>

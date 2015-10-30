<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include '../../configPDO.php'; ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <script type="text/javascript" src="../../js/Jquery 1.8.0.js"></script>
        <script type="text/javascript" src="../../js/ui/Jquery_UI_1.8.23.js"></script>
        <script src="../../js/Jquery_Superbox.js" type='text/javascript'></script>

        <link href="../../css/Jquery_Superbox.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="../../css/Marche.css">
        <link rel="stylesheet" href="../../css/jquery-ui-1.8.23.custom.css">

    </head>

    <body>
        <?php if (!empty($_SESSION['ID'])) { ?>

            <div id="Onglets">

                <ul class="user_no_select">

                    <li><a href="javascript:void(0)" onclick="Ajax_Appel_Marche('Marche_Place.php')">Place du marché</a></li>
                    <li><a href="javascript:void(0)" onclick="Ajax_Appel_Marche('Marche_Vendre_Personnage.php')">Vendre un personnage</a></li>
                    <li><a href="javascript:void(0)" onclick="Ajax_Appel_Marche('Marche_Mes_Ventes.php')">Mes ventes en cours</a></li>

                    <div class="Bouton_Fermer_Fenetre Pointer" onclick="window.parent.$.fancybox.close();"></div>

                </ul>

            </div>

            <div id="Contenue_Cadre_Marche"></div>

            <script type="text/javascript">
                                                    
                function Ajax_Appel_Marche(url){
                                                                
                    window.parent.Barre_De_Statut("Appel de l'onglet...");
                    window.parent.Icone_Chargement(1);
                                            
                    $.ajax({
                        type: "POST",
                        url: ""+url,
                        success: function(msg){

                            $("#Contenue_Cadre_Marche").fadeOut("medium", function(){
                                $("#Contenue_Cadre_Marche").html(msg);
                                window.parent.Barre_De_Statut("Chargement terminé.");
                                window.parent.Icone_Chargement(0);
                                $("#Contenue_Cadre_Marche").fadeIn("medium");
                            });
                                                                                        
                        }
                    });
                    return false;
                                                                                                    
                } 
                    
                Ajax_Appel_Marche("Marche_Place.php");
                            
            </script>


        <?php } else { ?>

            <?php include '../Onglet_Non_Connecter.php'; ?>

        <?php } ?>
    </body>
</html>


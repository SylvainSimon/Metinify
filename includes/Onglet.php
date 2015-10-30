<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php
if (empty($_SESSION['Utilisateur'])) {

    include 'Onglet_Non_Connecter.php';
    exit();
}
include '../pages/Tableaux_Arrays.php';
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="../css/demos.css">
        <link rel="stylesheet" href="../css/jquery-ui-1.8.23.custom.css">
        <script type="text/javascript" src="../js/Jquery 1.8.0.js"></script>
        <script type="text/javascript" src="../js/ui/Jquery_UI_1.8.23.js"></script>

        <script type="text/javascript">
            
            function Appel_Joueur(id){
                
                window.parent.Barre_De_Statut("Récuperation des données du joueur...");
                window.parent.Icone_Chargement(1);
                    
                $.ajax({
                    type: "POST",
                    url: "Appel_Joueur.php",
                    data: "id="+id, // données à transmettre
                    success: function(msg){
                        
                                    
                        $("#Appel_Fiche").fadeOut("medium", function(){
                            $("#Appel_Fiche").html(msg);
                            window.parent.Barre_De_Statut("Chargement terminé.");
                            window.parent.Icone_Chargement(0);
                            $("#Appel_Fiche").fadeIn("medium");
                        });
                            
                        nav = document.getElementById("Appel_Fiche");
                                                                                                                                                                    
                        var scripts = nav.getElementsByTagName('script');
                        for(var i=0; i < scripts.length;i++)
                        {
                            if (window.execScript)
                            {
                                window.execScript(scripts[i].text.replace('<!--',''));
                            }
                            else
                            {
                                window.eval(scripts[i].text);
                            }
                        }

                    }
                });
                return false;
            }
        
            function Appel_Compte(id){
            
                window.parent.Barre_De_Statut("Récuperation des données du compte...");
                window.parent.Icone_Chargement(1);
                
                $.ajax({
                    type: "POST",
                    url: "Appel_Compte.php",
                    data: "id="+id, // données à transmettre
                    success: function(msg){
                                
                        $("#Appel_Fiche").fadeOut("medium", function(){
                            $("#Appel_Fiche").html(msg);
                            window.parent.Barre_De_Statut("Chargement terminé.");
                            window.parent.Icone_Chargement(0);
                            $("#Appel_Fiche").fadeIn("medium");
                        });
                        
                        nav = document.getElementById("Appel_Fiche");
                                                                                                                                                                
                        var scripts = nav.getElementsByTagName('script');
                        for(var i=0; i < scripts.length;i++)
                        {
                            if (window.execScript)
                            {
                                window.execScript(scripts[i].text.replace('<!--',''));
                            }
                            else
                            {
                                window.eval(scripts[i].text);
                            }
                        }

                    }
                });
                return false;
            }    
        </script>

    </head>

    <body>

        <?php $Id_Fiche = $_GET['id']; ?>

        <?php if ($_GET['type'] == "joueur") { ?>

            <script type="text/javascript">
                                                            
                Appel_Joueur(<?php echo $Id_Fiche; ?>);
                                                        
            </script>

        <?php } else if ($_GET['type'] == "compte") { ?>

            <?php
            if ($_SESSION['ID'] != $_GET['id']) {

                include 'Onglet_Mauvais_Compte.php';
                exit();
            }
            ?>

            <script type="text/javascript">

                Appel_Compte(<?php echo $Id_Fiche; ?>);
                                                        
            </script>
        <?php } ?>

        <div id="Appel_Fiche">

        </div>
    </body>
</html>
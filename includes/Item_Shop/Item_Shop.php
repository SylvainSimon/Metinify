<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php include '../../configPDO.php'; ?>

<?php $Sauvegarder_ID = $_SESSION['ID']; ?>
<?php $Sauvegarder_Login = $_SESSION['Utilisateur']; ?>

<?php
if (empty($_SESSION['ID'])) {

    echo "Vous n'êtes pas connecté";
    exit();
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <script type="text/javascript" src="../../js/Jquery 1.8.0.js"></script>
        <script type="text/javascript" src="../../js/ui/Jquery_UI_1.8.23.js"></script>

        <link rel="stylesheet" href="../../css/Item_Shop.css">

    </head>

    <body>
        <div id="ItemShop_Partie_Haute">
            <span class="Titre_Fenetre_Item_Shop">Magasin d'items</span>
            <div onclick="Appel_Rechargement(<?php echo $Sauvegarder_ID; ?>, '<?php echo $Sauvegarder_Login; ?>');" class="Titre_Bouton_Recharger">
                Recharger mon compte
            </div>
            <div class="Bouton_Fermer_Fenetre Pointer" onclick="window.parent.$.fancybox.close();"></div>
        </div>

        <?php include_once 'Item_Shop_Categories.php'; ?>


        <div id="Item_Shop_Contenue">

            <?php include 'Partie_ItemShop.php'; ?>

        </div>

    </body>
</html>

<script type="text/javascript">
                                                                            
    function Appel_Rechargement(id_compte, login){
        
        window.parent.Barre_De_Statut("Ouverture de la zone de rechargement...");
        window.parent.Icone_Chargement(1);
	                                                       
        $.ajax({
            type: "POST",
            url: "Item_Shop_Rechargement_Accueil.php",
            data: "idcompte="+id_compte+"&nomCompte="+login,
            success: function(msg){
                                                                                        
                $("#Tableau_Liste_Article").fadeOut("slow", function(){
                    $("#Tableau_Liste_Article").html(msg);
                    window.parent.Barre_De_Statut("Chargement terminé.");
                    window.parent.Icone_Chargement(0);
                    $("#Tableau_Liste_Article").fadeIn("slow");
                });
                
                nav = document.getElementById("Tableau_Liste_Article");
                
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
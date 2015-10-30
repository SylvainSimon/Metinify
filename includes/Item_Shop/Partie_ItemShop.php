<div id="Contenue_Categorie">
    <div id="Tableau_Liste_Article">


    </div>

</div>
<script type="text/javascript">
                                                                            
    function Appel_Categorie_ItemShop(id){
        
        window.parent.Barre_De_Statut("Chargement de la catégorie...");
        window.parent.Icone_Chargement(1);
        
        $.ajax({
            type: "POST",
            url: "Appel_ItemShop.php",
            data: "id="+id,
            success: function(msg){
                                                                                        
                $("#Tableau_Liste_Article").fadeOut("slow", function(){
                    $("#Tableau_Liste_Article").html(msg);
                    window.parent.Barre_De_Statut("Catégorie chargé.");
                    window.parent.Icone_Chargement(0);
                    $("#Tableau_Liste_Article").fadeIn("slow");
                });
            }
        });
        return false;
                            
    }
                            
    Appel_Categorie_ItemShop(8);
                                                                        
</script>

<script type="text/javascript">
                                                                            
    function Detail_Article(id_recu){
        
        window.parent.Barre_De_Statut("Appel des détails de l'article...");
        window.parent.Icone_Chargement(1);
        
        $.ajax({
            type: "POST",
            url: "Appel_Detail_Article.php",
            data: "id_recu="+id_recu,
            success: function(msg){
                                                                                        
                $("#Tableau_Liste_Article").fadeOut("slow", function(){
                    $("#Tableau_Liste_Article").html(msg);
                    window.parent.Barre_De_Statut("Chargement terminé.");
                    window.parent.Icone_Chargement(0);
                    $("#Tableau_Liste_Article").fadeIn("slow");
                });
            }
        });
        return false;
                            
    }
                                                                        
</script>
<div id="Contenue_Categorie">
    <div id="Tableau_Liste_Article" style="padding-top: 10px;">

    </div>
</div>
<script type="text/javascript">

    function Appel_Categorie_ItemShop(id) {

        window.parent.Barre_De_Statut("Chargement de la catégorie...");
        window.parent.Icone_Chargement(1);

        $.ajax({
            type: "POST",
            url: "./includes/Item_Shop/Appel_ItemShop.php",
            data: "id=" + id,
            success: function (msg) {

                $("#Tableau_Liste_Article").html(msg);
                Barre_De_Statut("Catégorie chargé.");
                Icone_Chargement(0);
                redraw();

            }
        });
        return false;

    }

    Appel_Categorie_ItemShop(8);

</script>

<script type="text/javascript">

    function Detail_Article(id_recu) {

        window.parent.Barre_De_Statut("Appel des détails de l'article...");
        window.parent.Icone_Chargement(1);

        $.ajax({
            type: "POST",
            url: "./includes/Item_Shop/Appel_Detail_Article.php",
            data: "id_recu=" + id_recu,
            success: function (msg) {

                $("#Tableau_Liste_Article").html(msg);
                Barre_De_Statut("Chargement terminé.");
                Icone_Chargement(0);
                redraw();
            }
        });
        return false;

    }

</script>
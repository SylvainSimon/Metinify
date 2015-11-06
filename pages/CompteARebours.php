<script type="text/javascript">
        
    function patiente(reste)
    {    
        document.getElementById("CompteARebours").innerHTML = reste;
            
        compteur = setTimeout( function() {patiente(reste-1);}, 1000 );
        if (reste == 0){
            clearTimeout(compteur);
            Ajax('pages/_LegacyPages/News.php');
            return;
        }
    }
    var delai= 10;
    patiente(delai);
        
</script>
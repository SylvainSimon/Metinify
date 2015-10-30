function ServeurClassyd(){

    $.ajax({
        type: "POST",
        url: "ajax/Actualisation_Classyd.php",
        success: function(msg){

            $("#ServeurClassyd").fadeOut("fast", function(){
                $("#ServeurClassyd").html(msg);
                $("#ServeurClassyd").fadeIn("fast");
            });
        }
    });
    return false;
}

function JoueursConnectes(){

    $.ajax({
        type: "POST",
        url: "ajax/Joueurs_Connectes.php",
        success: function(msg){
            $("#nombreconnecter").html(msg);
        }
    });
    return false;
}
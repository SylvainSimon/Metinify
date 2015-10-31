function ServeurClassyd() {

    $.ajax({
        type: "POST",
        url: "ajax/Actualisation_Classyd.php",
        success: function (msg) {
            $("#ServeurClassyd").html(msg);
            redraw();
        }
    });
    return false;
}

function JoueursConnectes() {

    $.ajax({
        type: "POST",
        url: "ajax/Joueurs_Connectes.php",
        success: function (msg) {
            $("#nombreconnecter").html(msg);
            redraw();
        }
    });
    return false;
}
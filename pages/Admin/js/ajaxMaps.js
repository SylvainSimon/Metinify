function AjaxMaps(url, idMap) {

    displayLoading();

    if (idMap > 0) {
        $.ajax({
            type: "GET",
            url: url,
            data: "idMap=" + idMap,
            success: function (msg) {

                hideLoading();

                $("#boxToolMap").css("display", "inline");
                $("#Map_Apercu").html(msg);
                redraw();
            }
        });
    } else {

        hideLoading();
        $("#boxToolMap").css("display", "none");
        $("#countOnMap").html("Aucune carte n'est sélectionnée.");
        $("#Map_Apercu").html("");
    }
}
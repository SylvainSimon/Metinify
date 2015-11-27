function AjaxMaps(url, idMap) {

    if (idMap > 0) {
        $.ajax({
            type: "GET",
            url: url,
            data: "idMap=" + idMap,
            success: function (msg) {
                $("#Map_Apercu").html(msg);
                redraw();
            }
        });
    }else{
        $("#Map_Apercu").html("");
    }
}
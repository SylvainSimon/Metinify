function AjaxMaps(url, idMap) {
    $.ajax({
        type: "POST",
        url: url,
        data: "idMap=" + idMap,
        success: function (msg) {
            $("#Map_Apercu").html(msg);
            redraw();
        }
    });
}
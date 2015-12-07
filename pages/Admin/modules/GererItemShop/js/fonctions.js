function ajaxGetGererItemShop(url, objet) {

    displayLoading();

    $.ajax({
        type: "POST",
        url: "" + url,
        success: function (msg) {

            hideLoading();
            $("#contentCadreGererITemShop").html(msg);

            if (objet !== false) {
                $(".nav-tabs-custom li").attr("class", "");
                $(objet).parent("li").attr("class", "active");
            }

            redraw();
        }
    });

}
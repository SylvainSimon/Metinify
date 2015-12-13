function Ajax_Appel_MonCompte(url, objet) {

    Pace.track(function () {

        displayLoading();

        $.ajax({
            type: "POST",
            url: "" + url,
            success: function (msg) {

                hideLoading();

                $("#Contenue_Cadre_MonCompte").html(msg);

                if (objet !== false) {
                    $(".nav-tabs-custom li").attr("class", "");
                    $(objet).parent("li").attr("class", "active");
                }

                redraw();
            }
        });
    });
}
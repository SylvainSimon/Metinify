function createTooltip() {
    $("[data-tooltip]").each(function () {
        $(this).attr("title", "");

        var showEffect = "none";
        var showDelay = 10;
        var hideEffect = "none";
        var hideDelay = 10;
        var persistence = 5000;
        var track = false;
        var positionTooltip = {my: 'center top', at: 'center bottom+10'};
        var tooltipClass = "bottom";

        if ($(this).attr("data-tooltip-showEffect") !== undefined) {
            showEffect = $(this).attr("data-tooltip-showEffect");
        }

        if ($(this).attr("data-tooltip-showDelay") !== undefined) {
            showDelay = $(this).attr("data-tooltip-showDelay");
        }

        if ($(this).attr("data-tooltip-hideEffect") !== undefined) {
            hideEffect = $(this).attr("data-tooltip-hideEffect");
        }

        if ($(this).attr("data-tooltip-hideDelay") !== undefined) {
            hideDelay = $(this).attr("data-tooltip-hideDelay");
        }

        if ($(this).attr("data-tooltip-persistence") !== undefined) {
            persistence = $(this).attr("data-tooltip-persistence");
        }

        if ($(this).attr("data-tooltip-track") !== undefined) {
            track = true;
            var positionTooltip = {my: "left bottom-5",
                at: "left bottom",
                collision: "flipfit flip"};
            var tooltipClass = null;
        }

        if ($(this).attr("data-tooltip-isItemMetin") !== undefined) {
            var tooltipClass = tooltipClass + " isItemMetin ";
        }


        if ($(this).attr("data-tooltip-position") !== undefined) {

            switch ($(this).attr("data-tooltip-position")) {
                case "left":
                    positionTooltip = {my: 'right center', at: 'left center'};
                    tooltipClass = "left";
                    break;

                case "top":
                    positionTooltip = {my: 'center bottom', at: 'center top-20'};
                    tooltipClass = "top";
                    break;

                case "right":
                    positionTooltip = {my: 'left center', at: 'right+25 center'};
                    tooltipClass = "right";
                    break;
            }

        }
        positionTooltip.collision = 'none';

        $(this).tooltip({
            position: positionTooltip,
            tooltipClass: tooltipClass,
            track: track,
            show: {effect: showEffect, delay: showDelay},
            hide: {effect: hideEffect, delay: hideDelay},
            content: function () {
                return $(this).attr('data-tooltip');
            },
            open: function (event, ui) {
                setTimeout(function () {
                    $(ui.tooltip).hide('blind');
                }, persistence);
            }
        });
    });
}

$.fn.select2.defaults.set("theme", "bootstrap");

function redrawSelect2() {
    $("select.select2").each(function (i, obj) {

        if (!$(obj).data('select2')) {
            var defaultId = "";
            var placeholder = "-";

            if ($(obj).attr("data-default") !== undefined) {
                defaultId = $(obj).attr("data-default");
            }

            if ($(obj).attr("data-placeholder") !== undefined) {
                placeholder = $(obj).attr("data-placeholder");
            }

            if (!$(obj).parents("div.form-hidden").length) {
                $(obj).select2({
                    tags: "true",
                    minimumResultsForSearch: 10,
                    allowClear: true,
                    placeholder: {
                        id: defaultId,
                        text: placeholder,
                        minimumResultsForSearch: 10
                    }
                }).on("change", function (e) {
                    $("span.select2-selection__rendered").removeAttr("title");
                });
            }
        }
    });
}

function redraw() {
    createTooltip();
    redrawSelect2();

    $("span.select2-selection__rendered").removeAttr("title");
}

$(document).ready(function () {

    $.ajaxSetup({
        error: function (jqXHR, exception) {

            if (jqXHR.status === 418) {
                Ajax("pages/_LegacyPages/News.php");
            } else if (jqXHR.status === 423) {
                Ajax("pages/Bannissement.php");
            }

        }
    });

    redraw();
});

function displayLoading() {
    $("#Contenue_Principal > .box").append('<div class="overlay"><i class="fa fa-spin material-icons md-icon-spin"></i></div>');
}
function hideLoading() {
    $("#Contenue_Principal > .box .overlay").remove();
}

function getInformationItem(idItem) {

    $.ajax({
        type: "POST",
        url: "ajax/ajaxItemGetInfo.php",
        data: "id=" + idItem,
        success: function (msg) {

            if ($("#cade_id_" + idItem).parent(".Interieur_Case").attr("data-tooltip") === "") {
                $("#cade_id_" + idItem).parent(".Interieur_Case").attr("data-tooltip", msg);
                redraw();
            }
        }
    });

}

function ServeurClassyd() {

    $.ajax({
        type: "POST",
        url: "ajax/ajaxStatutServeur.php",
        success: function (msg) {
            $("#ServeurClassyd").html(msg);
            $(".iconStatutServer").html(msg);
            redraw();
        }
    });
    return false;
}

function JoueursConnectes() {

    $.ajax({
        type: "POST",
        url: "ajax/ajaxStatutNombreJoueur.php",
        success: function (msg) {
            $("#nombreconnecter").html(msg);
            redraw();
        }
    });
    return false;
}

function Fonction_Reteneuse_Tananaies(Nombre_Objectif_Tananaies) {

    Nombre_Transmis_Tananaies = Nombre_Objectif_Tananaies;
    Definition_Compteurs_Tananaies(Nombre_Transmis_Tananaies);
}


function Definition_Compteurs_Tananaies(Nombre_Tananaies) {

    if (parseInt($("#Nombre_De_Tananaies").html()) != Nombre_Tananaies) {

        if (parseInt($("#Nombre_De_Tananaies").html()) < Nombre_Tananaies) {
            document.getElementById("Nombre_De_Tananaies").innerHTML = (parseInt($("#Nombre_De_Tananaies").html()) + 1);

        } else if (parseInt($("#Nombre_De_Tananaies").html()) > Nombre_Tananaies) {
            document.getElementById("Nombre_De_Tananaies").innerHTML = (parseInt($("#Nombre_De_Tananaies").html()) - 1);
        }
    }

    if (parseInt($("#Nombre_De_Tananaies").html()) != Nombre_Tananaies) {
        setTimeout("Definition_Compteurs_Tananaies(Nombre_Transmis_Tananaies)", 1);
    }
}

function Fonction_Reteneuse_Vamonaies(Nombre_Objectif_Vamonaie) {

    Nombre_Transmis_Vamonaies = Nombre_Objectif_Vamonaie;
    Definition_Compteurs_VamoNaies(Nombre_Transmis_Vamonaies);
}


function Definition_Compteurs_VamoNaies(Nombre_Vamonaies) {

    if (parseInt($("#Nombre_De_Vamonaies").html()) != Nombre_Vamonaies)
    {
        if (parseInt($("#Nombre_De_Vamonaies").html()) < Nombre_Vamonaies) {
            document.getElementById("Nombre_De_Vamonaies").innerHTML = (parseInt($("#Nombre_De_Vamonaies").html()) + 1);

        } else if (parseInt(document.getElementById('Nombre_De_Vamonaies').innerHTML) > Nombre_Vamonaies) {
            document.getElementById("Nombre_De_Vamonaies").innerHTML = (parseInt($("#Nombre_De_Vamonaies").html()) - 1);
        }

    }

    if (parseInt($("#Nombre_De_Vamonaies").html()) != Nombre_Vamonaies) {
        setTimeout("Definition_Compteurs_VamoNaies(Nombre_Transmis_Vamonaies)", 2);
    }
}

function Distribuer_Monnaies() {

    $.ajax({
        type: "POST",
        url: "ajax/Update_Vamonaies.php",
        success: function (msg) {
            if (msg != "") {
                Fonction_Reteneuse_Vamonaies(msg);
                Barre_De_Statut("Monnaies recu avec succès.");
                Icone_Chargement(0);
            }
        }
    });
    return false;

}
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

function redraw() {
    createTooltip();
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
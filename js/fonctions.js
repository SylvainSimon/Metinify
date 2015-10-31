function createTooltip() {
    $("[data-tooltip]").each(function () {
        $(this).attr("title", "");

        var showEffect = "none";
        var showDelay = 10;
        var hideEffect = "none";
        var hideDelay = 10;
        var persistence = 5000;

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

        var positionTooltip = {my: 'center top', at: 'center bottom+10'};
        var tooltipClass = "bottom";

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
    redraw();
});
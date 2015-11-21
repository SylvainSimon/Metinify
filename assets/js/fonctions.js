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

function popBootbox(message, title, withReload) {

    if (typeof withReload === undefined) {
        withReload = false;
    }

    var vartitle = "Information";

    if (typeof title !== "undefined") {
        vartitle = title;
    }

    bootbox.dialog({
        message: message,
        title: vartitle,
        animate: false,
        className: "myBootBox",
        buttons: {
            main: {
                label: "Fermer la fenêtre",
                className: "btn-primary",
                callback: function () {

                    if (withReload) {
                        location.reload();
                    }

                }
            }
        }
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
                Ajax("pages/_LegacyPages/Bannissement.php");
            }

        }
    });

    $.extend($.fn.dataTable.defaults, {
        "fnDrawCallback": function (oSettings) {
            redraw();
        },
        "fnInitComplete": function (oSettings, json) {
            redraw();
        },
        "bJQueryUI": false,
        "sDom": '<"clear"><"top">rt<lp><"clear">',
        "sPaginationType": "full_numbers",
        "bPaginate": true,
        "bServerSide": true
    });

    $.extend(true, $.fn.dataTable.defaults, {
        "oLanguage": {
            "sLengthMenu": "_MENU_<span class='hidden-xs'> par page</span>",
            "sZeroRecords": "Aucun élément trouvé",
            "sInfo": "Affichage de _START_ à _END_ sur _TOTAL_ éléments",
            "sInfoEmpty": "Affichage de 0 à 0 sur 0 éléments",
            "sInfoFiltered": "(filtré d'un total de _MAX_ éléments)",
            "sSearch": "Rechercher",
            "sEmptyTable": "Aucun élément trouvé",
            "sProcessing": "Chargement des données...",
            "oPaginate": {
                "sPrevious": "«",
                "sNext": "»",
                "sFirst": "Début",
                "sLast": "Fin"
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


function processingDatatable(processing) {
    if (processing) {
        displayLoadingDataTable();
    } else {
        hideLoadingDataTable();
    }
}

function displayLoadingDataTable() {
    $(".box.boxDataTable").append('<div class="overlay"><i class="fa fa-spin material-icons md-icon-spin"></i></div>');
}
function hideLoadingDataTable() {
    $(".box.boxDataTable .overlay").remove();
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
            $("#nombrePlayerConnected").html(msg);
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

$(function () {
    $.superbox.settings = {
        closeTxt: "Fermer",
        loadTxt: "Chargement...",
        boxWidth: "1200",
        boxHeight: "445"
    };
    $.superbox();
});

$(document).ready(function () {
    $(".fancybox_Rechargement").fancybox({
        padding: 0,
        closeBtn: false,
        autoSize: false,
        scrolling: 'no',
        scrollOutside: false,
        fitToView: true,
        autoWidth: true,
        height: 450,
        closeClick: false,
        topRatio: 0.5,
        openEffect: 'elastic',
        closeEffect: 'elastic',
        openSpeed: 400,
        closeSpeed: 200
    });

    $(".fancybox_Marche").fancybox({
        padding: 0,
        closeBtn: false,
        autoSize: false,
        scrollOutside: false,
        fitToView: true,
        autoWidth: false,
        height: "auto",
        maxHeight: "80%",
        width: 800,
        closeClick: false,
        topRatio: 0.50,
        openEffect: 'elastic',
        closeEffect: 'elastic',
        openSpeed: 400,
        closeSpeed: 200
    });

    $(".fancybox_Trailer").fancybox({
        minWidth: 1200,
        minHeight: 521,
        maxHeight: 521,
        padding: 0,
        closeBtn: false,
        scrolling: 'no',
        scrollOutside: false,
        fitToView: true,
        autoSize: false,
        closeClick: false,
        openEffect: 'elastic',
        closeEffect: 'elastic',
        openSpeed: 400,
        closeSpeed: 200
    });

    Barre_De_Statut("Chargement terminé");
    Icone_Chargement(0);

});

function Barre_De_Statut(statut) {

    $("#Phrase_Statut").html(statut);
}

function Icone_Chargement(etat) {

    if (etat == 1) {
        $('#Icone_Chargement').attr("class", "fa fa-spin material-icons md-icon-spin");
        $('#Icone_Chargement').show();
    }

    if (etat == 2) {
        $('#Icone_Chargement').attr("class", "material-icons md-icon-close text-red");
        $('#Icone_Chargement').show();
    }

    if (etat == 0) {
        $('#Icone_Chargement').attr("class", "material-icons md-icon-done text-success");
        $('#Icone_Chargement').show();
    }

    if (etat == 99) {
        $('#Icone_Chargement').attr("class", "material-icons md-icon-tv");
        $('#Icone_Chargement').show();
    }
}

$(function () {
    $.contextMenu({
        selector: 'body',
        zIndex: 99999,
        duration: 500, show: "slideDown", hide: "slideUp",
        callback: function (key, options) {
            if (key == "apropos") {
                Ajax('pages/_LegacyPages/Presentation.php');
            } else if (key == "facebook") {
                window.open("https://www.facebook.com/groups/vamosmt2", "_blank");
            } else if (key == "twitter") {
                window.open("https://twitter.com/VamosMT2", "_blank");
            } else if (key == "youtube") {
                window.open("https://www.youtube.com/VamosMt2", "_blank");
            } else if (key == "teamspeack") {
                window.open("ts3server://ts3.vamosmt2.org", "_top");
            } else if (key == "equipe") {
                Ajax('pages/Equipe.php');
            } else if (key == "pilori") {
                Ajax('pages/_LegacyPages/Pilori.php');
            } else if (key == "stati") {
                Ajax("pages/Statistiques/Statistiques.php");
            } else if (key == "calen") {
                Ajax("pages/_LegacyPages/Calendrier.php");
            } else if (key == "securite") {
                Ajax("pages/_LegacyPages/Securite.php");
            }
        },
        items: {
            "facebook": {name: "Page Facebook"},
            "twitter": {name: "Page Twitter", icon: "twitter"},
            "youtube": {name: "Chaîne Youtube", icon: "youtube"},
            "teamspeack": {name: "TeamSpeak", icon: "teamspeack"},
            "sep1": "---------",
            "calen": {name: "Calendrier", icon: "calen"},
            "stati": {name: "Statistiques", icon: "stati"},
            "pilori": {name: "Pilori", icon: "pilori"},
            "securite": {name: "Conseils de sécurité", icon: "equipe"},
            "sep2": "---------",
            "apropos": {name: "A propos de VamosMt2...", icon: "apropo"}
        }
    });

});
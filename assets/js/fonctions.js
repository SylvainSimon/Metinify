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
                    locale: 'fr',
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

    $(".dataTables_length select").each(function (i, obj) {
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
                    locale: 'fr',
                    minimumResultsForSearch: 10,
                    allowClear: false,
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

function redrawCheckbox() {
    $("input.icheck, .icheck input[type=checkbox]").iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'icheckbox_square-blue',
        increaseArea: '20%',
        inheritClass: true,
        cursor: true
    });
}

function redraw() {
    createTooltip();
    redrawSelect2();
    redrawCheckbox();

    $("span.select2-selection__rendered").removeAttr("title");
}


$.fn.select2.defaults.set('language', 'fr');

toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": 100,
    "hideDuration": 10,
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "closeEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut",
    "closeHtml": "<i class='material-icons md-icon-close'></i>"
}

$(document).ajaxError(function () {
    Icone_Chargement(2);
});

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

    $.featherlight.defaults.closeIcon = "";

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
            "sLengthMenu": "_MENU_",
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
    Barre_De_Statut("Chargement en cours...");
    Icone_Chargement(1);
    $("#Contenue_Principal .box").append('<div class="overlay"><i class="fa fa-spin material-icons md-icon-spin"></i></div>');
}
function hideLoading() {
    Barre_De_Statut("Chargement terminé");
    Icone_Chargement(0);
    $("#Contenue_Principal .box .overlay").remove();
}

function displayLoadingFeatherlight() {
    $(".box.featherlight-inner").append('<div class="overlay"><i class="fa fa-spin material-icons md-icon-spin"></i></div>');
}
function hideLoadingFeatherlight() {
    $(".box.featherlight-inner").remove();
}


function processingDatatable(processing) {
    if (processing) {
        displayLoadingDataTable();
    } else {
        hideLoadingDataTable();
    }
}

function processingDatatableInBox(processing) {
    if (processing) {
        displayLoading();
    } else {
        hideLoading();
    }
}

function displayLoadingDataTable() {
    $(".box.boxDataTable").append('<div class="overlay"><i class="fa fa-spin material-icons md-icon-spin"></i></div>');
}
function hideLoadingDataTable() {
    $(".box.boxDataTable .overlay").remove();
}

function displayLoadingFeatherLightBox() {
    $(".featherlight-content .box").append('<div class="overlay"><i class="fa fa-spin material-icons md-icon-spin"></i></div>');
}
function hideLoadingFeatherLightBox() {
    $(".featherlight-content .box .overlay").remove();
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

Number.prototype.formatMoney = function (c, d, t) {
    var n = this,
            c = isNaN(c = Math.abs(c)) ? 2 : c,
            d = d == undefined ? "." : d,
            t = t == undefined ? "," : t,
            s = n < 0 ? "-" : "",
            i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
            j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};


function Definition_Compteurs_Tananaies(nombreMileageCible) {

    var nombreMileage = parseInt($("#Nombre_De_Tananaies").html().replace(",", ""));

    if (nombreMileage != nombreMileageCible) {

        if (nombreMileage < nombreMileageCible) {
            $("#Nombre_De_Tananaies").html((nombreMileage + 1).formatMoney(0));

        } else if (nombreMileage > nombreMileageCible) {
            $("#Nombre_De_Tananaies").html((nombreMileage - 1).formatMoney(0));
        }
    }

    if (nombreMileage != nombreMileageCible) {
        setTimeout("Definition_Compteurs_Tananaies(Nombre_Transmis_Tananaies)", 1);
    }
}

function Fonction_Reteneuse_Vamonaies(Nombre_Objectif_Vamonaie) {
    Nombre_Transmis_Vamonaies = Nombre_Objectif_Vamonaie;
    Definition_Compteurs_VamoNaies(Nombre_Transmis_Vamonaies);
}


function Definition_Compteurs_VamoNaies(nombreCashCible) {

    var nombreCash = parseInt($("#Nombre_De_Vamonaies").html().replace(",", ""));

    if (nombreCash != nombreCashCible) {

        if (nombreCash < nombreCashCible) {
            $("#Nombre_De_Vamonaies").html((nombreCash + 1).formatMoney(0));
        } else if (nombreCash > nombreCashCible) {
            $("#Nombre_De_Vamonaies").html((nombreCash - 1).formatMoney(0));
        }
    }

    if (nombreCash != nombreCashCible) {
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

    $(".fancybox_News").fancybox({
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
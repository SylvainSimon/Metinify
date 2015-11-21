(function ($) {
    $.fn.dataTableExt.oApi.fnStandingRedraw = function (oSettings) {
        if (oSettings.oFeatures.bServerSide === false) {
            var before = oSettings._iDisplayStart;

            oSettings.oApi._fnReDraw(oSettings);

            // iDisplayStart has been reset to zero - so lets change it back
            oSettings._iDisplayStart = before;
            oSettings.oApi._fnCalculateEnd(oSettings);
        }

        // draw the 'current' page
        oSettings.oApi._fnDraw(oSettings);
    };
})(window.jQuery);

$.fn.dataTable.TableTools.buttons.download = $.extend(true, {},
        $.fn.dataTable.TableTools.buttonBase, {
            "sButtonText": "&#xE159;",
            "sButtonClass": "btn btn-material btn-flat btn-sm",
            "sUrl": "",
            "sColumns": [],
            "sFormat": "",
            "sType": "POST",
            "sAll": 0,
            "sBase": "",
            "fnData": false,
            "fnClick": function (button, config) {
                var dt = new $.fn.dataTable.Api(this.s.dt);
                var data = dt.ajax.params() || {};

                showLoaderExport(button);

                if (config.fnData) {
                    config.fnData(data);
                }

                var colonnesStockage = [];

                for (var i in config.sColumns) {

                    if (typeof config.sColumns[i]["mNonExportable"] === 'undefined') {
                        colonnesStockage[i] = config.sColumns[i]["mData"] + "|" + config.sColumns[i]["mTitle"];
                    }
                }

                if (config.sAll == 1) {
                    data["iDisplayStart"] = 0;
                    data["iDisplayLength"] = -1;
                }

                data["export"] = 1;
                data["exportType"] = "" + config.sFormat;
                data["colonnes"] = "" + JSON.stringify(colonnesStockage);

                $.ajax({
                    url: config.sUrl,
                    data: data,
                    success: function (strData) {

                        hideLoaderExport();

                        window.location = config.sBase + "system/modules/medtra_core/classes/Exportation_Generique_Telechargement.php?action=download&exportType=" + config.sFormat + "&file=" + strData + "";
                    }
                });
            }
        }
);

$.fn.dataTable.TableTools.buttons.search = $.extend(true, {},
        $.fn.dataTable.TableTools.buttonBase, {
            "sButtonText": "",
            "sButtonClass": "",
            "sFormat": "",
            "sType": "POST",
            "fnData": false,
            "fnClick": function (button, config) {

                var idTableau = $(button).attr("aria-controls");
                var element = $("#" + idTableau).children("thead").children("tr:first-child");

                if ($(".dataTables_scrollHeadInner").length > 0) {
                    $(".dataTables_scrollHeadInner thead tr:first-child").toggle();

                    if ($(".DTFC_LeftBodyWrapper").css("top") == "70px") {
                        $(".DTFC_LeftBodyWrapper").css("top", "0px");
                        $(".DTFC_RightBodyWrapper").css("top", "0px");
                    } else {
                        $(".DTFC_LeftBodyWrapper").css("top", "70px");
                        $(".DTFC_RightBodyWrapper").css("top", "70px");


                    }

                } else {
                    $("#" + idTableau).children("thead").children("tr:first-child").toggle();
                    if (element.length == 0) {
                        $(".dataTable thead tr:first-child").toggle();
                    }
                }
            }
        }
);
﻿/*
 * File:        jquery.dataTables.columnFilter.js
 * Version:     1.5.6.
 * Author:      Jovan Popovic 
 * 
 * Copyright 2011-2014 Jovan Popovic, all rights reserved.
 *
 * This source file is free software, under either the GPL v2 license or a
 * BSD style license, as supplied with this software.
 * 
 * This source file is distributed in the hope that it will be useful, but 
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY 
 * or FITNESS FOR A PARTICULAR PURPOSE. 
 * 
 * Parameters:"
 * @sPlaceHolder                 String      Place where inline filtering function should be placed ("tfoot", "thead:before", "thead:after"). Default is "tfoot"
 * @sRangeSeparator              String      Separator that will be used when range values are sent to the server-side. Default value is "~".
 * @sRangeFormat                 string      Default format of the From ... to ... range inputs. Default is From {from} to {to}
 * @aoColumns                    Array       Array of the filter settings that will be applied on the columns
 */
        (function ($) {

            $.fn.columnFilter = function (options) {

                var asInitVals, i, label, th;

                //var sTableId = "table";
                var sRangeFormat = "du {from} au {to}";
                //Array of the functions that will override sSearch_ parameters
                var afnSearch_ = new Array();
                var aiCustomSearch_Indexes = new Array();

                var oFunctionTimeout = null;

                var fnOnFiltered = function () {
                };

                function _fnGetColumnValues(oSettings, iColumn, bUnique, bFiltered, bIgnoreEmpty) {
                    ///<summary>
                    ///Return values in the column
                    ///</summary>
                    ///<param name="oSettings" type="Object">DataTables settings</param>
                    ///<param name="iColumn" type="int">Id of the column</param>
                    ///<param name="bUnique" type="bool">Return only distinct values</param>
                    ///<param name="bFiltered" type="bool">Return values only from the filtered rows</param>
                    ///<param name="bIgnoreEmpty" type="bool">Ignore empty cells</param>

                    // check that we have a column id
                    if (typeof iColumn == "undefined")
                        return new Array();

                    // by default we only wany unique data
                    if (typeof bUnique == "undefined")
                        bUnique = true;

                    // by default we do want to only look at filtered data
                    if (typeof bFiltered == "undefined")
                        bFiltered = true;

                    // by default we do not wany to include empty values
                    if (typeof bIgnoreEmpty == "undefined")
                        bIgnoreEmpty = true;

                    // list of rows which we're going to loop through
                    var aiRows;

                    // use only filtered rows
                    if (bFiltered == true)
                        aiRows = oSettings.aiDisplay;
                    // use all rows
                    else
                        aiRows = oSettings.aiDisplayMaster; // all row numbers

                    // set up data array	
                    var asResultData = new Array();

                    for (var i = 0, c = aiRows.length; i < c; i++) {
                        var iRow = aiRows[i];
                        var aData = oTable.fnGetData(iRow);
                        var sValue = aData[iColumn];

                        // ignore empty values?
                        if (bIgnoreEmpty == true && sValue.length == 0)
                            continue;

                        // ignore unique values?
                        else if (bUnique == true && jQuery.inArray(sValue, asResultData) > -1)
                            continue;

                        // else push the value onto the result data array
                        else
                            asResultData.push(sValue);
                    }

                    return asResultData.sort();
                }

                function _fnColumnIndex(iColumnIndex) {
                    if (properties.bUseColVis)
                        return iColumnIndex;
                    else
                        return oTable.fnSettings().oApi._fnVisibleToColumnIndex(oTable.fnSettings(), iColumnIndex);
                    //return iColumnIndex;
                    //return oTable.fnSettings().oApi._fnColumnIndexToVisible(oTable.fnSettings(), iColumnIndex);
                }

                function fnCreateInput(oTable, regex, smart, bIsNumber, iFilterLength, iMaxLenght, placeholder, cssClass) {
                    var sCSSClass = "text_filter form-control";
                    if (bIsNumber)
                        sCSSClass = "number_filter form-control";

                    sCSSClass += " " + cssClass;

                    label = label.replace(/(^\s*)|(\s*$)/g, "");
                    var currentFilter = oTable.fnSettings().aoPreSearchCols[i].sSearch;
                    var search_init = 'search_init ';
                    var inputvalue = label;
                    if (currentFilter != '' && currentFilter != '^') {
                        if (bIsNumber && currentFilter.charAt(0) == '^')
                            inputvalue = currentFilter.substr(1); //ignore trailing ^
                        else
                            inputvalue = currentFilter;
                        search_init = '';
                    }

                    var input = $('<input type="text" style="margin: 0 0 0px 0;" class="input-sm ' + search_init + sCSSClass + '" value="' + inputvalue + '" rel="' + i + '" placeholder="' + placeholder + '" />');
                    if (iMaxLenght != undefined && iMaxLenght != -1) {
                        input.attr('maxlength', iMaxLenght);
                    }
                    th.html(input);
                    if (bIsNumber)
                        th.wrapInner('<span class="filter_column filter_number" />');
                    else
                        th.wrapInner('<span class="filter_column filter_text" />');

                    asInitVals[i] = label;
                    var index = i;

                    if (bIsNumber && !oTable.fnSettings().oFeatures.bServerSide) {
                        // input.keyup(function () {
                        // input.on('change', function () {
                        input.keyup(function (e) {
                            
                            if(e.keyCode == 13){
                            /* Filter on the column all numbers that starts with the entered value */
                            oTable.fnFilter('^' + this.value, _fnColumnIndex(index), true, false); //Issue 37
                            fnOnFiltered();
                            }
                        });
                    } else {
                        // input.keyup(function () {
                        // input.on('change', function () {
                        input.keyup(function (e) {
                            
                            if(e.keyCode == 13){
                                if (oTable.fnSettings().oFeatures.bServerSide && iFilterLength != 0) {
                                    //If filter length is set in the server-side processing mode
                                    //Check has the user entered at least iFilterLength new characters

                                    var currentFilter = oTable.fnSettings().aoPreSearchCols[index].sSearch;
                                    var iLastFilterLength = $(this).data("dt-iLastFilterLength");
                                    if (typeof iLastFilterLength == "undefined")
                                        iLastFilterLength = 0;
                                    var iCurrentFilterLength = this.value.length;
                                    if (Math.abs(iCurrentFilterLength - iLastFilterLength) < iFilterLength
                                            //&& currentFilter.length == 0 //Why this?
                                            ) {
                                        //Cancel the filtering
                                        return;
                                    }
                                    else {
                                        //Remember the current filter length
                                        $(this).data("dt-iLastFilterLength", iCurrentFilterLength);
                                    }
                                }
                                /* Filter on the column (the index) of this element */
                                oTable.fnFilter(this.value, _fnColumnIndex(index), regex, smart); //Issue 37
                                fnOnFiltered();
                            }
                        });
                    }

                    input.focus(function () {
                        if ($(this).hasClass("search_init")) {
                            $(this).removeClass("search_init");
                            this.value = "";
                        }
                    });
                    input.blur(function () {
                        if (this.value == "") {
                            $(this).addClass("search_init");
                            this.value = asInitVals[index];
                        }
                    });
                }

                function fnCreateRangeInput(oTable, cssClass) {

                    //var currentFilter = oTable.fnSettings().aoPreSearchCols[i].sSearch;
                    th.html(_fnRangeLabelPart(0));
                    var sFromId = oTable.attr("id") + '_range_from_' + i;
                    var from = $('<input type="text" class="number_range_filter form-control ' + cssClass + '" id="' + sFromId + '" rel="' + i + '"/>');
                    th.append(from);
                    th.append(_fnRangeLabelPart(1));
                    var sToId = oTable.attr("id") + '_range_to_' + i;
                    var to = $('<input type="text" class="number_range_filter form-control ' + cssClass + '" id="' + sToId + '" rel="' + i + '"/>');
                    th.append(to);
                    th.append(_fnRangeLabelPart(2));
                    th.wrapInner('<span class="filter_column filter_number_range form-control ' + cssClass + '" />');
                    var index = i;
                    aiCustomSearch_Indexes.push(i);



                    //------------start range filtering function


                    /* 	Custom filtering function which will filter data in column four between two values
                     *	Author: 	Allan Jardine, Modified by Jovan Popovic
                     */
                    //$.fn.dataTableExt.afnFiltering.push(
                    oTable.dataTableExt.afnFiltering.push(
                            function (oSettings, aData, iDataIndex) {
                                if (oTable.attr("id") != oSettings.sTableId)
                                    return true;
                                // Try to handle missing nodes more gracefully
                                if (document.getElementById(sFromId) == null)
                                    return true;
                                var iMin = document.getElementById(sFromId).value * 1;
                                var iMax = document.getElementById(sToId).value * 1;
                                var iValue = aData[_fnColumnIndex(index)] == "-" ? 0 : aData[_fnColumnIndex(index)] * 1;
                                if (iMin == "" && iMax == "") {
                                    return true;
                                }
                                else if (iMin == "" && iValue <= iMax) {
                                    return true;
                                }
                                else if (iMin <= iValue && "" == iMax) {
                                    return true;
                                }
                                else if (iMin <= iValue && iValue <= iMax) {
                                    return true;
                                }
                                return false;
                            }
                    );
                    //------------end range filtering function



                    //$('#' + sFromId + ',#' + sToId, th).keyup(function () {
                    // $('#' + sFromId + ',#' + sToId, th).on('change', function () {
                    $('#' + sFromId + ',#' + sToId, th).keypress(function( event ) {
                        
                        if ( event.which == 13 ) {

                        var iMin = document.getElementById(sFromId).value * 1;
                        var iMax = document.getElementById(sToId).value * 1;
                        if (iMin != 0 && iMax != 0 && iMin > iMax)
                            return;

                        oTable.fnDraw();
                        fnOnFiltered();
                      }
                    });


                }


                function fnCreateDateRangeInput(oTable, withoutCalendar, cssClass) {

                    var aoFragments = sRangeFormat.split(/[}{]/);

                        th.html("");
                        
                        if(withoutCalendar){
                            var sFromId = oTable.attr("id") + '_range_from_' + i;
                            var from = $('<div class="input-group date maskDatePicker"><input type="text" placeholder="Du" style="min-width:90px;" class="date_min date_range_filter input-sm form-control ' + cssClass + '" id="' + sFromId + '" rel="' + i + '"/></div>');
                        
                            var sToId = oTable.attr("id") + '_range_to_' + i;
                            var to = $('<div class="input-group date maskDatePicker"><input type="text" placeholder="Au" style="min-width:90px;" class="date_max date_range_filter input-sm form-control ' + cssClass + '" id="' + sToId + '" rel="' + i + '"/></div>');
                        }else{
                            var sFromId = oTable.attr("id") + '_range_from_' + i;
                            var from = $('<div class="input-group date datePicker"><span style="border-width: 0px; padding-left: 0px; " class="input-group-addon"><i class="material-icons md-dark md-icon-event md-22"></i></span><input type="text" placeholder="Du" style="min-width:90px;" class="date_min date_range_filter input-sm form-control ' + cssClass + '" id="' + sFromId + '" rel="' + i + '"/></div>');
                        
                            var sToId = oTable.attr("id") + '_range_to_' + i;
                            var to = $('<div class="input-group date datePicker"><span style="border-width: 0px; padding-left: 0px; " class="input-group-addon"><i class="material-icons md-dark md-icon-event md-22"></i></span><input type="text" placeholder="Au" style="min-width:90px;" class="date_max date_range_filter input-sm form-control ' + cssClass + '" id="' + sToId + '" rel="' + i + '"/></div>');
                        }

                    for (ti = 0; ti < aoFragments.length; ti++) {

                        if (aoFragments[ti] == properties.sDateFromToken) {
                            th.append(from);
                        } else {
                            if (aoFragments[ti] == properties.sDateToToken) {
                                th.append(to);
                            } else {
                                th.append(aoFragments[ti]);
                            }
                        }


                    }


                    th.wrapInner('<span class="filter_column filter_date_range" />');



                    var index = i;
                    aiCustomSearch_Indexes.push(i);


                    //------------start date range filtering function

                    //$.fn.dataTableExt.afnFiltering.push(
                    oTable.dataTableExt.afnFiltering.push(
                            function (oSettings, aData, iDataIndex) {
                                if (oTable.attr("id") != oSettings.sTableId)
                                    return true;

                                var dStartDate = from.datepicker("getDate");

                                var dEndDate = to.datepicker("getDate");

                                if (dStartDate == null && dEndDate == null) {
                                    return true;
                                }

                                var dCellDate = null;
                                try {
                                    if (aData[_fnColumnIndex(index)] == null || aData[_fnColumnIndex(index)] == "")
                                        return false;
                                    dCellDate = $.datepicker.parseDate($.datepicker.regional[""].dateFormat, aData[_fnColumnIndex(index)]);
                                } catch (ex) {
                                    return false;
                                }
                                if (dCellDate == null)
                                    return false;


                                if (dStartDate == null && dCellDate <= dEndDate) {
                                    return true;
                                }
                                else if (dStartDate <= dCellDate && dEndDate == null) {
                                    return true;
                                }
                                else if (dStartDate <= dCellDate && dCellDate <= dEndDate) {
                                    return true;
                                }
                                return false;
                            }
                    );
                    //------------end date range filtering function

                    //$('#' + sFromId + ',#' + sToId, th).change(function () {
                    $('#' + sFromId + ',#' + sToId, th).keypress(function( event ) {
                        if ( event.which == 13 ) {
                        oTable.fnDraw();
                        fnOnFiltered();
                    }
                    });


                }

                function fnCreateColumnSelect(oTable, aData, iColumn, nTh, sLabel, bRegex, oSelected, bMultiselect, cssClass) {
                    if (aData == null)
                        aData = _fnGetColumnValues(oTable.fnSettings(), iColumn, true, false, true);
                    var index = iColumn;
                    var currentFilter = oTable.fnSettings().aoPreSearchCols[i].sSearch;
                    if (currentFilter == null || currentFilter == "")//Issue 81
                        currentFilter = oSelected;

                    var r = '<select style="margin: 0 0 0px 0;" class="select2 search_init select_filter input-sm form-control ' + cssClass + '" rel="' + i + '"><option value="" class="search_init">-- Tous --</option>';
                    if (bMultiselect) {
                        r = '<select style="margin: 0 0 0px 0;" class="select2 search_init select_filter input-sm form-control ' + cssClass + '" rel="' + i + '" multiple>';
                    }
                    var j = 0;
                    var iLen = aData.length;
                    for (j = 0; j < iLen; j++) {
                        if (typeof (aData[j]) != 'object') {
                            var selected = '';
                            if (escape(aData[j]) == currentFilter
                                    || escape(aData[j]) == escape(currentFilter)
                                    )
                                selected = 'selected '
                            r += '<option ' + selected + ' value="' + escape(aData[j]) + '">' + aData[j] + '</option>';
                        }
                        else {
                            var selected = '';
                            if (bRegex) {
                                //Do not escape values if they are explicitely set to avoid escaping special characters in the regexp
                                if (aData[j].value == currentFilter)
                                    selected = 'selected ';
                                r += '<option ' + selected + 'value="' + aData[j].value + '">' + aData[j].label + '</option>';
                            } else {
                                if (escape(aData[j].value) == currentFilter)
                                    selected = 'selected ';
                                r += '<option ' + selected + 'value="' + escape(aData[j].value) + '">' + aData[j].label + '</option>';
                            }
                        }
                    }

                    var select = $(r + '</select>');
                    nTh.html(select);
                    nTh.wrapInner('<span class="filter_column filter_select" />');

                    if (bMultiselect) {
                        //select.change(function () {
                        select.change(function () {
                            if ($(this).val() != "") {
                                $(this).removeClass("search_init");
                            } else {
                                $(this).addClass("search_init");
                            }
                            var selectedOptions = $(this).val();
                            var asEscapedFilters = [];
                            if (selectedOptions == null || selectedOptions == []) {
                                var re = '^(.*)$';
                            } else {
                                $.each(selectedOptions, function (i, sFilter) {
                                    asEscapedFilters.push(fnRegExpEscape(sFilter));
                                });
                                var re = '^(' + asEscapedFilters.join('|') + ')$';
                            }

                            oTable.fnFilter(re, index, true, false);
                        });
                    } else {
                        //select.change(function () {
                        select.change(function () {
                            //var val = $(this).val();
                            if ($(this).val() != "") {
                                $(this).removeClass("search_init");
                            } else {
                                $(this).addClass("search_init");
                            }
                            if (bRegex)
                                oTable.fnFilter($(this).val(), iColumn, bRegex); //Issue 41
                            else
                                oTable.fnFilter(unescape($(this).val()), iColumn); //Issue 25
                            fnOnFiltered();
                        });
                        if (currentFilter != null && currentFilter != "")//Issue 81
                            oTable.fnFilter(unescape(currentFilter), iColumn);
                    }
                }

                function fnCreateSelect(oTable, aData, bRegex, oSelected, bMultiselect, cssClass) {
                    var oSettings = oTable.fnSettings();
                    if ((aData == null || typeof (aData) == 'function') && oSettings.sAjaxSource != "" && !oSettings.oFeatures.bServerSide) {
                        // Add a function to the draw callback, which will check for the Ajax data having 
                        // been loaded. Use a closure for the individual column elements that are used to 
                        // built the column filter, since 'i' and 'th' (etc) are locally "global".
                        oSettings.aoDrawCallback.push({
                            "fn": (function (iColumn, nTh, sLabel) {
                                return function (oSettings) {
                                    // Only rebuild the select on the second draw - i.e. when the Ajax
                                    // data has been loaded.
                                    if (oSettings.iDraw == 2 && oSettings.sAjaxSource != null && oSettings.sAjaxSource != "" && !oSettings.oFeatures.bServerSide) {
                                        return fnCreateColumnSelect(oTable, aData && aData(oSettings.aoData, oSettings), _fnColumnIndex(iColumn), nTh, sLabel, bRegex, oSelected, bMultiselect, cssClass); //Issue 37
                                    }
                                };
                            })(i, th, label),
                            "sName": "column_filter_" + i
                        });
                    }
                    // Regardless of the Ajax state, build the select on first pass
                    fnCreateColumnSelect(oTable, typeof (aData) == 'function' ? null : aData, _fnColumnIndex(i), th, label, bRegex, oSelected, bMultiselect, cssClass); //Issue 37

                }

                function fnRegExpEscape(sText) {
                    return sText.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&");
                }
                ;

                function fnCreateDropdown(aData, cssClass) {
                    var index = i;
                    var r = '<div class="dropdown select_filter form-control ' + cssClass + '"><a class="dropdown-toggle" data-toggle="dropdown" href="#">' + label + '<b class="caret"></b></a><ul class="dropdown-menu" role="menu"><li data-value=""><a>Show All</a></li>', j, iLen = aData.length;

                    for (j = 0; j < iLen; j++) {
                        r += '<li data-value="' + aData[j] + '"><a>' + aData[j] + '</a></li>';
                    }
                    var select = $(r + '</ul></div>');
                    th.html(select);
                    th.wrapInner('<span class="filterColumn filter_select" />');
                    select.find('li').click(function () {
                        oTable.fnFilter($(this).data('value'), index);
                    });
                }


                function fnCreateCheckbox(oTable, aData, cssClass) {

                    if (aData == null)
                        aData = _fnGetColumnValues(oTable.fnSettings(), i, true, true, true);
                    var index = i;

                    var r = '', j, iLen = aData.length;

                    //clean the string
                    var localLabel = label.replace('%', 'Perc').replace("&", "AND").replace("$", "DOL").replace("£", "STERL").replace("@", "AT").replace(/\s/g, "_");
                    localLabel = localLabel.replace(/[^a-zA-Z 0-9]+/g, '');
                    //clean the string

                    //button label override
                    var labelBtn = label;
                    if (properties.sFilterButtonText != null || properties.sFilterButtonText != undefined) {
                        labelBtn = properties.sFilterButtonText;
                    }

                    var relativeDivWidthToggleSize = 10;
                    var numRow = 12; //numero di checkbox per colonna
                    var numCol = Math.floor(iLen / numRow);
                    if (iLen % numRow > 0) {
                        numCol = numCol + 1;
                    }
                    ;

                    //count how many column should be generated and split the div size
                    var divWidth = 100 / numCol - 2;

                    var divWidthToggle = relativeDivWidthToggleSize * numCol;

                    if (numCol == 1) {
                        divWidth = 20;
                    }

                    var divRowDef = '<div style="float:left; min-width: ' + divWidth + '%; " >';
                    var divClose = '</div>';

                    var uniqueId = oTable.attr("id") + localLabel;
                    var buttonId = "chkBtnOpen" + uniqueId;
                    var checkToggleDiv = uniqueId + "-flt-toggle";
                    r += '<button id="' + buttonId + '" class="checkbox_filter btn btn-default" > ' + labelBtn + '</button>'; //filter button witch open dialog
                    r += '<div id="' + checkToggleDiv + '" '
                            + 'title="' + label + '" '
                            + 'rel="' + i + '" '
                            + 'class="toggle-check ui-widget-content ui-corner-all"  style="width: ' + (divWidthToggle) + '%; " >'; //dialog div
                    //r+= '<div align="center" style="margin-top: 5px; "> <button id="'+buttonId+'Reset" class="checkbox_filter" > reset </button> </div>'; //reset button and its div
                    r += divRowDef;

                    for (j = 0; j < iLen; j++) {

                        //if last check close div
                        if (j % numRow == 0 && j != 0) {
                            r += divClose + divRowDef;
                        }

                        var sLabel = aData[j];
                        var sValue = aData[j];

                        if (typeof (aData[j]) == 'object') {
                            sLabel = aData[j].label;
                            sValue = aData[j].value;
                        }

                        //check button
                        r += '<input class="search_init checkbox_filter btn btn-default ' + cssClass + '" type="checkbox" id= "' + uniqueId + '_cb_' + sValue + '" name= "' + localLabel + '" value="' + sValue + '" >' + sLabel + '<br/>';

                        var checkbox = $(r);
                        th.html(checkbox);
                        th.wrapInner('<span class="filter_column filter_checkbox" />');
                        //on every checkbox selection
                        checkbox.change(function () {

                            var search = '';
                            var or = '|'; //var for select checks in 'or' into the regex
                            var resSize = $('input:checkbox[name="' + localLabel + '"]:checked').size();
                            $('input:checkbox[name="' + localLabel + '"]:checked').each(function (index) {

                                //search = search + ' ' + $(this).val();
                                //concatenation for selected checks in or
                                if ((index == 0 && resSize == 1)
                                        || (index != 0 && index == resSize - 1)) {
                                    or = '';
                                }
                                //trim
                                search = search.replace(/^\s+|\s+$/g, "");
                                search = search + $(this).val() + or;
                                or = '|';

                            });


                            if (search != "") {
                                $('input:checkbox[name="' + localLabel + '"]').removeClass("search_init");
                            } else {
                                $('input:checkbox[name="' + localLabel + '"]').addClass("search_init");
                            }
                            /* Old code for setting search_init CSS class on checkboxes if any of them is checked
                             for (var jj = 0; jj < iLen; jj++) {
                             if (search != "") {
                             $('#' + aData[jj]).removeClass("search_init");
                             } else {
                             $('#' + aData[jj]).addClass("search_init");
                             }
                             }
                             */

                            //execute search
                            oTable.fnFilter(search, index, true, false);
                            fnOnFiltered();
                        });
                    }

                    //filter button
                    $('#' + buttonId).button();
                    //dialog
                    $('#' + checkToggleDiv).dialog({
                        //height: 140,
                        autoOpen: false,
                        //show: "blind",
                        hide: "blind",
                        buttons: [{
                                text: "Reset",
                                click: function () {
                                    //$('#'+buttonId).removeClass("filter_selected"); //LM remove border if filter selected
                                    $('input:checkbox[name="' + localLabel + '"]:checked').each(function (index3) {
                                        $(this).attr('checked', false);
                                        $(this).addClass("search_init");
                                    });
                                    oTable.fnFilter('', index, true, false);
                                    fnOnFiltered();
                                    return false;
                                }
                            },
                            {
                                text: "Close",
                                click: function () {
                                    $(this).dialog("close");
                                }
                            }
                        ]
                    });


                    $('#' + buttonId).click(function () {

                        $('#' + checkToggleDiv).dialog('open');
                        var target = $(this);
                        $('#' + checkToggleDiv).dialog("widget").position({my: 'top',
                            at: 'bottom',
                            of: target
                        });

                        return false;
                    });

                    var fnOnFilteredCurrent = fnOnFiltered;

                    fnOnFiltered = function () {
                        var target = $('#' + buttonId);
                        $('#' + checkToggleDiv).dialog("widget").position({my: 'top',
                            at: 'bottom',
                            of: target
                        });
                        fnOnFilteredCurrent();
                    };
                    //reset
                    /*
                     $('#'+buttonId+"Reset").button();
                     $('#'+buttonId+"Reset").click(function(){
                     $('#'+buttonId).removeClass("filter_selected"); //LM remove border if filter selected
                     $('input:checkbox[name="'+localLabel+'"]:checked').each(function(index3) {
                     $(this).attr('checked', false);
                     $(this).addClass("search_init");
                     });
                     oTable.fnFilter('', index, true, false);
                     return false;
                     }); 
                     */
                }

                function fnPrepareForCallback(oTable, aoColumn) {
                    var index = i;
                    var s = aoColumn.callback(oTable, aoColumn, $(this));

                    var object = $(s);
                    th.html(object);
                }

                function _fnRangeLabelPart(iPlace) {
                    switch (iPlace) {
                        case 0:
                            return sRangeFormat.substring(0, sRangeFormat.indexOf("{from}"));
                        case 1:
                            return sRangeFormat.substring(sRangeFormat.indexOf("{from}") + 6, sRangeFormat.indexOf("{to}"));
                        default:
                            return sRangeFormat.substring(sRangeFormat.indexOf("{to}") + 4);
                    }
                }

                var oTable = this;

                var defaults = {
                    sPlaceHolder: "head:before",
                    sRangeSeparator: "~",
                    iFilteringDelay: 10,
                    aoColumns: null,
                    sRangeFormat: "{from} {to}",
                    sDateFromToken: "from",
                    sDateToToken: "to"
                };

                var properties = $.extend(defaults, options);

                return this.each(function () {

                    if (!oTable.fnSettings().oFeatures.bFilter)
                        return;
                    asInitVals = new Array();

                    var aoFilterCells = oTable.fnSettings().aoFooter[0];

                    var oHost = oTable.fnSettings().nTFoot; //Before fix for ColVis
                    var sFilterRow = "tr"; //Before fix for ColVis

                    if (properties.sPlaceHolder == "head:after") {
                        var tr = $("tr:first", oTable.fnSettings().nTHead).detach();
                        //tr.appendTo($(oTable.fnSettings().nTHead));
                        if (oTable.fnSettings().bSortCellsTop) {
                            tr.prependTo($(oTable.fnSettings().nTHead));
                            //tr.appendTo($("thead", oTable));
                            aoFilterCells = oTable.fnSettings().aoHeader[1];
                        }
                        else {
                            tr.appendTo($(oTable.fnSettings().nTHead));
                            //tr.prependTo($("thead", oTable));
                            aoFilterCells = oTable.fnSettings().aoHeader[0];
                        }

                        sFilterRow = "tr:last";
                        oHost = oTable.fnSettings().nTHead;

                    } else if (properties.sPlaceHolder == "head:before") {

                        if (oTable.fnSettings().bSortCellsTop) {
                            var tr = $("tr:first", oTable.fnSettings().nTHead).detach();
                            tr.appendTo($(oTable.fnSettings().nTHead));
                            aoFilterCells = oTable.fnSettings().aoHeader[1];
                        } else {
                            aoFilterCells = oTable.fnSettings().aoHeader[0];
                        }
                        /*else {
                         //tr.prependTo($("thead", oTable));
                         sFilterRow = "tr:first";
                         }*/

                        sFilterRow = "tr:first";

                        oHost = oTable.fnSettings().nTHead;


                    }

                    //$(sFilterRow + " th", oHost).each(function (index) {//bug with ColVis
                    $(aoFilterCells).each(function (index) {//fix for ColVis
                        i = index;
                        var aoColumn = {type: "text",
                            bRegex: false,
                            bSmart: true,
                            iMaxLenght: -1,
                            iFilterLength: 0,
                            callback: null,
                            placeholder: "",
                            withoutCalendar: "",
                            classLol: ""
                        };
                        if (properties.aoColumns != null) {
                            if (properties.aoColumns.length < i || properties.aoColumns[i] == null)
                                return;
                            aoColumn = properties.aoColumns[i];
                        }

                        if (typeof (aoColumn.placeholder) === "undefined") {
                            aoColumn.placeholder = "";
                        }
                        
                        if (typeof (aoColumn.withoutCalendar) === "undefined") {
                            aoColumn.withoutCalendar = 0;
                        }

                        //label = $(this).text(); //Before fix for ColVis
                        label = $($(this)[0].cell).text(); //Fix for ColVis
                        if (aoColumn.sSelector == null) {
                            //th = $($(this)[0]);//Before fix for ColVis
                            th = $($(this)[0].cell); //Fix for ColVis
                        }
                        else {
                            th = $(aoColumn.sSelector);
                            if (th.length == 0)
                                th = $($(this)[0].cell);
                        }

                        if (aoColumn != null) {
                            if (aoColumn.sRangeFormat != null)
                                sRangeFormat = aoColumn.sRangeFormat;
                            else
                                sRangeFormat = properties.sRangeFormat;
                            switch (aoColumn.type) {
                                case "null":
                                    break;
                                case "number":
                                    fnCreateInput(oTable, true, false, true, aoColumn.iFilterLength, aoColumn.iMaxLenght, aoColumn.placeholder, aoColumn.classLol);
                                    break;
                                case "select":
                                    if (aoColumn.bRegex != true)
                                        aoColumn.bRegex = false;
                                    fnCreateSelect(oTable, aoColumn.values, aoColumn.bRegex, aoColumn.selected, aoColumn.multiple, aoColumn.classLol);
                                    break;
                                case "number-range":
                                    fnCreateRangeInput(oTable, aoColumn.classLol);
                                    break;
                                case "date-range":
                                    fnCreateDateRangeInput(oTable, aoColumn.withoutCalendar, aoColumn.classLol);
                                    break;
                                case "checkbox":
                                    fnCreateCheckbox(oTable, aoColumn.values, aoColumn.classLol);
                                    break;
                                case "twitter-dropdown":
                                case "dropdown":
                                    fnCreateDropdown(aoColumn.values, aoColumn.classLol);
                                    break;
                                case "custom":
                                    if (null != aoColumn.callback && undefined != aoColumn.callback) {
                                        fnPrepareForCallback(oTable, aoColumn);
                                    }
                                    break;
                                case "text":
                                default:
                                    bRegex = (aoColumn.bRegex == null ? false : aoColumn.bRegex);
                                    bSmart = (aoColumn.bSmart == null ? false : aoColumn.bSmart);
                                    fnCreateInput(oTable, bRegex, bSmart, false, aoColumn.iFilterLength, aoColumn.iMaxLenght, aoColumn.placeholder, aoColumn.classLol);
                                    break;

                            }
                        }
                    });

                    for (j = 0; j < aiCustomSearch_Indexes.length; j++) {
                        //var index = aiCustomSearch_Indexes[j];
                        var fnSearch_ = function () {
                            var id = oTable.attr("id");
                            return $("#" + id + "_range_from_" + aiCustomSearch_Indexes[j]).val() + properties.sRangeSeparator + $("#" + id + "_range_to_" + aiCustomSearch_Indexes[j]).val()
                        }
                        afnSearch_.push(fnSearch_);
                    }

                    if (oTable.fnSettings().oFeatures.bServerSide) {

                        var fnServerDataOriginal = oTable.fnSettings().fnServerData;

                        oTable.fnSettings().fnServerData = function (sSource, aoData, fnCallback) {

                            for (j = 0; j < aiCustomSearch_Indexes.length; j++) {
                                var index = aiCustomSearch_Indexes[j];

                                for (k = 0; k < aoData.length; k++) {
                                    if (aoData[k].name == "sSearch_" + index)
                                        aoData[k].value = afnSearch_[j]();
                                }
                            }
                            aoData.push({"name": "sRangeSeparator", "value": properties.sRangeSeparator});

                            if (fnServerDataOriginal != null) {
                                if (properties.iFilteringDelay != 0) {
                                    if (oFunctionTimeout != null)
                                        window.clearTimeout(oFunctionTimeout);
                                    oFunctionTimeout = window.setTimeout(function () {
                                        try {
                                            fnServerDataOriginal(sSource, aoData, fnCallback, oTable.fnSettings()); //TODO: See  Issue 18 
                                        } catch (ex) {
                                            fnServerDataOriginal(sSource, aoData, fnCallback);
                                        }
                                    }, properties.iFilteringDelay);
                                }
                            }
                            else {
                                if (properties.iFilteringDelay != 0) {
                                    if (oFunctionTimeout != null)
                                        window.clearTimeout(oFunctionTimeout);
                                    oFunctionTimeout = window.setTimeout(function () {
                                        $.getJSON(sSource, aoData, function (json) {
                                            fnCallback(json)
                                        });
                                    }, properties.iFilteringDelay);
                                }
                            }
                        };

                    }
                });
            };
        })(jQuery);
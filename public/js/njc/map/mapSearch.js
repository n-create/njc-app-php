/// <reference path='./markerClusterer.ts' />
/// <reference path='./mapDetail.ts' />
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
var map;
var mapSetting;
var dispSyuuhen = 13;
var placeService;
var homeControlDiv;
(function ($) {
    var markerClusterer;
    var mapdiv;
    var geocoder;
    var errorFlg = false;
    var area;
    var dialogId = "njcAreaView";
    var bukkenDialogId = "njcBukkenView";
    var formId = "bkSearchMapSetCondition";
    var loadingId = "njcLoading";
    var mapCenter;
    var prevDevice = null;
    var markers = new Array();
    var syuhenMarkers = new Array();
    /**
     * サイドバーを隠す時、デバイスに合わせてその動きを変えます。
     */
    function checkSearchHide(flg) {
        var header_h = $(".inner-header-contents-wrap").outerHeight(true);
        var panel_h = $(window).height() - header_h;
        panel_h = _getSpMinHeight(panel_h);
    }
    /**
     * スマホ時の地図の縦幅の最小値を返します。
     *
     * @param int   panel_h     現在計算された縦幅
     *
     * @return int 最小値以上の縦幅
     */
    function _getSpMinHeight(panel_h) {
        var min_h = 360;
        if ($(window).height() > $(window).width()) {
            min_h = 400;
        }
        if (min_h > panel_h) {
            panel_h = min_h;
        }
        return panel_h;
    }
    /**
     * サイドバーと地図のサイズをデバイスの横幅に合わせて動的に変化させます。
     */
    function isSpPreview() {
        return null !== prevDevice && 2 == prevDevice;
    }
    $.mapSearch = function (setting) {
        var mapSetting = setting;
        var mapSearch = mapSearchBase(mapSetting);
        if ("prevDevice" in mapSetting) {
            prevDevice = mapSetting.prevDevice;
        }
        geocoder = new google.maps.Geocoder();
        if (mapSetting.ctrl === "groupingMap") {
            mapCenter = new google.maps.LatLng(mapSetting.bukkenRender[0].lat, mapSetting.bukkenRender[0].lng);
            mapSearch.preInit();
        }
        else {
            if (mapSetting.ido == "" && mapSetting.keido == "") {
                geocoder.geocode({ address: mapSetting.companyAddress }, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        mapCenter = results[0].geometry.location;
                    }
                    else {
                        mapCenter = new google.maps.LatLng(35.689506, 139.691701);
                    }
                    mapSearch.preInit();
                });
            }
            else {
                mapCenter = new google.maps.LatLng(mapSetting.ido, mapSetting.keido);
                mapSearch.preInit();
            }
        }
        $(".ui-widget-overlay").on("click", function () {
            $(this).prev().find(".ui-dialog-content").dialog("close");
        });
        if ("bukken" in window) {
            initBkDetailGoogleMap();
            var markerOpt = {
                icon: mapSearchGetBkIconRes(bukken.chinOrBai, bukken.cruiNo, bukken.company),
                position: mapCenter,
                map: map
            };
            new google.maps.Marker(markerOpt);
        }
        homeControlDiv = document.createElement("DIV");
        homeControlDiv.index = 1;
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);
        (function () {
            var divId = "njcCityButton";
            var divIdAll = "njcSliderAllBukken";
            $("#" + divId).click(function () {
                $("#map_canvas").__loading();
                $("#" + bukkenDialogId).remove();
                mapSearch.cityAjax();
            });
            $("#" + divIdAll).click(function () {
                mapSearch.getAllBukken();
            });
        })();
        if ("MarkerClusterer" in window) {
            var mcOptions = {
                styles: [
                    {
                        height: 40,
                        width: 37,
                        textColor: "#f04030",
                        textSize: 14,
                        url: "/images/map/icn_map_BK_ttl_sdw.png"
                    },
                ],
                gridSize: 400 >
                    _getSpMinHeight($(window).height() -
                        $(".inner-header-contents-wrap").outerHeight(true))
                    ? 25
                    : 60,
                maxZoom: parseInt(mapSetting.maxZoomLevel) - 1
            };
            markerClusterer = new MarkerClusterer(map, [], mcOptions);
            markerClusterer.setCalculator(function (markers, numStyles) {
                var index = 0;
                var count = markers.length;
                var dv = count;
                while (dv !== 0) {
                    dv = parseInt(String(dv / 10), 10);
                    index++;
                }
                index = Math.min(index, numStyles);
                return {
                    text: '<div class="markerClusterer">' + count + "</div>",
                    index: index
                };
            });
        }
        function isNotEmptyAddress() {
            var result = false;
            if (undefined !== $(".mapAddSearch #address")) {
                if ("" !== $(".mapAddSearch #address").val()) {
                    result = true;
                }
            }
            return result;
        }
        $(".mapAddSearch .btn").click(function () {
            if (isNotEmptyAddress()) {
                mapSearch.codeAddressFreeword();
            }
        });
        $(".mapAddSearch #address").keypress(function (key) {
            if (key.which == 13 && isNotEmptyAddress()) {
                mapSearch.codeAddressFreeword();
            }
        });
        return mapSearch;
    };
    // $.mapSearch(a).base()
    //地図拡大表示
    $("#amplifyMap").click(function () {
        if ($("#amplifyMap").hasClass("amplifyMapSmall")) {
            $("#aspectwrapper").css({
                "padding-bottom": "500px",
                overflow: "hidden",
                position: "absolute",
                width: "80%"
            });
            $("#map_canvas").css({
                position: "absolute",
                width: "100%"
            });
            $(".bkSearchMap").css({
                height: "510px"
            });
            $(".container").css({
                margin: "0"
            });
            $("#amplifyMap")
                .removeClass("amplifyMapSmall")
                .addClass("amplifyMapLarge");
            $(this).attr("title", "地図を縮める");
        }
        else {
            $("#amplifyMap")
                .removeClass("amplifyMapLarge")
                .addClass("amplifyMapSmall");
            $(this).attr("title", "地図を広げる");
            $("#aspectwrapper").removeAttr("style");
            $("#map_canvas").css({
                width: "740px",
                position: "relative"
            });
            $(".bkSearchMap").removeAttr("style");
            $(".container").css({
                margin: "0 auto"
            });
        }
        google.maps.event.trigger(map, "resize");
    });
    var isHide = false;
    var mapSearchBase = function (mapSetting) {
        var mapSearch = {
            preInit: function () {
                mapSearch.base();
                mapSearch.initMap();
            },
            base: function () {
                mapdiv = $("#map_canvas").get(0);
                var mapOption = {
                    zoom: parseInt(mapSetting.zoom),
                    center: mapCenter,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    scaleControl: true,
                    mapTypeControl: false,
                    scrollwheel: false,
                    streetViewControl: true,
                    streetViewControlOptions: {
                        position: google.maps.ControlPosition.TOP_LEFT
                    },
                    zoomControl: true,
                    zoomControlOptions: {
                        position: google.maps.ControlPosition.LEFT_TOP
                    }
                };
                map = new google.maps.Map(mapdiv, mapOption);
                console.log(map.getCenter());
                google.maps.event.addDomListener(window, "resize", function () {
                    map.setCenter(map.getCenter());
                    $.each(markers, function (k, m) {
                        m.setMap(map);
                    });
                    if (markerClusterer) {
                        markerClusterer.clearMarkers();
                        markerClusterer.addMarkers(markers);
                    }
                });
                $(window).on("load resize", function () {
                    checkSearchHide(false);
                    if (!window.matchMedia("(max-width:768px)").matches ||
                        isSpPreview()) {
                        if (_isCreateDialog) {
                            _refineDiv.dialog("destroy");
                            $("body").removeClass("fixed").css({ top: 0 });
                            window.scrollTo(0, scrollpos);
                            _isCreateDialog = false;
                        }
                    }
                    map.setCenter(map.getCenter());
                    $.each(markers, function (k, m) {
                        m.setMap(map);
                    });
                    if (markerClusterer) {
                        markerClusterer.clearMarkers();
                        markerClusterer.addMarkers(markers);
                    }
                });
            },
            initMap: function () {
                mapSearch.changeSyuuhen(parseInt(mapSetting.zoom));
                if (mapSetting.companyIdo != "" || mapSetting.companyKeido != "") {
                    var markerOpt = {
                        icon: mapSetting.kaisyIcon,
                        position: new google.maps.LatLng(mapSetting.companyIdo, mapSetting.companyKeido),
                        map: map,
                        clickable: false
                    };
                    var marker = new google.maps.Marker(markerOpt);
                }
                //支店マーカー設定
                if (mapSetting.ctrl === "mapSearch") {
                    mapSearch.setSitenMarker();
                    if (mapSetting.openAreaFlg == 1) {
                        mapSearch.cityAjax();
                    }
                    mapSearch.getZahyou();
                    $("#" +
                        formId +
                        " input,#" +
                        formId +
                        " select,#" +
                        formId +
                        " textarea").change(function () {
                        mapSearch.getZahyou();
                    });
                    var preTarget = null;
                    $("input[name=mapSearchContents]").click(function () {
                        if (preTarget === null) {
                            preTarget = this;
                        }
                        else if ($(preTarget).prop("id") === $(this).prop("id")) {
                            $(this).prop("checked", false);
                            preTarget = null;
                        }
                        else {
                            $(preTarget).prop("checked", false);
                            preTarget = this;
                        }
                        mapSearch.setMarker();
                    });
                    google.maps.event.addListener(map, "dragend", function () {
                        mapSearch.setMarker();
                    });
                }
                else {
                    mapSearch.getGrpZahyou();
                }
                // @ts-ignore
                if ($("input[name='mapSearchContents']").size() > 0) {
                    var displayFlg = parseInt(mapSetting.zoom) <= dispSyuuhen
                        ? "display:block;"
                        : "display:none;";
                }
                if ($("input[name='mapSearchContents']").length > 0) {
                    var displayFlg = parseInt(mapSetting.zoom) <= dispSyuuhen
                        ? "display:block;"
                        : "display:none;";
                }
                var maxZ = parseInt(mapSetting.maxZoomLevel);
                var minZ = parseInt(mapSetting.minZoomLevel);
                google.maps.event.addListener(map, "zoom_changed", function () {
                    var zml = parseInt(map.getZoom());
                    mapSearch.changeSyuuhen(zml);
                    if (zml > maxZ) {
                        map.setZoom(maxZ);
                    }
                    else if (zml < minZ) {
                        map.setZoom(minZ);
                    }
                });
                console.log("=========================================\n" +
                    "          NJC GoogleMaps Custom          \n" +
                    "=========================================");
            },
            cityAjax: function () {
                $("#mapListDialog").__loading();
                $.ajax({
                    type: "POST",
                    cache: false,
                    data: "&map=1&" + $("#" + formId).serialize(),
                    url: mapSetting.urlCity,
                    success: function (dat) {
                        $("body").baseDivCreate({
                            idName: dialogId
                        });
                        $("#" + dialogId).html(dat);
                        mapSearch.dialog();
                        mapSearch.__areaAjax();
                        mapSearch.loadingRemove();
                    }
                });
            },
            setSitenMarker: function () {
                if (mapSetting.siten) {
                    $.each(mapSetting.siten, function (i, val) {
                        if (val.ido != "" || val.keido != "") {
                            var markerOpt = {
                                icon: mapSetting.kaisyIcon,
                                position: new google.maps.LatLng(val.ido, val.keido),
                                map: map,
                                clickable: false
                            };
                            var sitenMarker = new google.maps.Marker(markerOpt);
                        }
                    });
                }
            },
            changeSyuuhen: function (zoom) {
                var disabled = zoom <= dispSyuuhen ? true : false;
                $(':checkbox[name="mapSearchContents"]').prop("disabled", disabled);
                disabled ? $(".nrwMapBtn").hide() : $(".nrwMapBtn").show();
                mapSearch.displaySyuuhenAttension(disabled);
            },
            getAllBukken: function () {
                var mapRectObj = map.getBounds();
                var mapAreaSW = mapRectObj.getSouthWest();
                var mapAreaNE = mapRectObj.getNorthEast();
                $("#map_canvas").__loading();
                $.ajax({
                    type: "POST",
                    url: mapSetting.urlZahyouBukken,
                    data: "&" +
                        $("#" + formId).serialize() +
                        "&sw_longitude=" +
                        mapAreaSW.lng() +
                        "&sw_latitude=" +
                        mapAreaSW.lat() +
                        "&ne_longitude=" +
                        mapAreaNE.lng() +
                        "&ne_latitude=" +
                        mapAreaNE.lat() +
                        "&map=1&limit=100",
                    success: function (zahyouDat) {
                        mapSearch.bukkenSliderBase();
                        $("#" + bukkenDialogId).html(zahyouDat);
                        $(".njcMoveBottom")
                            .toggle()
                            .click(function () {
                            $.each(markers, function (i, val) {
                                var position = val.getPosition();
                            });
                        });
                        mapSearch.bukkenSlider();
                        mapSearch.loadingRemove();
                    }
                });
            },
            getZahyou: function () {
                if (undefined !== mapSetting.urlZahyou) {
                    $("#map_canvas").__loading();
                    $.ajax({
                        type: "POST",
                        url: mapSetting.urlZahyou,
                        data: $("#" + formId).serialize(),
                        success: function (zahyouDat) {
                            mapSearch.closeMarker(markers);
                            var obj = eval(zahyouDat);
                            var countI = 0;
                            var icon = "";
                            $.each(obj, function (countI, val) {
                                var changeIcon = mapSearchGetBkIconRes(mapSetting.chinOrBai, val.building_type.key, 1);
                                var markerOpt = {
                                    icon: changeIcon,
                                    position: new google.maps.LatLng(val.latitude, val.longitude),
                                    map: map,
                                    clickable: true,
                                    crui_no: val.building_type.key
                                };
                                var bukkenMarker = new google.maps.Marker(markerOpt);
                                markers.push(bukkenMarker);
                                google.maps.event.addListener(bukkenMarker, "click", function () {
                                    $.each(markers, function (i, val) {
                                        val.setIcon(mapSearchGetBkIconRes(mapSetting.chinOrBai, val.crui_no, 1));
                                    });
                                    this.setIcon(mapSearchGetBkIconRes(mapSetting.chinOrBai, val.building_type.key, 2));
                                    mapSearch.zahyouBukken(val.latitude, val.longitude);
                                });
                            });
                            if (markerClusterer) {
                                markerClusterer.clearMarkers();
                                markerClusterer.addMarkers(markers);
                            }
                            mapSearch.loadingRemove();
                        }
                    });
                }
            },
            getGrpZahyou: function () {
                $("#map_canvas").__loading();
                $.each(mapSetting.bukkenRender, function (countI, val) {
                    var setIcon = mapSearchGetBkIconRes(mapSetting.chinOrBai, val.crui_no, 1);
                    var markerOpt = {
                        icon: setIcon,
                        position: new google.maps.LatLng(val.lat, val.lng),
                        map: map,
                        clickable: true,
                        crui_no: val.crui_no
                    };
                    var bukkenMarker = new google.maps.Marker(markerOpt);
                    markers.push(bukkenMarker);
                    google.maps.event.addListener(bukkenMarker, "click", function () {
                        $.each(markers, function (i, val) {
                            val.setIcon(mapSearchGetBkIconRes(mapSetting.chinOrBai, val.crui_no, 1));
                        });
                        this.setIcon(mapSearchGetBkIconRes(mapSetting.chinOrBai, val.crui_no, 2));
                        mapSearch.zahyouGroupBukken(val.lat, val.lng);
                    });
                });
                mapSearch.loadingRemove();
            },
            zahyouBukken: function (ido, keido) {
                $("#map_canvas").__loading();
                $.ajax({
                    type: "POST",
                    url: mapSetting.urlZahyouBukken,
                    data: "latitude=" +
                        ido +
                        "&longitude=" +
                        keido +
                        "&map=1&" +
                        $("#" + formId).serialize(),
                    success: function (zahyouDat) {
                        mapSearch.bukkenSliderBase();
                        $("#" + bukkenDialogId).html(zahyouDat);
                        mapSearch.bukkenSlider();
                        mapSearch.loadingRemove();
                    }
                });
            },
            zahyouGroupBukken: function (ido, keido) {
                var bukkenId = new Array();
                $.each(mapSetting.bukkenData, function (i, val) {
                    bukkenId[i] = "bukken_id[]=" + val.id;
                });
                var bukkenParam = bukkenId.join("&");
                $("#map_canvas").__loading();
                $.ajax({
                    type: "POST",
                    url: mapSetting.urlZahyouBukken,
                    data: "latitude=" + ido + "&longitude=" + keido + "&map=1&" + bukkenParam,
                    success: function (zahyouDat) {
                        mapSearch.bukkenSliderBase();
                        $("#" + bukkenDialogId).html(zahyouDat);
                        mapSearch.bukkenSlider();
                        mapSearch.loadingRemove();
                    }
                });
            },
            closeMarker: function (marker) {
                var marker;
                $.each(marker, function () {
                    this.setVisible(false);
                });
                marker.length = 0;
            },
            __areaAjax: function () {
                $(".njcCityListAjax").click(function () {
                    $("#mapListDialog").__loading();
                    area = this.id;
                    $.ajax({
                        type: "GET",
                        cache: false,
                        url: mapSetting.urlArea,
                        data: "city_numbers[]=" +
                            $(this).attr("label") +
                            "&map=1&" +
                            $("#" + formId).serialize(),
                        success: function (dat) {
                            $("#" + dialogId).html("");
                            window.setTimeout(function () {
                                $("#" + dialogId).html(dat);
                                mapSearch.__dialogClose();
                            }, 1);
                        }
                    });
                });
                $(".mapDialogKen").click(function () {
                    mapSearch.codeAddress($(this).find("span").text());
                    mapSearch.__dialogRemove();
                });
            },
            __dialogClose: function () {
                $(".njcAreaListAjax").click(function () {
                    mapSearch.codeAddress($(this).data("postalCode"));
                    mapSearch.__dialogRemove();
                });
                $(".mapDialogKenSi").click(function () {
                    mapSearch.codeAddress(area);
                    mapSearch.__dialogRemove();
                });
                $(".mapDialogBack").click(function () {
                    mapSearch.cityAjax();
                });
            },
            codeAddress: function (areaname) {
                if (geocoder) {
                    geocoder.geocode({ componentRestrictions: { postalCode: areaname } }, function (results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            map.setCenter(results[0].geometry.location);
                            $.each(markers, function (k, m) {
                                m.setMap(map);
                            });
                            if (markerClusterer) {
                                markerClusterer.clearMarkers();
                                markerClusterer.addMarkers(markers);
                            }
                        }
                    });
                }
            },
            bukkenSliderBase: function () {
                $("#map_canvas > div").baseDivCreate({
                    idName: bukkenDialogId
                });
            },
            bukkenSlider: function () {
                var elementConveyor = $(".njcSliderConveyor");
                var elementItem = $(".njcSliderItem");
                var elementViewer = $(".njcSliderViewer");
                var elementClose = $(".njcSliderClose");
                var elementAllBukken = $(".njcSliderAllBukken");
                var elementBkCount = $(".njcSliderBukkenCount");
                var bkCountMin = elementBkCount.eq(1);
                var bkCountMax = elementBkCount.eq(2);
                var elementItemW = parseInt(elementItem.css("width"));
                var itemRange = 0;
                var d = 0;
                // @ts-ignore
                var conveyorWidth = elementItem.size() * elementItemW;
                var viewerWidth = elementViewer.width();
                elementConveyor.css("width", conveyorWidth + "px");
                var sliderMax = conveyorWidth - viewerWidth;
                var realCounter = Math.ceil(viewerWidth / elementItemW);
                bkCountMax.html("" + realCounter);
                if (sliderMax >= 0) {
                    var sliderOpts = {
                        max: sliderMax,
                        range: "max",
                        slide: function (e, ui) {
                            elementConveyor.css("left", "-" + ui.value + "px");
                            d = ~~(ui.value / elementItemW);
                            if (d !== itemRange) {
                                setTimeout(function () {
                                    bkCountMin.html("" + (d + 1));
                                    bkCountMax.html("" + (realCounter + d));
                                }, 0);
                                itemRange = d;
                            }
                        }
                    };
                    setTimeout(function () {
                        $("#njcSliderBottom").toggle();
                        $("#slider")
                            .css("width", viewerWidth * 0.7 + "px")
                            .slider(sliderOpts);
                    }, 100);
                }
                elementClose.click(function () {
                    $("#" + bukkenDialogId).remove();
                });
                elementAllBukken.click(function () {
                    mapSearch.getAllBukken();
                });
                if (window.matchMedia("(max-width:768px)").matches || isSpPreview()) {
                    if (!isHide && $(window).height() < $(window).width()) {
                        $(".btnSearchHide").trigger("click");
                    }
                }
            },
            loadingRemove: function () {
                $("#" + loadingId).remove();
            },
            dialog: function () {
                var w = "500px";
                if (window.matchMedia("(max-width:768px)").matches || isSpPreview()) {
                    w = isSpPreview() ? "288px" : "90%";
                }
                $("#" + dialogId).dialog({
                    resizable: true,
                    modal: true,
                    title: "住所を選択",
                    width: w,
                    height: 400,
                    draggable: true,
                    position: ["center"],
                    open: function (event, ui) {
                        // @ts-ignore
                        $(this).closest(".ui-dialog").find(".ui-button-text").hidden;
                        $(this).closest(".ui-dialog").find("button").blur();
                        mapSearch.__bodyScrollLock(true);
                    },
                    close: function () {
                        mapSearch.__dialogRemove();
                    }
                });
            },
            __dialogRemove: function () {
                $("#" + dialogId)
                    .dialog("destroy")
                    .remove();
                mapSearch.__bodyScrollLock(false);
                mapSearch.loadingRemove();
            },
            __bodyScrollLock: function (lock) {
                if (lock) {
                    $("body").css({
                        height: $("body").get(0).clientHeight,
                        overflow: "hidden"
                    });
                }
                else {
                    $("body").css({ height: "auto", overflow: "visible" });
                }
            },
            displaySyuuhenAttension: function (flg) {
                var display = flg ? "block" : "none";
                $(".syuuhen_attension").css("display", display);
            },
            setMarker: function () {
                placeService = new google.maps.places.PlacesService(map);
                mapSearch.closeMarker(syuhenMarkers);
                $("input[name=mapSearchContents]:checked:enabled").each(function () {
                    // @ts-ignore
                    var targetContents = mapSetting.searchObj[this.value];
                    $.each(targetContents.keyWord, function (key, keyWord) {
                        mapSearch.__getMarker(targetContents, keyWord);
                    });
                });
            },
            __getMarker: function (targetContents, keyWord) {
                var request = {
                    location: new google.maps.LatLng(map.getCenter().lat(), map.getCenter().lng()),
                    rankBy: google.maps.places.RankBy.DISTANCE,
                    types: [keyWord]
                };
                $("#map_canvas").__loading();
                placeService.search(request, function (results, status) {
                    if (status === google.maps.places.PlacesServiceStatus.OK ||
                        status === google.maps.places.PlacesServiceStatus.ZERO_RESULTS) {
                        $.each(results, function (i, val) {
                            var markerOpt = {
                                icon: targetContents.img,
                                position: val.geometry.location,
                                map: map
                            };
                            var marker = new google.maps.Marker(markerOpt);
                            syuhenMarkers[syuhenMarkers.length] = marker;
                            var infoWindow = new google.maps.InfoWindow({
                                content: val.name
                            });
                            google.maps.event.addListener(marker, "click", function () {
                                infoWindow.open(map, marker);
                            });
                            errorFlg = false;
                        });
                    }
                    else if (errorFlg == false) {
                        errorFlg = true;
                        if (status != google.maps.places.PlacesServiceStatus.OVER_QUERY_LIMIT) {
                            alert("Googleから応答がありません、しばらくたってから再度お試しください。");
                        }
                    }
                    mapSearch.loadingRemove();
                });
            },
            codeAddressFreeword: function () {
                var searchMapMarker = new google.maps.Marker();
                searchMapMarker.setMap(null);
                var address = document.getElementById("address")
                    .value;
                var service = new google.maps.places.PlacesService(map);
                var alertMsgFlg = document.getElementById("mapAddSearchAlertId");
                service.textSearch({
                    location: map.getCenter(),
                    radius: 1000,
                    bounds: map.getBounds(),
                    query: address
                }, function (results, status) {
                    if (status == google.maps.places.PlacesServiceStatus.OK) {
                        var position = results[0].geometry.location;
                        if (alertMsgFlg !== null) {
                            $("#mapAddSearchAlertId").remove();
                        }
                        map.setCenter(position);
                        $.each(markers, function (k, m) {
                            m.setMap(map);
                        });
                        searchMapMarker.setPosition(position);
                        searchMapMarker.setMap(map);
                    }
                    else {
                        if (alertMsgFlg === null) {
                            $("div.mapAddSearch").after('<p id="mapAddSearchAlertId">対象の住所・施設が見つかりません。ご入力内容をご確認の上、再度ご入力ください。</p>');
                        }
                    }
                    $("#amplifyMap").on("click", function () {
                        google.maps.event.trigger(map, "resize");
                        map.setCenter(position);
                        $.each(markers, function (k, m) {
                            m.setMap(map);
                        });
                        searchMapMarker.setPosition(position);
                        searchMapMarker.setMap(map);
                    });
                });
            }
        };
        return mapSearch;
    };
    $.fn.baseDivCreate = function (options) {
        if ($("#" + options.idName).length === 0) {
            this.append('<div id="' + options.idName + '"></div>');
        }
    };
    $.fn.__loading = function () {
        $("#" + bukkenDialogId).remove();
        this.loadingImg({
            img: "/images/loading.gif",
            backImg: "/images/map/back.png"
        });
    };
    $.fn.loadingImg = function (options) {
        var divId = "njcLoading";
        this.baseDivCreate({ idName: divId });
        $("#" + divId)
            .css({
            position: "absolute",
            width: "65px",
            height: "65px",
            top: "50%",
            left: "50%",
            transform: "translate(-50%, -50%)",
            "background-image": "url(" + options.backImg + ")",
            padding: "5px",
            opacity: "0.92"
        })
            .html('<img src="' + options.img + '">');
        $("#" + divId + " img").css("background-color", "#ffffff");
    };
    $(".btnSearchHide").click(function () {
        $(this).toggleClass("on");
        checkSearchHide(true);
        isHide = !isHide;
        google.maps.event.trigger(map, "resize");
        map.setCenter(map.getCenter());
        $.each(markers, function (k, m) {
            m.setMap(map);
        });
        if (markerClusterer) {
            markerClusterer.clearMarkers();
            markerClusterer.addMarkers(markers);
        }
    });
    var _refineDiv = $(".mapSideSearch .searchBox");
    var scrollpos;
    var _isCreateDialog = false;
    $("#njcAddRefine").click(function () {
        var winW = $(window).width();
        var winH = $(window).height();
        var dlgW = "90%";
        var dlgH = winH * 0.9;
        _isCreateDialog = true;
        _refineDiv
            .dialog({
            width: dlgW,
            height: dlgH,
            maxHeight: dlgH,
            modal: true,
            resizable: false,
            open: function () {
                scrollpos = $(window).scrollTop();
                $("body").addClass("fixed").css({ top: -scrollpos });
            },
            close: function () {
                $("body").removeClass("fixed").css({ top: 0 });
                window.scrollTo(0, scrollpos);
            }
        })
            .dialog("open");
    });
    $(".btnNowDistination").click(function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (pos) {
                var Potition_latitude = pos.coords.latitude;
                var Potition_longitude = pos.coords.longitude;
                mapCenter = new google.maps.LatLng(Potition_latitude, Potition_longitude);
                map.setCenter(mapCenter);
                $.each(markers, function (k, m) {
                    m.setMap(map);
                });
                if (markerClusterer) {
                    markerClusterer.clearMarkers();
                    markerClusterer.addMarkers(markers);
                }
            }, function (error) {
                var errorMessage = {
                    0: "原因不明のエラーが発生しました…。",
                    1: "位置情報の取得が許可されませんでした…。",
                    2: "電波状況などで位置情報が取得できませんでした…。",
                    3: "位置情報の取得に時間がかかり過ぎてタイムアウトしました…。"
                };
                console.log(error);
                alert(errorMessage[error.code]);
            }, {
                enableHighAccuracy: false,
                timeout: 8000,
                maximumAge: 2000
            });
        }
        else {
            alert("本ブラウザではGeolocationが使えません");
        }
    });
})(jQuery);
function mapSearchGetBkIconRes(chinOrBai, cruiNo, iconType) {
    return ("/images/map/icon_bukken_map_" +
        (chinOrBai == 1 ? "c" : "b") +
        cruiNo +
        (iconType == 1 ? "_sdw" : "_select") +
        ".png");
}
function mapSearchHomeControlRes(controlDiv, map, bkLatlng) {
    controlDiv.style.padding = "7px";
    var controlUI = document.createElement("DIV");
    if ("bukken" in window && true !== bukken.company) {
        controlUI.innerHTML =
            '<input type="image" src="/images/map/btn_back_bukken.png" alt="物件に戻る" id="backButton">';
    }
    controlDiv.appendChild(controlUI);
    // Setup the click event listeners: simply set the map to Chicago
    google.maps.event.addDomListener(controlUI, "click", function () {
        map.setCenter(bkLatlng);
    });
}

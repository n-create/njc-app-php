/// <reference path="./mapSearch.ts" />
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
/*var mapGeoCode;
var map;
var searchMapMarker;

function mapGeocodeInitialize() {
  mapGeoCode = new google.maps.Geocoder();
  searchMapMarker = new google.maps.Marker();
}

function codeAddress() {
  $.mapSearch({}).codeAddressFreeword(mapGeoCode, searchMapMarker);
}
google.maps.event.addDomListener(window, "load", mapGeocodeInitialize);

$(function () {
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
      codeAddress();
    }
  });
  $(".mapAddSearch #address").keypress(function (key) {
    if (key.which == 13 && isNotEmptyAddress()) {
      codeAddress();
    }
  });
});*/

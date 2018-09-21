<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php
  $mapSearchOption = [
      'searchObj'          => $searchManager::$searchObject,
      'icon'               => "/images/map/icon_bukken_map_mini.gif",
      'kaiinIcon'          => "/images/map/icon_kaiin.png",
      'kaiinLoginIcon'     => "/images/map/icon_kaiin2.png",
      'kaisyIcon'          => "/images/map/icon_kaisya_sdw.png",
      'iconSetting'        => "/images/map/icon_bukken_select_map.gif",
      'urlArea'            => "/{$rentSaleStr}/getMapArea",
      'urlCity'            => "/{$rentSaleStr}/getMapCity",
      'urlZahyou'          => "/{$rentSaleStr}/getMapZahyou",
      'urlZahyouBukken'    => "/{$rentSaleStr}/getMapZahyouBukken",
      'loadingImg'         => "/images/loading.gif",
      'openAreaFlg'        => true,
      'zoom'               => 10,
      'ido'                => 31.726937,
      'keido'              => 131.0658848,
      'isLogin'            => false,
      'maxZoomLevel'       => 19,
      'minZoomLevel'       => 10,
      'companyAddress'     => "宮崎県都城市中町",
      'companyIdo'         => 31.726937,
      'companyKeido'       => 131.0658848,
      'ctrl'               => "mapSearch",
      'chinOrBai'          => (RS_STR_RENT === $rentSaleStr) ? RS_CODE_RENT : RS_CODE_SALE,
      'siten'              => [],
  ];
?>
<div class="mapMainPanel row mx-0">
  <div class="mapSideSearch col-auto px-0">
    <div class="mapAddSearch pt-2 bg-light text-center">
      <input id="address" type="text" placeholder="住所・施設名を入力してください"/>
      <input type="button" value="検索" class="btn btn-sm"/>
    </div>
    <div class="mapDiscription clearfix py-2 bg-light text-center">
      <div class="btnArea">
        <button id="njcCityButton" class="btn btn-info btn-sm">住所から検索</button>
        <button id="njcSliderAllBukken" class="btn btn-info btn-sm">全物件を表示</button>
        <button id="njcAddRefine" class="btn btn-info btn-sm sp-view">条件を追加</button>
      </div>
    </div>
    <div class="content <?= $rentSaleStr ?> col-12">
      <div class="searchBox">
        <form id="bkSearchMapSetCondition" onsubmit="return false;" method="POST">@include ('searchItems.indexSearchBox', [$searchManager, $dispSearch, $rentSaleStr])</form>
      </div>
    </div>
  </div>
  <div class="func bkSearchMap col-auto px-0">
    <div id="aspectwrapper">
      <div id="map_canvas" style="width: 100%;"></div>
    </div>
    <div class="btnNowDistination"><span></span></div>
    <div class="btnSearchHide"><span></span></div>
    <div class="absolute">
      <div class="divFacility">
        <div class="nrwMapBtn">
          <div></div>
        </div>
        <div id="shuhenForm" style="display: none;">
          <div class="h5 facilityBottom"><span>施設</span>
            <p class="syuuhen_attension_origin">地図の縮尺度数を拡大して、以下より選択すると最大20件まで周辺施設を表示することができます</p>
          </div>
          <div class="func bkMapSyuuhenForm clearfix"><?php // $BkMapHelper->bkMapSyuuhenForm() ?></div>
        </div>
        <div class="mapFacility">
          <div class="func bkMapSyuuhenForm clearfix"><?php // $BkMapHelper->bkMapBkCruiForm() ?></div>
        </div>
      </div>
    </div>
  </div>
</div><?php
  $script_files = [
      "/js/components/jquery/jquery-ui/jquery-ui.custom.js",
      "/js/components/jquery/jquery-ui/jquery.ajaxDialog.js",
      GOOGLE_MAPS_API."?key=".env('GOOGLE_MAPS_KEY')."&libraries=places&language=ja",
      "/js/njc/map/mapSearch.js",
      "/js/njc/map/mapGeocode.js",
      "/js/njc/map/markerClusterer.js",
  ];
?>
<?php foreach($script_files as $filePath) { ?>
<script type="text/javascript" src="{{ $filePath }}?_={{ date('Ymdhis') }}"></script><?php } ?>
<script>
  $(function() { 
    var mapDat = new jQuery.mapSearch(<?= json_encode($mapSearchOption); ?>);
  });
</script>

<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php if(!empty($detailData[$searchManager::BK_DATA_MAPOPEN])) { ?>
<?php
  $mapSearchOption = [
      'cruiNo'            => 1,
      'icon'               => "/images/map/icon_bukken_map.gif",
      'kaiinIcon'          => "/images/map/icon_kaiin.png",
      'maxZoomLevel'       => 19,
      'minZoomLevel'       => 10,
      'zoom'               => 10,
      'draggable'          => true,
      'chinOrBai'          => (RS_STR_RENT == $rentSaleStr) ? RS_CODE_RENT : RS_CODE_SALE,
      'searchObj'          => $searchManager::$searchObject,
      'ido'                => $searchManager->getAndCheckBkData($detailData, $searchManager::BK_DATA_IDO, null),
      'keido'              => $searchManager->getAndCheckBkData($detailData, $searchManager::BK_DATA_KEIDO, null),
      'ctrl'               => 'mapSearch',
  ];
  $mapIcon = [
      'ConvenienceStore' => 'コンビニ',
      'laundry' => 'クリーニング店',
      'library' => '図書館',
      'supermarket' => 'スーパー',
      'depart' => '百貨店・モール',
      'post' => '郵便局',
      'rental' => 'レンタルビデオ',
      'school' => '学校',
      'parking_map' => '駐車場',
      'restaurant' => 'レストラン',
      'bank' => '銀行',
      'spa' => '温泉・スパ',
      'hospital' => '病院',
      'park' => '公園',
      'atm' => 'ATM',
  ];
?>
<div data-subtitle="MAP" class="h2">地図</div>
<div class="flesh-wrap">
  <div class="parts bkDetailMap">
    <div class="map">
      <div>
        <div id="map_canvas" style="width:100%; height: 500px;" class="text-center mb-2"><img src="/images/dummy/dummy_map_detail.png" class="w-100"/></div>
        <div class="nrwMapBtn"><span></span></div>
        <div id="shuhenForm" class="func bkMapSyuuhenForm clearfix">
          <p class="syuuhen-attension-origin">地図の縮尺度数を拡大すると、以下の周辺情報を表示することができます。</p>
          <ul class="syuuhen-info row"><?php foreach($mapIcon as $key => $title) { ?>
            <li class="syuuhen-item col-lg-3 col-md-4 mb-2">
              <input type="checkbox" name="mapSearchContents" value="{{ $key }}" id="{{ $key }}" class="d-none"/>
              <label for="{{ $key }}" class="{{ $key }} mb-0 d-block btn btn-outline-info text-left"><img src="/images/map/icon_{{ $key }}.png" alt="{{ $title }}" class="mr-1"/>{{ $title }}</label>
            </li><?php } ?>
          </ul>
        </div>
      </div>
      <div id="mapRouteWrap" class="mb-2 p-3 bg-light">
        <div class="map-attention">
          <p class="map-attention-main">地図上を「クリック」すると、物件からその地点までの経路が表示されます。</p>
        </div>
        <div class="mapRoute">
          <ul class="routeSelect btn-group mb-md-0 mb-1">
            <li tmode="DRIVING" class="button btn btn-info">自動車</li>
            <li tmode="WALKING" class="onMode button btn btn-info border-left active">徒歩</li>
          </ul>
          <div class="routeDistance">
            <p class="mapDistanceExplain mb-0">経路の距離と時間：</p>
            <div class="mapDistanceContext"><span class="mapDistance">-</span>，<span class="mapDuration">-</span></div>
          </div>
        </div>
      </div><small class="map-attention-bottom">※地図上の各種のアイコンなどの情報は、付近住所に所在する事を示すものであり、正確な地点を保証するものではありません。</small>
    </div>
  </div>
</div><?php
  $script_files = [
      GOOGLE_MAPS_API."?key=".env('GOOGLE_MAPS_KEY')."&libraries=places&language=ja",
      "/js/njc/map/mapSearch.js",
      "/js/njc/map/mapSyuuhenForm.js",
      "/js/njc/map/mapDetail.js",
  ];
?>
<?php foreach($script_files as $filePath) { ?>
<script type="text/javascript" src="{{ $filePath }}?_={{ date('Ymdhis') }}"></script><?php } ?>
<script>
  var bukken = (<?= json_encode($mapSearchOption); ?> );
  $(function(){
    var mapDat = new jQuery.mapSearch( <?= json_encode($mapSearchOption) ?> );
  });
</script><?php } ?>

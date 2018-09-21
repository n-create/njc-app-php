<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<div class="parts">
  <div class="h3 mb-3">市区町村を選択してください。</div>
  <div class="clearfix">
    <?php
      $searchManager = new App\Services\Helper\SearchItemHelper();
      $cityData = $searchManager->getMapCityData(RS_STR_SALE);
      $keyData = $searchManager::$convertKey[$searchManager::BK_DATA_CITY];
    ?>
    <div id="mapListDialog">
      <?php if(is_array($cityData)) { ?>
      <?php foreach($cityData as $data) { ?>
      <div class="h5 mapDialogKen"><span class="clickable">{{ $data[$keyData['keyText']] }}</span></div>
      <ul class="areaList">
        <?php foreach($data[$keyData['keyGroup']] as $areaData) { ?>
        <?php
          $id = $data[$keyData['keyText']].$areaData[$keyData['keyGroupText']];
          $value = $areaData[$keyData['keyGroupValue']];
          $text = $areaData[$keyData['keyGroupText']];
          if(isset($areaData['count'])) {
              $text .= "(" . $areaData['count'] . "件)";
          }
        ?>
        <li label="{{ $value }}" id="{{ $id }}" class="njcCityListAjax"><span class="clickable">{{ $text }}</span></li><?php } ?>
      </ul><?php } ?>
      <?php } else { ?>
      <div>登録された物件がありません。</div><?php } ?>
    </div>
  </div>
</div>

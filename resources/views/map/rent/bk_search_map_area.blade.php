
<?php
/**
* Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
*/
?>
<div class="parts">
  <div class="h3 mb-3">町域を選択してください。</div>
  <div class="clearfix">
    <?php
      $searchManager = new App\Services\Helper\SearchItemHelper();
      $areaData = $searchManager->getMapAreaData(RS_STR_RENT);
      $areaData = $searchManager->checkAndSetBlankAreaName($areaData);
      $areaData = $searchManager->convertAreaData($areaData);
      $keyData = $searchManager::$convertKey[$searchManager::BK_DATA_AREA];
    ?>
    <div id="mapListDialog"><?php foreach($areaData as $data) { ?>
      <div class="h5"><span class="clickable mapDialogKenSi">{{ $data[$keyData['keyText']] }}({{ $searchManager->getTotalCountArea($data['towns']) }})</span></div>
      <ul class="areaList"><?php foreach($data[$keyData['keyGroup']] as $choHead => $areaChild) { ?>
        <li class="mapChoHead mt-2">{{ $choHead.(1 === mb_strlen($choHead) ? '行' : '') }}</li><?php foreach($areaChild as $area) { ?>
        <?php
          $id = $area[$keyData['keyGroupText']];
          $text = $area[$keyData['keyGroupText']];
          if (empty($text)) {
              $id = $data['keyText'];
              $text = '未分類';
          }
          $value = $area[$keyData['keyGroupValue']];
          if (8 < strlen($value)) {
              $value = substr($value, 0, 8);
          }
          if(isset($area['count'])) {
              $text .= "(" . $area['count'] . "件)";
          }
        ?>
        <li id="{{ $id }}" data-postal-code="{{ $value }}" class="njcAreaListAjax"><span class="clickable">{{ $text }}</span></li><?php } ?>
        <?php } ?>
      </ul><?php } ?>
      <div id="mapDialog-Btn-Back" class="btn btn-outline-secondary"><a target="_self" class="mapDialogBack">戻る</a></div>
    </div>
  </div>
</div>
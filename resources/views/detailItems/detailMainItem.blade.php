<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
  $data = $searchManager->getAndCheckBkData($detailData, $dataKey, null);
  if("-" !== $data && $searchManager::BK_DATA_AROUNDS !== $dataKey) {
      if($searchManager::BK_DATA_AREASIZE === $dataKey) {
          $area_keisoku = "";
          if(!empty($detailData[$searchManager::BK_DATA_AREASIZE_KEI]['value'])) {
              $area_keisoku = "（{$detailData[$searchManager::BK_DATA_AREASIZE_KEI]['value']}）";
          }
          $data = number_format($data, 2) . "{$area_keisoku}㎡(" . (floor($data * 0.3025 * 100) / 100) . "坪)";
      } else {
          $data = $searchManager->setConvertText($rentSaleStr, $dataKey, $data);
      }
  } else {
      switch($dataKey) {
      case $searchManager::BK_DATA_SYOGAKU_KYORI:
      case $searchManager::BK_DATA_CYUGAKU_KYORI:
      case $searchManager::BK_DATA_SETBACK_RYO:
      case $searchManager::BK_DATA_BILDUNDER:
          $data = "";
          break;
      }
  }
?>
<?php if($searchManager::BK_DATA_AROUNDS !== $dataKey || "-" === $data) { ?>
{{ $data }}
<?php } else { ?>
<?php foreach($data as $around) { ?>
<?php
  if(!empty($around['type']['key']) && in_array($around['type']['key'], [19, 20])) {
      continue;
  }
?>
<div class="aroundData">
  {{ empty($around['type']['value']) ? "-" : $around['type']['value'] }}まで
  {{ empty($around['kyori']) ? "-" : $around['kyori'] }}m
</div><?php } ?>
<?php } ?>

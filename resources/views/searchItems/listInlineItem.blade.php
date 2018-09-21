<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php foreach($dispItem as $key) { ?>
<?php if(empty($resultData[$key])) { continue; } ?>
<dl class="{{ $key }}">
  <dt class="title list-inline-item">{{ $searchManager->getBkItemName($rentSaleStr, $key) }}</dt><?php if($searchManager::BK_DATA_MONEY === $key) { ?>
  <?php $money = $resultData[$key]; ?>
  <dd class="value list-inline-item">@include ('searchItems.moneySplit', [$searchManager, $rentSaleStr, $money])</dd><?php } else { ?>
  <dd class="value list-inline-item">
    <?php
      $text = $searchManager->getAndCheckBkData($resultData, $key, null);
      if($searchManager::BK_DATA_AREASIZE === $key) {
          $area_keisoku = "";
          if(!empty($resultData[$searchManager::BK_DATA_AREASIZE_KEI]['value'])) {
              $area_keisoku = "（{$resultData[$searchManager::BK_DATA_AREASIZE_KEI]['value']}）";
          }
          $text = number_format($text, 2) . "㎡{$area_keisoku}(" . (floor($text * 0.3025 * 100) / 100) . "坪)";
      } else {
          $text = $searchManager->setConvertText($rentSaleStr, $key, $text);
      }
    ?>
    {{ $text }}
  </dd><?php } ?>
</dl><?php } ?>

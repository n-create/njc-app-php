
<?php
/**
* Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
*/
?>
<?php $data = $searchManager->getBkDetailTemplateData($rentSaleStr, $searchManager::BK_TEMPLATE_SIMPLE, $detailData[$searchManager::BK_DATA_BILDTYPE]['key']); ?>
<div class="col-md-6">
  <table class="table bkDetailDataHead">
    <tbody><?php foreach($data as $template) { ?>
      <tr>
        <th>{{ $template['name'] }}</th>
        <td>
          <?php $cnt = 0; ?>
          <?php foreach($template['text'] as $key => $value) { ?>
          <?php $cnt++; ?>
          <?php if(!is_numeric($key)) { ?>
          <div class="{{ $key }}">{{ $value }}</div><?php } else { ?>
          <?php $rKey = $value; ?>
          <?php if($rKey == $searchManager::BK_DATA_MONEY) { ?>
          <div class="{{ $rKey }}">
            <?php $money = $detailData[$rKey]; ?>
            @include ('searchItems.moneySplit', [$searchManager, $rentSaleStr, $money])
          </div><?php } else { ?>
          <div class="{{ $rKey }}">
            <?php
              $text = $searchManager->getAndCheckBkData($detailData, $rKey, null);
              if("-" !== $text) {
                  if($searchManager::BK_DATA_AREASIZE === $rKey) {
                      $area_keisoku = "";
                      if(!empty($detailData[$searchManager::BK_DATA_AREASIZE_KEI]['value'])) {
                          $area_keisoku = "（{$detailData[$searchManager::BK_DATA_AREASIZE_KEI]['value']}）";
                      }
                      $text = number_format($text, 2) . "㎡{$area_keisoku}(" . (floor($text * 0.3025 * 100) / 100) . "坪)";
                  } else {
                      $text = $searchManager->setConvertText($rentSaleStr, $rKey, $text);
                  }
              }
            ?>
            {{ $text }}
          </div><?php } ?>
          <?php if($cnt < count($template['text'])) { ?><span class="glue">/</span><?php } ?>
          <?php } ?>
          <?php } ?>
        </td>
      </tr><?php } ?>
    </tbody>
  </table>
</div><?php
  $imgData = null;
  if(!empty($detailData[$searchManager::BK_DATA_IMAGES])) {
      $imgData = $searchManager->getMainImagePath($detailData[$searchManager::BK_DATA_IMAGES], $rentSaleStr);
  }
?>
<?php if(!empty($imgData)) { ?>
<div class="col-md-6">
  <div class="bk-detail-sub-image-wrapper p-2">
    <div class="bk-detail-sub-image-inner"><img src="{{ $imgData['path'] }}" alt="{{ $imgData['comment'] }}"/></div>
  </div>
</div><?php } ?>
<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
    $data = $searchManager->getBkDetailTemplateData($rentSaleStr, $searchManager::BK_TEMPLATE_DETAIL, $detailData[$searchManager::BK_DATA_BILDTYPE]['key']);
    $limit = 2;
?>
<div data-subtitle="DETAIL" class="h2">物件詳細情報</div>
<div class="bk-detail-table-wrap">
  <table class="table table-bordered tableDetail"><?php foreach ($data as $key => $rows) { ?>
    <tbody class="main-detail-box <?= $key; ?>"><?php foreach ($rows as $rowValues) { ?>
      <tr class="detail-row">
        <?php foreach ($rowValues as $rowValue) { ?>
        <?php $colspan = intval($rowValue['cols']) * 2 - 1; ?>
        <th class="detail-col table-light">
          <div>{{ $rowValue['name'] }}</div>
        </th>
        <td colspan="{{ $colspan }}" class="detail-col">
          <?php foreach ($rowValue['text'] as $rowKey => $rowText) { ?>
          <?php if(!is_numeric($rowKey)) { ?>
          <div class="{{ $rowKey }} no-data"><?= $rowText; ?></div><?php } else { ?>
          <div class="{{ $rowText }}">
            <?php $dataKey = $rowText; ?>
            <?php
              $itemPath = "detailItems.detailMainItem";
              switch($dataKey) {
              case $searchManager::BK_DATA_TRAFFIC:
                  $itemPath = "detailItems.detailMainTraffic";
                  break;
              }
            ?>
            @include ($itemPath, [$searchManager, $detailData, $dataKey, $limit])
          </div><?php } ?>
          <?php } ?>
        </td><?php } ?>
      </tr><?php } ?>
      <?php if('initial' == $key) { ?>
      <tr>
        <td colspan="6" class="bg-trans">
          <div class="inner">
            <div class="whole">
              <div class="viewNarrow text-center switch"><span toggle-class="etcetera" class="btn btn-info detailhide toggle"></span></div>
            </div>
          </div>
        </td>
      </tr><?php } ?>
    </tbody><?php } ?>
  </table>
</div>
<script type="text/javascript" src="/js/njc/simpleAccordion.js?_={{ date('Ymdhis') }}"></script>

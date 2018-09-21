<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php
  $cnt = 0;
  $limit = 2;
  $imgPath = PATH_NOPHOTO_IMG;
  if(isset($resultData[$searchManager::BK_DATA_IMAGES][0]['path']['large'])) {
      $imgPath = $resultData[$searchManager::BK_DATA_IMAGES][0]['path']['large'];
  }
  $json = [
      'img'         => $imgPath,
      'resultData'  => $resultData,
  ];
?>
<div class="crui_name badge badge-dark mb-1">{{ (empty($resultData[$searchManager::BK_DATA_BILDTYPE]['value']) ? '-' : $resultData[$searchManager::BK_DATA_BILDTYPE]['value']) }}</div>
<div class="bk-title card-title"><a href="{{ $link }}" title="{{ $title }}" target="_blank">{{ empty($resultData[$searchManager::BK_DATA_NAME]) ? $title : $resultData[$searchManager::BK_DATA_NAME] }}</a></div>
<div class="disp-main-item">
  <?php
    $buildType = $resultData[$searchManager::BK_DATA_BILDTYPE]['key'];
    $dispItem = $searchManager->getBkResultTemplateData($searchManager::BK_DISPITEM_KEY_MAIN, $rentSaleStr, $buildType, true);
  ?>
  @include ('searchItems.listInlineItem', [$searchManager, $rentSaleStr, $resultData, $dispItem])
</div>
<div class="ad-kotu list-inline-item">@include ('searchItems.listKotuAd', [$searchManager, $rentSaleStr, $resultData, $dispItem])</div>
<div class="disp-sub-item mt-2">
  <table class="table">
    <tbody>
      <?php if(isset($resultData[$searchManager::BK_DATA_ROOMS])) { ?>
      <?php foreach($resultData[$searchManager::BK_DATA_ROOMS] as $data) { ?>
      <?php $cnt++; ?>
      <?php if($limit < $cnt) { ?>
      <tr>
        <td class="sub_allView text-center">
          <button data-bundle-childen="{{ json_encode($json) }}" class="btn btn-dark bundle-display-btn">全て表示する</button>
        </td>
      </tr><?php break; ?>
      <?php } ?>
      <?php $link = "/{$rentSaleStr}/detail/{$data[$searchManager::BK_DATA_ID]}"; ?>
      <tr>
        <td class="sub_content"><a href="{{ $link }}" title="{{ $title }}" target="_blank">
            <div class="link_content">
              <?php
                $dispItem = $searchManager->getBkResultTemplateData($searchManager::BK_DISPITEM_KEY_MATOME, $rentSaleStr, $buildType, true);
              ?>
              @include ('searchItems.listInlineItem', [
                'searchManager' => $searchManager,
                'rentSaleStr' => $rentSaleStr,
                'resultData' => $data,
                'dispItem' => $dispItem
              ])
            </div></a></td>
      </tr><?php $comment = $searchManager->getPrComment($data, false); ?>
      <?php if(!empty($comment)) { ?>
      <tr>
        <td class="sub_comment">
          <div class="pr_comment"><?= implode("<br>", $comment); ?></div>
        </td>
      </tr><?php } ?>
      <?php } ?>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<div class="crui_name badge badge-dark mb-1">{{ (empty($resultData[$searchManager::BK_DATA_BILDTYPE]['value']) ? '-' : $resultData[$searchManager::BK_DATA_BILDTYPE]['value']) }}</div>
<div class="bk-title card-title"><a href="{{ $link }}" title="{{ $title }}" target="_blank">{{ empty($resultData[$searchManager::BK_DATA_NAME]) ? $title : $resultData[$searchManager::BK_DATA_NAME] }}</a></div>
<div class="disp-main-item">
  <?php
    $buildType = $resultData[$searchManager::BK_DATA_BILDTYPE]['key'];
    $dispItem = $searchManager->getBkResultTemplateData($searchManager::BK_DISPITEM_KEY_MAIN, $rentSaleStr, $buildType, false);
  ?>
  @include ('searchItems.listInlineItem', [$searchManager, $rentSaleStr, $resultData, $dispItem])
</div>
<div class="disp-sub-item">
  <?php
    $dispItem = $searchManager->getBkResultTemplateData($searchManager::BK_DISPITEM_KEY_SUB, $rentSaleStr, $buildType, false);
  ?>
  @include ('searchItems.listInlineItem', [$searchManager, $rentSaleStr, $resultData, $dispItem])
</div>
<div class="ad-kotu list-inline-item">@include ('searchItems.listKotuAd', [$searchManager, $rentSaleStr, $resultData, $dispItem])</div><?php $comment = $searchManager->getPrComment($resultData, false); ?>
<?php if(!empty($comment)) { ?>
<div class="disp-comment pr_comment"><?= implode("<br>", $comment); ?></div><?php } ?>

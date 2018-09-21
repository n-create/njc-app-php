<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php
  $searchManager = new App\Services\Helper\SearchItemHelper();
  $postData = app('request')->all();
  $resultData = $postData['resultData'];
  $rentSaleStr = RS_STR_RENT;
  $link = "/{$rentSaleStr}/detail/{$resultData[$searchManager::BK_DATA_ID]}";
  $title = $searchManager->createLinkTitle($rentSaleStr, $resultData);
?>
<div>
  <div class="row">
    <div class="bundle-parent col-md-3 mb-sm-3"><img src="{{ $postData['img'] }}" class="img"/></div>
    <div class="disp-contents col-md-9">
      <div class="crui_name badge badge-dark mb-1">{{ (empty($resultData[$searchManager::BK_DATA_BILDTYPE]['value']) ? '-' : $resultData[$searchManager::BK_DATA_BILDTYPE]['value']) }}</div>
      <div class="bk-title"><a href="{{ $link }}" title="{{ $title }}" target="_blank">{{ empty($resultData['name']) ? $title : $resultData['name'] }}</a></div>
      <div class="disp-main-item">
        <?php
          $buildType = $resultData[$searchManager::BK_DATA_BILDTYPE]['key'];
          $dispItem = $searchManager->getBkResultTemplateData($searchManager::BK_DISPITEM_KEY_MAIN, $rentSaleStr, $buildType, true);
        ?>
        @include ('searchItems.listInlineItem', [$searchManager, $rentSaleStr, $resultData, $dispItem])
      </div>
      <div class="ad-kotu list-inline-item"><?php if(!empty($resultData[$searchManager::BK_DATA_ADDRESS])) { ?><span class="{{ $searchManager::BK_DATA_ADDRESS }}"><a href="{{ $link }}" title="{{ $title }}" target="_blank">
            <p class="ad_value">{{ $resultData[$searchManager::BK_DATA_ADDRESS] }}</p></a></span><?php } ?>
        <?php $trafficData = $searchManager->getAndConvertTrafficData($resultData[$searchManager::BK_DATA_TRAFFIC]); ?>
        <?php if(!empty($trafficData[0])) { ?><span class="{{ $trafficData[0]['class'] }}"><a href="{{ $link }}" title="{{ $title }}" target="_blank">
            <p class="kotu_value">{{ $trafficData[0]['text'] }}</p></a></span><?php } ?>
      </div>
    </div>
  </div>
  <div class="disp-sub-item mt-2">
    <table class="table mb-0">
      <tbody>
        <?php if(isset($resultData[$searchManager::BK_DATA_ROOMS])) { ?>
        <?php foreach($resultData[$searchManager::BK_DATA_ROOMS] as $data) { ?>
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
          <td class="sub_link">
            <div class="link"><a href="{{ $link }}" title="{{ $title }}" target="_blank" class="btn btn-sm">詳細</a></div>
          </td>
        </tr><?php $comment = $searchManager->getPrComment($data, false); ?>
        <?php if(!empty($comment)) { ?>
        <tr>
          <td colspan="2" class="sub_comment">
            <div class="pr_comment"><?= implode("<br>", $comment); ?></div>
          </td>
        </tr><?php } ?>
        <?php } ?>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

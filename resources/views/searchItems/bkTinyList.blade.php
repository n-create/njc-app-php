<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php $resultKey = (RS_STR_RENT === $rentSaleStr) ? $searchManager::RS_STR_NO_BUNDLE : $rentSaleStr; ?>
<?php $result = $searchManager->getBkResultDataDirect($resultKey, $query); ?>
<div class="row">
  <div class="headtitle col-md-12">
    <div data-subtitle="{{ $subTitle }}" class="h2 heading">{{ $mainTitle }}</div>
  </div>
  <div class="targetNumber col-md-12 text-md-right text-center">
    <div class="normal d-inline-block"><?php $meta = $searchManager->getResultMetaData($rentSaleStr); ?><span>該当物件数</span><span class="count">{{ (empty($meta['total']) ? 0 : $meta['total']) }}</span><span>件</span></div>
  </div>
</div>
<div class="row"><?php foreach($result as $resultData) { ?>
  <div class="bk-data bk-data-list col-md-6 col-lg-4 mb-4">
    <?php
      $link = "/{$rentSaleStr}/detail/{$resultData[$searchManager::BK_DATA_ID]}";
      $title = $searchManager->createLinkTitle($rentSaleStr, $resultData);
    ?><a href="{{ $link }}" target="_blank" title="{{ $title }}">
      <div class="continner card">
        <div class="img card-img-top">
          <div>
            <?php
              $imgPath = PATH_NOPHOTO_IMG;
              $imgAlt = 'NO IMAGE';
              if(isset($resultData[$searchManager::BK_DATA_IMAGES][0]['path']['large'])) {
                  $imgPath = $resultData[$searchManager::BK_DATA_IMAGES][0]['path']['large'];
                  $imgAlt =  $resultData[$searchManager::BK_DATA_IMAGES][0]['comment'];
              }
            ?><img src="{{ $imgPath }}" alt="{{ $imgAlt }}" class="img-fluid"/>
          </div>
        </div>
        <div class="card-body">
          <div class="crui_name badge badge-dark mb-1">
            <div class="value">{{ (empty($resultData[$searchManager::BK_DATA_BILDTYPE]['value']) ? '-' : $resultData[$searchManager::BK_DATA_BILDTYPE]['value']) }}</div>
          </div>
          <dl class="bk_name card-title">
            <dd class="value">{{ empty($resultData['name']) ? $title : $resultData['name'] }}</dd>
          </dl>
          <div class="bk-data-main mb-1">
            <?php
              $buildType = $resultData[$searchManager::BK_DATA_BILDTYPE]['key'];
              $dispItem = $searchManager->getBkResultTemplateData(
                  $searchManager::BK_DISPITEM_KEY_TINYMAIN, $rentSaleStr, $buildType, false
              );
            ?>
            @include ('searchItems.listInlineItem', [$searchManager, $rentSaleStr, $resultData, $dispItem])
          </div>
          <div class="bk-data-sub mb-1">
            <?php
              $dispItem = $searchManager->getBkResultTemplateData(
                  $searchManager::BK_DISPITEM_KEY_TINYSUB, $rentSaleStr, $buildType, false
              );
            ?>
            @include ('searchItems.listInlineItem', [$searchManager, $rentSaleStr, $resultData, $dispItem])
          </div>
          <div class="ad-kotu list-inline-item"><?php if(!empty($resultData[$searchManager::BK_DATA_ADDRESS])) { ?><span class="{{ $searchManager::BK_DATA_ADDRESS }}">
              <p class="ad_value">{{ $resultData[$searchManager::BK_DATA_ADDRESS] }}</p></span><?php } ?>
            <?php $trafficData = $searchManager->getAndConvertTrafficData($resultData[$searchManager::BK_DATA_TRAFFIC]); ?>
            <?php if(!empty($trafficData[0])) { ?><span class="{{ $trafficData[0]['class'] }}">
              <p class="kotu_value">{{ $trafficData[0]['text'] }}</p></span><?php } ?>
          </div><?php $comment = $searchManager->getPrComment($resultData, true); ?>
          <?php if(!empty($comment)) { ?>
          <div class="disp-comment pr_comment">{{ implode("<br>", $comment) }}</div><?php } ?>
          <div class="inner190 d-none">
            <div class="whole190">
              <button class="btn btn-default detail190"></button>
              <div class="shadow190"></div>
            </div>
          </div>
        </div>
      </div></a>
  </div><?php } ?>
</div>
<div class="row">
  <div class="more-button clearfix col-md-12 text-center"><?php $param = $searchManager->getAndUnsetParameter($query, 'limit'); ?><a href="/{{ $rentSaleStr }}/result?{{ implode('&', $param) }}" class="btn">一覧はこちら</a></div>
</div>

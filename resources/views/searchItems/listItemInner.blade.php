
<?php
/**
* Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
*/
?>
<?php $link = "/{$rentSaleStr}/detail/{$resultData[$searchManager::BK_DATA_ID]}"; ?>
<?php $title = $searchManager->createLinkTitle($rentSaleStr, $resultData); ?>
<?php $isMatome = (RS_STR_RENT === $rentSaleStr) ? true : false; ?>
<div class="col-md-6 col-lg-4 mb-4">
  <div class="list-item-inner card">
    <div class="bk-detail-status-icons">
      <ul class="bk-icons"><?php if($searchManager->isNewArrive($resultData)) { ?>
        <li class="bk-icon status-new badge badge-warning"><span class="status-new-conts">新着</span></li><?php } ?>
        <?php if($searchManager->isNewUpdate($resultData)) { ?>
        <li class="bk-icon status-update badge badge-primary"><span class="status-update-conts">更新</span></li><?php } ?>
        <?php if($searchManager->isNewBuild($resultData)) { ?>
        <li class="bk-icon status-building badge badge-success"><span class="status-building-conts">新築</span></li><?php } ?>
      </ul>
    </div><a href="{{ $link }}" title="{{ $title }}" target="_blank" class="img card-img-top">
      <div class="listGazo text-center">
        <div class="GazoImg">
          <?php
            $imgPath = PATH_NOPHOTO_IMG;
            if(isset($resultData[$searchManager::BK_DATA_IMAGES][0]['path']['large'])) {
                $imgPath = $resultData[$searchManager::BK_DATA_IMAGES][0]['path']['large'];
            }
          ?><img src="{{ $imgPath }}" alt="{{ $title }}"/>
        </div>
      </div></a>
    <div class="bk-body card-body">
      <div class="disp-contents">
        <?php if($isMatome) { ?>
        @include ('searchItems.listItemInnerMatome', [$searchManager, $rentSaleStr, $resultData, $link, $title])
        <?php } else { ?>
        @include ('searchItems.listItemInnerNormal', [$searchManager, $rentSaleStr, $resultData, $link, $title])
        <?php } ?>
      </div>
    </div>
  </div>
</div>
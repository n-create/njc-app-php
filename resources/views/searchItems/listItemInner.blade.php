<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php $link = "/{$rentSaleStr}/detail/{$resultData[$searchManager::BK_DATA_ID]}"; ?>
<?php $title = $searchManager->createLinkTitle($rentSaleStr, $resultData); ?>
<?php $isMatome = (RS_STR_RENT === $rentSaleStr) ? true : false; ?>
<div class="col-md-6 col-lg-4 mb-4">
  <div class="list-item-inner card"><a href="{{ $link }}" title="{{ $title }}" target="_blank" class="img card-img-top">
      <div class="listGazo text-center">
        <div class="GazoImg">
          <?php
            $imgPath = PATH_NOPHOTO_IMG;
            if(isset($resultData[$searchManager::BK_DATA_IMAGES][0]['path']['large'])) {
                $imgPath = $resultData[$searchManager::BK_DATA_IMAGES][0]['path']['large'];
            }
          ?><img src="{{ $imgPath }}"/>
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

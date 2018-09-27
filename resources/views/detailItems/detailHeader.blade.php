
<?php
/**
* Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
*/
?>
<?php
  $nowUrl = app('request')->url();
  $moneyText = (RS_STR_RENT === $rentSaleStr) ? '賃料' : '価格';
?>
<div class="bk-detail-top-data mb-3">
  <div class="bk-detail-top-title-area mb-1">
    <div class="bk-detail-crui-name badge badge-dark mr-1 mb-1">{{ $searchManager->getAndCheckBkData($detailData, $searchManager::BK_DATA_BILDTYPE, null) }}</div>
    <h2 class="bk-detail-title h4 mb-0">
      <?php
        $bkName = $searchManager->getAndCheckBkData($detailData, $searchManager::BK_DATA_NAME, null);
        if("-" === $bkName) {
            $bkName = $searchManager->createLinkTitle($rentSaleStr, $detailData);
        }
      ?>
      {{ $bkName }}
    </h2>
  </div>
  <div class="row">
    <div class="bk-detail-top-other-area col-md-7 col-xl-6 mb-sm-0 mb-2">
      <div class="bk-detail-address">{{ $searchManager->getAndCheckBkData($detailData, $searchManager::BK_DATA_ADDRESS, null) }}</div><?php if(!empty($detailData[$searchManager::BK_DATA_TRAFFIC])) { ?>
      <div class="bk-detail-transports-area">
        <?php
          $trafficData = $searchManager->getMergeEnsenBus($detailData[$searchManager::BK_DATA_TRAFFIC]);
          $limit = 2;
          $count = 0;
        ?>
        <?php foreach($trafficData['ensen_bus'] as $trafData) { ?>
        <?php
          $count++;
          if($count > $limit) {
              break;
          }
        ?>
        <div class="bk-detail-transports-conts ensen_bus">{{ $trafData }}</div><?php } ?>
        <?php if(!empty($trafficData[$searchManager::BK_DATA_ETC][0])) { ?>
        <div class="bk-detail-transports-conts etc">{{ $trafficData[$searchManager::BK_DATA_ETC][0] }}</div><?php } ?>
      </div><?php } ?>
    </div>
    <div class="detail-btn-set-area col-md-5 col-xl-6">
      <div class="detail-btn-set-area-various mt-1 mb-1">
        <div class="inner180 mr-1">
          <div>
            <?php
              $bkAddr = $searchManager->getAndCheckBkData($detailData, $searchManager::BK_DATA_ADDRESS, null);
              $moneyData = $searchManager->getAndCheckBkData($detailData, $searchManager::BK_DATA_MONEY, null);
              $bkMoney = "";
              foreach($searchManager->getMoneyConvert($moneyData) as $money) {
                  $bkMoney .= $money['value'];
              }
              $bkMoneyName = (RS_STR_RENT === $rentSaleStr) ? '賃料' : '価格' ;
              $mailText = "物件名：{$bkName}\r\n" .
                          "住所：{$bkAddr}\r\n" .
                          "{$bkMoneyName}：{$bkMoney}\r\n";
              $mailText = rawurlencode($mailText);
            ?>
            <button type="button" onclick="location.href='mailto:?subject=おすすめの物件&amp;body={{ $mailText }}{{ $nowUrl }}'" class="btn btn-info btn-sm sendarticle_m180 sendInfoMail">物件情報をメールで送る</button>
          </div>
        </div>
        <div>
          <?php
            $msg = rawurlencode("〇〇不動産のホームページで見つけた物件を送ります。\r\n").$mailText;
            $lineUrl = "https://social-plugins.line.me/lineit/share?url={$nowUrl}&text={$msg}{$nowUrl}";
          ?>
          <button type="button" onclick="window.open('{{ $lineUrl }}');" class="lineimage btn btn-sm btn-sns d-inline-block mr-1">
            <svg viewbox="-1,0,17,17" width="17" height="17" class="mr-1">
              <path d="{{ SNS_SVG_PATH['lineimage'] }}"></path>
            </svg>LINEで送る
          </button>
        </div>
        <div class="inner96 d-md-inline-block d-none">
          <div class="whole96"><a target="_blank" href="#" onclick="window.print(); return false;" class="btn btn-info btn-sm print96">印刷する</a></div>
        </div>
      </div>
      <div class="detail-btn-set-area-sns mt-1 mb-1"><?php $facebookUrl = "http://www.facebook.com/share.php?u={$nowUrl}"; ?>
        <button type="button" onclick="window.open('{{ $facebookUrl }}','fbwindow','width=550, height=450, personalbar=0, toolbar=0, scrollbars=1');" class="fbimage btn btn-sm btn-sns d-inline-block mr-1 fb-like">
          <svg viewbox="-2,-2,20,20" width="20" height="20">
            <path d="{{ SNS_SVG_PATH['fbimage']  }}"></path>
          </svg>
        </button><?php $twitterUrl = "http://twitter.com/share?url={$nowUrl}&text={$mailText}"; ?>
        <button type="button" onclick="window.open('{{ $twitterUrl }}');" class="twimage btn btn-sm btn-sns d-inline-block mr-1">
          <svg viewbox="-2,-2,20,20" width="20" height="20">
            <path d="{{ SNS_SVG_PATH['twimage']  }}"></path>
          </svg>
        </button><?php $googleUrl = "https://plus.google.com/share?url={$nowUrl}&text={$mailText}{$nowUrl}"; ?>
        <button type="button" onclick="window.open('{{ $googleUrl }}');" class="glimage btn btn-sm btn-sns d-inline-block mr-1 g-plus">
          <svg viewbox="-2,-2,20,20" width="20" height="20">
            <path d="{{ SNS_SVG_PATH['glimage']  }}"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>
</div>
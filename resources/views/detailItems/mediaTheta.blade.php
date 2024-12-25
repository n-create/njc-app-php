
<?php
/**
* Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
*/
?>
<?php
  $media = !empty($detailData[$searchManager::BK_DATA_MEDIA]) ? $detailData[$searchManager::BK_DATA_MEDIA] : [];
  $thetaLinks = !empty($media[$searchManager::BK_DATA_THETA]) ? $media[$searchManager::BK_DATA_THETA] : [];
?>
<?php if (!empty($thetaLinks)) { ?>
<?php
  $topTheta = $thetaLinks[0];
  list($panoramaURL,$url360Class)=$searchManager->getRicohInfo($topTheta['link']);
  if (strpos($topTheta['link'], 'biz/s') !== false || strpos($topTheta['link'], 'biz/t') !== false || strpos($topTheta['link'], 'theta360.com') !== false) { 
      $panoramaType = 0;
  } else if (strpos($topTheta['link'], 'matterport') !== false) {
      $panoramaType = 1;
  } else {
      $panoramaType = 2; 
  }
?>
<div class="mediaKomoku theta-parts mb-3 col">
  <div data-subtitle="PANORAMA" class="h4">パノラマ画像</div>
  <div class="mediaLinkBoxs"><a class="theta-disp-wrap theta-open-wrap sp-view"><span class="control-img-sp"><span class="control-img-sp-conts"></span></span><span class="control-txt-sp">
        <p class="control-txt-sp-conts text-left mb-0 px-1">この物件の様子を360°パノラマ画像で見る</p></span><span class="control-btn-sp"><span class="control-btn tmOpenIcon btn btn-dark btn-sm">開く</span></span></a>
    <div class="thetaLinkBox pc-view">
      <div class="thetaPlayerWrap"><?php if($panoramaType == 0) { ?>
        <blockquote data-width="840" data-height="450" class="<?= $url360Class; ?>"><a href="<?= $topTheta['link'] ?>" target="_blank"></a></blockquote>
        <script async="async" src="<?= $panoramaURL ?>" charset="utf-8"></script><?php } else if ($panoramaType == 1) { ?>
        <iframe width="100%" height="450" src="<?= $topTheta['link'] ?>" frameborder="0" allowfullscreen="allowfullscreen" allow="xr-spatial-tracking" scrolling="no"> </iframe><?php } else { ?>
        <iframe width="100%" height="450" src="<?= $topTheta['link'] ?>" frameborder="0" allowfullscreen="allowfullscreen" scrolling="no"> </iframe><?php } ?>
      </div>
      <div class="theta-select">
        <?php foreach($thetaLinks as $key => $theta) {?>
        <?php if($key == 0) {?>
        <div data-url="{{ $theta['link'] }}" class="btn-theta btn btn-dark active">{{ $theta['title'] }}</div><?php } else { ?>
        <div data-url="{{ $theta['link'] }}" class="btn-theta btn btn-dark">{{ $theta['title'] }}</div><?php } ?>
        <?php } ?>
      </div>
    </div>
  </div>
</div><?php
  $script_files = [
      '/js/njc/mediaTheta.js',
  ];
?>
<?php foreach($script_files as $filePath) { ?>
<script type="text/javascript" src="{{ $filePath }}?_={{ date('Ymdhis') }}"></script><?php } ?>
<?php } ?>
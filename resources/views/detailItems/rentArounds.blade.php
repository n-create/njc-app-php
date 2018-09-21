<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php $arounds = $searchManager->getAroundsData($detailData, true); ?>
<?php if (!empty($arounds)) { ?>
<?php $count = count($arounds); ?>
<div class="surroundings">
  <div class="h4 heading bg-dark text-light mb-0">周辺施設（{{ $count }}枚）</div>
  <div class="btn btn-light btn-sm change-all-view-btn open-surroundings img-count-{{ $count }}">全て見る</div>
  <div class="surroundings-list-wrap bg-light loading">
    <div id="surroundings_custom" class="surroundings-list"><?php foreach ($arounds as $key => $data) { ?>
      <div data-number="{{ $key }}" class="surroundings-contents">
        <div class="surrounding-image">
          <div class="image-wrap"><img src="{{ $data['image_path']['large'] }}"/></div>
        </div>
        <div class="surrounding-message">
          <div class="surrounding-name">{{ $data['name'] }}</div><?php if (!empty($data['kyori'])) { ?>
          <div class="surrounding-range">{{ $data['kyori'] }}m</div><?php } ?>
        </div>
      </div><?php } ?>
    </div>
  </div>
  <div style="display:none;" class="surroundings-pop-wrap"><?php foreach ($arounds as $key => $data) { ?><a href="#surroundings-contents-custom-{{ $key }}"></a><?php } ?>
    <?php foreach ($arounds as $key => $data) { ?>
    <div id="surroundings-contents-custom-{{ $key }}" class="surroundings-contents-pop">
      <div class="surrounding-image-pop">
        <div class="image-wrap"><img src="{{ $data['image_path']['large'] }}"/></div>
      </div>
      <div class="surrounding-message">
        <div class="surrounding-name">{{ $data['name'] }}</div><?php if (!empty($data['kyori'])) { ?>
        <div class="surrounding-range">{{ $data['kyori'] }}m</div><?php } ?>
      </div>
    </div><?php } ?>
  </div>
</div><?php
  $script_files = [
      '/js/components/slick/slick.js',
      '/js/components/colorbox/jquery.colorbox-min.js',
      '/js/njc/surroundings.js',
  ];
?>
<?php foreach($script_files as $filePath) { ?>
<script type="text/javascript" src="{{ $filePath }}?_={{ date('Ymdhis') }}"></script><?php } ?>
<?php
  $css_files = [
      '/js/components/slick/slick.css',
      '/js/components/slick/slick-theme.css',
      '/css/components/colorbox/example3/colorbox.css',
      '/css/njc/colorbox-custom.css'
  ];
?>
<?php foreach($css_files as $filePath) { ?>
<link rel="stylesheet" type="text/css" href="{{ $filePath }}?_={{ date('Ymdhis') }}"/><?php } ?>
<script>
  $(function(){
     function surroundingTimeout () {
         if ('NJC' in window && window.NJC.surroundingSlick && $ && 'colorbox' in $ && 'slick' in $()) {
             window.NJC.surroundingSlick.ResStart("#surroundings_custom");
         } else {
             setTimeout(surroundingTimeout, 1000);
         }
     }
     surroundingTimeout();
  });
</script><?php } ?>
<?php $aroundsText = $searchManager->getAroundsData($detailData, false); ?>
<?php if (!empty($aroundsText)) { ?>
<div>
  <div class="surroundings-summary-wrap">
    <ul class="mb-0"><?php foreach ($aroundsText as $key => $data) { ?>
      <li><span class="surrounding-name">{{ $data['type']['value'] }} {{ $data['name'] }}まで</span><span class="surrounding-range">{{ $data['kyori'] }}m</span></li><?php } ?>
    </ul>
  </div>
</div><?php } ?>

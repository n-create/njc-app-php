<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php if (0 < count($detailData[$searchManager::BK_DATA_IMAGES])) { ?>
<div class="galleriffic-slide clearfix p-3">
  <div class="row">
    <div id="gallery" class="content col-md-7 mb-md-0 mb-2">
      <div class="slideshow-container">
        <div id="controls"></div>
        <div id="loading"></div>
        <div id="caption"></div>
      </div>
    </div>
    <div id="thumbs" style="display: none;" class="navigation col-md-5 d-none d-sm-block">
      <ul class="thumbs clearfix row"><?php foreach($detailData[$searchManager::BK_DATA_IMAGES] as $num => $imgData) { ?>
        <li class="col-xl-3 col-4 mt-1 mb-1"><a href="{{ $imgData['path']['large'] }}" title="{{ $imgData['comment'] }}" class="thumb main-image-link"><img src="{{ $imgData['path']['large'] }}" alt="{{ $imgData['comment'] }}"/></a>
          <div class="caption">
            <div class="slideshow"><span class="image-wrapper">
                <div class="image-contents">
                  <div rel="cbviewer" href="{{ $imgData['path']['large'] }}" title="{{ $imgData['comment'] }}" class="advance-link"><img src="{{ $imgData['path']['large'] }}" alt="{{ $imgData['comment'] }}"/></div>
                  <div class="image-contents-bottom p-2 clearfix">
                    <div class="image-description float-left">{{ $imgData['comment'] }}</div>
                    <div class="image-num float-right">{{ ($num + 1) }} / {{ count($detailData[$searchManager::BK_DATA_IMAGES]) }}</div>
                  </div>
                </div></span></div>
          </div>
        </li><?php } ?>
      </ul>
      <p class="thumbs-des mb-0">画像をクリックすると拡大されます。</p>
    </div>
  </div>
</div><?php
  $script_files = [
      '/js/components/galleriffic/jquery.galleriffic.js',
      '/js/components/galleriffic/jquery.history.js',
      '/js/components/galleriffic/jquery.opacityrollover.js',
      '/js/njc/customGalleriffic.js',
  ];
?>
<?php foreach($script_files as $filePath) { ?>
<script type="text/javascript" src="{{ $filePath }}?_={{ date('Ymdhis') }}"></script><?php } ?>
<?php } ?>

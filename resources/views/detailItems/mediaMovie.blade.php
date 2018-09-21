<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php
  $media = !empty($detailData[$searchManager::BK_DATA_MEDIA]) ? $detailData[$searchManager::BK_DATA_MEDIA] : [];
  $youtube = !empty($media[$searchManager::BK_DATA_YOUTUBE]) ? $media[$searchManager::BK_DATA_YOUTUBE] : [];
?>
<?php if(!empty($youtube)) { ?>
<div class="mediaKomoku movie-parts mb-3 col">
  <div data-subtitle="MOVIE" class="h4">動画</div>
  <div class="mediaLinkBoxs">
    <?php foreach($youtube as $num => $mediaData) { ?>
    <?php
      $url = $mediaData['link'];
      if(false === strpos($url, 'www.youtube.com')) {
          continue;
      }
      if(false !== strpos($url, 'http://')) {
          $url = str_replace('http://', 'https://', $url);
      }
    ?><a data-ng-target-id="movie{{ ($num + 1) }}" class="movie-disp-wrap movie-no-1 sp-view"><span class="control-img-sp"><span class="control-img-sp-conts"></span></span><span class="control-txt-sp">
        <p class="control-txt-sp-conts text-left mb-0 px-1">この物件の様子を動画で見る</p></span><span class="control-btn-sp"><span class="control-btn tmOpenIcon btn btn-dark btn-sm">開く</span></span></a>
    <div id="movie{{ ($num + 1) }}" class="mediaLinkBox pc-view">
      <div class="youtubePlayerWrap">
        <iframe src="{{ $url }}" frameborder="0" title="" allow="encrypted-media" class="youtubePlayer"></iframe>
      </div>
      <div class="mediaLinkComment p-2 text-left">{{ $mediaData['comment'] }}</div>
    </div><?php } ?>
  </div>
</div><?php
  $script_files = [
      '/js/njc/mediaMovie.js',
  ];
?>
<?php foreach($script_files as $filePath) { ?>
<script type="text/javascript" src="{{ $filePath }}?_={{ date('Ymdhis') }}"></script><?php } ?>
<?php } ?>

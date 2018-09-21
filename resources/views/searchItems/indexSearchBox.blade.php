<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php foreach($dispSearch as $key) { ?>
<?php
  $master = $searchManager->getBkSearchMaster($rentSaleStr, $key);
  $name = $searchManager->getBkItemName($rentSaleStr, $key);
?>
<div class="searchBoxInner {{ $key }}">
  <div class="row">
    <div class="h5 col-lg-2 col-md-3 col-12">{{ $name }}</div>
    <div class="col-lg-10 col-md-9 col-12">@include ('searchItems.searchBoxInner', [$searchManager, $master, $name, $key])</div>
  </div>
</div><?php } ?>
<?php
   $script_files = [
       "/js/njc/connectNewBildAndDate.js",
   ];
?>
<?php foreach($script_files as $filePath) { ?>
<script type="text/javascript" src="{{ $filePath }}?_={{ date('Ymdhis') }}"></script><?php } ?>

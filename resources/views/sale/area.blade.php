<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php
  $searchManager = new App\Services\Helper\SearchItemHelper();
  $dispSearch = [
      $searchManager::BK_DATA_AREA,
  ];
?>
@extends('layouts.default')
@section('contents')
<div class="container searchBox {{ RS_STR_SALE }}">
  <form id="bkSearchCheck" method="get" action="/{{ RS_STR_SALE }}/result" class="saleSearch area">
    <div class="searchIndex">
      <div class="headTitle">
        <div data-subtitle="SEARCH" class="h2">地域から検索</div>
      </div>
      <div class="headBox">
        <div class="search-decription"></div>
      </div>
      <div class="searchBox">
        <?php foreach($dispSearch as $key) { ?>
        <?php
          $master = $searchManager->getBkSearchMaster(RS_STR_SALE, $key);
          $name = "町域";
        ?>
        <div class="searchBoxInner {{ $key }}">
          <div id="head_{{ $key }}" class="h3">{{ $name }}を選択してください</div>@include ('searchItems.searchBoxInner', [$searchManager, $master, $key])
        </div><?php } ?>
      </div>
    </div>
    <div class="searchBtnBox">
      <div class="inner180">
        <div class="whole180">
          <button type="submit" data-alert="{{ $name }}を選択してください" class="btn btn-default bkSearch_submit">この条件で検索</button>
        </div>
      </div>
    </div>
  </form>
</div>@endsection

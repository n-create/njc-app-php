<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php
  $searchManager = new App\Services\Helper\SearchItemHelper();
  $dispSearch = [
      $searchManager::BK_DATA_SI_SYOGAKU,
      $searchManager::BK_DATA_SYOGAKU_KYORI,
      $searchManager::BK_DATA_SI_CYUGAKU,
      $searchManager::BK_DATA_CYUGAKU_KYORI,
  ];
?>
@extends('layouts.default')
@section('contents')
<div class="container searchBox {{ RS_STR_RENT }}">
  <form id="bkSearchCheck" method="get" action="/{{ RS_STR_RENT }}/result" class="rentSearch school">
    <div class="searchIndex">
      <div class="headTitle">
        <div data-subtitle="SEARCH" class="h2">学校区から検索</div>
      </div>
      <div class="headBox">
        <div class="search-decription"></div>
      </div>
      <div class="searchBox">
        <?php foreach($dispSearch as $key) { ?>
        <?php
          $master = $searchManager->getBkSearchMaster(RS_STR_RENT, $key);
          $name = $searchManager->getBkItemName(RS_STR_RENT, $key);
          $linkKey = ($searchManager::BK_DATA_SI_SYOGAKU == $key) ? $searchManager::BK_DATA_SI_CYUGAKU : $searchManager::BK_DATA_SI_SYOGAKU;
        ?>
        <div class="searchBoxInner {{ $key }}"><?php if($key == $searchManager::BK_DATA_SI_SYOGAKU || $key == $searchManager::BK_DATA_SI_CYUGAKU) { ?>
          <div id="head_{{ $key }}" class="h3 head_bar"><?= $name; ?><a href="#head_{{ $linkKey }}" class="manual-right">{{ $searchManager->getBkItemName(RS_STR_RENT, $linkKey) }}へ</a></div><?php } else { ?>
          <div class="h5 head_{{ $key }}"><?= $name; ?></div><?php } ?>
          @include ('searchItems.searchBoxInner', [$searchManager, $master, $key])
        </div><?php } ?>
      </div>
    </div>
    <div class="searchBtnBox">
      <div class="inner180">
        <div class="whole180">
          <button type="submit" data-alert="学校区を選択してください" class="btn btn-default bkSearch_submit">この条件で検索</button>
        </div>
      </div>
    </div>
  </form>
</div>@endsection

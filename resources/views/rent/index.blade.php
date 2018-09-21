<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
@extends('layouts.default')
@section('contents')
<div class="container searchBox {{ RS_STR_RENT }}">
  <form id="bkSearch" method="get" action="/{{ RS_STR_RENT }}/result" class="rentSearch jyoken">
    <div class="searchIndex">
      <div class="headTitle">
        <div data-subtitle="SEARCH" class="h2">賃貸物件検索</div>
      </div>
      <div class="headBox">
        <div class="search-decription">条件を指定して検索ボタンを押してください。選択せずに検索するとすべての物件が表示されます。</div>
      </div>
      <div class="searchBox">
        <?php
          $searchManager = new App\Services\Helper\SearchItemHelper();
          $dispSearch = [
              $searchManager::BK_DATA_BILDTYPE,
              $searchManager::BK_DATA_MONEY,
              $searchManager::BK_DATA_MONEY_ETC,
              $searchManager::BK_DATA_MADORI,
              $searchManager::BK_DATA_AREASIZE,
              $searchManager::BK_DATA_POSITION,
              $searchManager::BK_DATA_NEWBILD,
              $searchManager::BK_DATA_BILDDATE,
              $searchManager::BK_DATA_NEWCOME,
              $searchManager::BK_DATA_EKITOHO,
              $searchManager::BK_DATA_IMAGES,
              $searchManager::BK_DATA_KODAWARI,
              $searchManager::BK_DATA_FREEWORD,
          ];
          $rentSaleStr = RS_STR_RENT;
        ?>
        @include ('searchItems.indexSearchBox', [$searchManager, $dispSearch, $rentSaleStr])
      </div>
    </div>
    <div class="searchBtnBox">
      <div class="inner180">
        <div class="whole180">
          <button type="submit" class="btn btn-default bkSearch_submit">この条件で検索</button>
        </div>
      </div>
    </div>
  </form>
</div>@endsection

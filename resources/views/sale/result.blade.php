<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php
  $searchManager = new App\Services\Helper\SearchItemHelper();
  $result = $searchManager->getBkResultData(RS_STR_SALE);
  $rentSaleStr = RS_STR_SALE;
?>
@extends('layouts.default')
@section('contents')
<div class="container resultBox {{ $rentSaleStr }}">
  <div class="headTitle">
    <div data-subtitle="LIST" class="h2">売買物件一覧</div>
  </div>
  <div class="bk-result-header mb-3">
    <div class="header-title">
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="title navbar-brand">別の検索方法で再検索</div>
        <button type="button" data-toggle="collapse" data-target="#othersearch" aria-controls="othersearch" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"><span class="navbar-toggler-icon othersearch-toggler-icon"></span></button>
        <div id="othersearch" class="collapse navbar-collapse">
          <ul class="value nav navbar-nav">
            <?php foreach(SEARCH_METHOD as $key => $title) { ?>
            <?php $url = "/{$rentSaleStr}/{$key}"; ?>
            <li class="nav-item"><a href="{{ $url }}" class="{{ $key }} {{ ('#' == $url) ? 'no_link': '' }} nav-link">{{ $title }}</a></li><?php } ?>
          </ul>
        </div>
      </nav>
    </div>
  </div>
  <div class="bk-result-page-wrapper">
    <div class="bk-list-header mb-3">
      <div class="list-header-child bg-light">@include ('searchItems.resultHeader', [$searchManager, $rentSaleStr])</div>
    </div>
    <div class="bk-list-body">
      <div class="list-item row">
        <?php foreach($result as $resultData) { ?>
        @include ('searchItems.listItemInner', [$searchManager, $rentSaleStr, $resultData])
        <?php } ?>
      </div>
    </div>
    <div class="bk-list-paging">
      <div class="list-page row nav-fill">@include ('searchItems.listPagingList', [$searchManager, $rentSaleStr])</div>
    </div>
  </div>
</div>@endsection

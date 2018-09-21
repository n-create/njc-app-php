<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php
  $searchManager = new App\Services\Helper\SearchItemHelper();
  $noPage = ['location'];
?>
@extends('layouts.default')
@section('contents')
<div class="container">
  <div id="main-contents1" class="mb-3">
    <div class="row">
      <div class="col-md-12">
        <div>
          <div class="picture"></div><img src="/images/main_img.png" alt="レスポンシブ：スマートレイアウト・賃貸メイン画像（PC)" class="img-fluid pc"/>
        </div>
      </div>
    </div>
  </div>
  <div id="main-contents11" class="mb-3">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-secondary p-2">
          <div class="site-info-wrapper">
            <div class="site-info text-center"><?php $countData = $searchManager->getAllBkCount(); ?>
              <div class="number-property d-inline-block">総物件数</div><span class="number-property-val">{{ $countData['count'] }}</span><span>件</span>
              <div class="last-modified d-inline-block"></div><span class="last-modified-val">{{ $countData['updated'] }}</span><span>更新</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="bk-tiny-list rent bk-list-dp101 mb-5">
    <?php
      $query = [
          //'recommend' => 1,
          //'limit'     => 6,
            'building_numbers' => '289,290,291,292,293,294,295,296,297,298',
            'room_numbers' => '7ba1413d,102',
            'limit'     => 10,
      ];
      $rentSaleStr = RS_STR_RENT;
      $mainTitle = "おすすめ賃貸物件";
      $subTitle = strtoupper($rentSaleStr) . " RECOMMEND";
    ?>
    @include ('searchItems.bkTinyList', [$searchManager, $rentSaleStr, $query, $mainTitle, $subTitle])
  </div>
  <div class="bk-tiny-list sale bk-list-dp101 mb-5">
    <?php
      $query = [
          //'recommend' => 1,
          //'limit'     => 6,
          'building_numbers' => '188,189,190,191,192,193,194,195,196,197',
          'limit'     => 10,
      ];
      $rentSaleStr = RS_STR_SALE;
      $mainTitle = "おすすめ売買物件";
      $subTitle = strtoupper($rentSaleStr) . " RECOMMEND";
    ?>
    @include ('searchItems.bkTinyList', [$searchManager, $rentSaleStr, $query, $mainTitle, $subTitle])
  </div>
  <div id="main-contents4" class="mb-5">@include ('searchItems.quickSearch', [$searchManager])</div>
</div>
<div id="copyright-contents-wrap" class="py-2 bg-dark">
  <div class="container">
    <div class="copy-right text-center mb-1"><a href="/" title="(SEO用の会社名)" class="text-light">©○○不動産</a></div>
  </div>
</div>@endsection

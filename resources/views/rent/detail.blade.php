<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php
  $searchManager = new App\Services\Helper\SearchItemHelper();
  $rentSaleStr = RS_STR_RENT;
  $detailData = $searchManager->getBkDetailData($rentSaleStr, $id);
?>
@extends('layouts.default')
@section('contents')
<div class="container detailBox {{ $rentSaleStr }}">
  <div class="bk-detail-header">@include ('detailItems.detailHeader', [$searchManager, $rentSaleStr, $detailData])</div>
  <div class="bk-detail-body">
    <div class="bk-detail-images mb-md-5 mb-4">@include ('detailItems.imageSlider', [$searchManager, $rentSaleStr, $detailData])</div>
    <div class="bk-detail-arounds mb-md-5 mb-4">@include ('detailItems.rentArounds', [$searchManager, $rentSaleStr, $detailData])</div>
    <div class="bk-detail-comments mb-md-5 mb-4">@include ('detailItems.salesCommnets', [$searchManager, $rentSaleStr, $detailData])</div>
    <div class="bk-detail-simple row mb-md-5 mb-4">@include ('detailItems.detailSimple', [$searchManager, $rentSaleStr, $detailData])</div>
    <div class="bk-detail-media-movie row mb-md-5 mb-4">@include ('detailItems.mediaMovie', [$searchManager, $rentSaleStr, $detailData])</div>
    <div class="bk-detail-media-theta row mb-md-5 mb-4">@include ('detailItems.mediaTheta', [$searchManager, $rentSaleStr, $detailData])</div>
    <div class="bk-detail-contact-info mb-md-5 mb-4">@include ('detailItems.contactInfo', [$searchManager, $rentSaleStr, $detailData])</div>
    <div class="bk-detail-main mb-md-5 mb-4">
       
      @include ('detailItems.detailMain', [$searchManager, $rentSaleStr, $detailData])
    </div>
    <div class="bk-detail-map mb-md-5 mb-4">@include ('detailItems.detailMap', [$searchManager, $rentSaleStr, $detailData])</div>
    <div class="bk-detail-company mb-md-5 mb-4">@include ('detailItems.contactCompany', [$searchManager, $rentSaleStr, $detailData])</div>
  </div>
</div>@endsection

<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php $searchManager = new App\Services\Helper\SearchItemHelper(); ?>
@extends('layouts.default')
@section('contents')
<div class="searchBox {{ RS_STR_SALE }}">
  <div class="searchIndex">
    <div class="searchBox">
      <?php
        $dispSearch = [
            $searchManager::BK_DATA_BILDTYPE,
            $searchManager::BK_DATA_MONEY,
            $searchManager::BK_DATA_MADORI,
            $searchManager::BK_DATA_LANDSIZE,
            $searchManager::BK_DATA_AREASIZE,
            $searchManager::BK_DATA_BILDSIZE,
            $searchManager::BK_DATA_POSITION,
            $searchManager::BK_DATA_NEWBILD,
            $searchManager::BK_DATA_BILDDATE,
            $searchManager::BK_DATA_NEWCOME,
            $searchManager::BK_DATA_EKITOHO,
            $searchManager::BK_DATA_IMAGES,
            $searchManager::BK_DATA_SETUBI,
            $searchManager::BK_DATA_FREEWORD,
            $searchManager::BK_DATA_SYUEKI,
            $searchManager::BK_DATA_SYUEKI_PER,
        ];
        $rentSaleStr = RS_STR_SALE;
      ?>
      @include ('searchItems.mapSearch', [$searchManager, $dispSearch, $rentSaleStr])
    </div>
  </div>
</div>@endsection

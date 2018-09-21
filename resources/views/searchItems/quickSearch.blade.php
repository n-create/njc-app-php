<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php
  $dispMaster = [
      RS_STR_RENT => [
          $searchManager::BK_DATA_BILDTYPE,
          $searchManager::BK_DATA_MONEY,
          $searchManager::BK_DATA_MONEY_ETC,
          $searchManager::BK_DATA_NEWBILD,
          $searchManager::BK_DATA_FREEWORD,
      ],
      RS_STR_SALE => [
          $searchManager::BK_DATA_BILDTYPE,
          $searchManager::BK_DATA_MONEY,
          $searchManager::BK_DATA_NEWBILD,
          $searchManager::BK_DATA_FREEWORD,
      ],
  ];
  $defaultView = RS_STR_RENT;
?>
<div class="quicksearch">
  <div class="row">
    <div class="col-md-12">
      <h2 title="クイック検索" data-subtitle="QUICK SEARCH" class="heading quickSearchHeading h2 mb-3">クイック検索</h2>
    </div>
  </div>
  <ul class="nav nav-tabs nav-fill mb-4">
    <li class="nav-item"><a id="rent-tab" data-toggle="tab" href="#rent" role="tab" aria-controls="rent" aria-selected="true" class="nav-link active show">賃貸</a></li>
    <li class="nav-item"><a id="sale-tab" data-toggle="tab" href="#sale" role="tab" aria-controls="sale" aria-selected="true" class="nav-link">売買</a></li>
  </ul>
  <div class="tab-content">
    <?php foreach(BK_TYPE as $rentSaleStr => $rentSale) { ?>
    <?php $isActive = ($rentSaleStr == $defaultView); ?>
    <div role="tabpanel" aria-labelledby="home-tab" id="{{ $rentSaleStr }}" class="tab-pane {{ (($isActive) ? 'show active' : '') }}">
      <div class="row">
        <div class="col-md-12">
          <form action="/{{ $rentSaleStr }}/result" class="quickSearchCondition">
            <div class="quickSearch{{ ucfirst($rentSaleStr) }}">
              <?php $dispSearch = $dispMaster[$rentSaleStr]; ?>
              @include ('searchItems.indexSearchBox', [$searchManager, $dispSearch, $rentSaleStr])
            </div>
            <div class="text-center">
              <button class="btn">この条件で検索</button>
            </div>
          </form>
        </div>
      </div>
    </div><?php } ?>
  </div>
</div>

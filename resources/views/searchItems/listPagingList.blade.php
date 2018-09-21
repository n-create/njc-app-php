<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php $metaData = $searchManager->getResultMetaData($rentSaleStr); ?>
<?php
  $page_first = 1;
  $page_last = $metaData['last_page'];
  $page_current = $metaData['current_page'];
  $page_start = $page_current - 2;
  $page_end = $page_current + 2;
  if(1 > $page_start) {
      $diff = (1 - $page_start);
      $page_start = 1;
      $page_end += $diff;
  }
  if($page_last < $page_end) {
      $diff = ($page_last - $page_end);
      $page_end = $page_last;
      $page_start = (1 > $page_start + $diff) ? $page_start : $page_start + $diff;
  }
  $url = $searchManager->getAndUnsetUrl("page");
?>
<?php if(1 < $page_last) { ?>
<ul class="paging-list nav-item">
  <li class="paging_back list-inline-item">
    @include ('searchItems.listPagingListItem', [
      'isNoLink' => ($page_current == $page_start),
      'class' => 'paging_back',
      'url' => "{$url}&page=".($page_current - 1),
      'text' => '前へ'
    ])
  </li><?php if($page_first < $page_start) { ?>
  <li class="paging_first list-inline-item"><a href="{{ $url }}&page=1" class="paging_first btn btn-white">{{ $page_first }}</a></li><?php } ?>
  <?php if($page_first + 1 < $page_start) { ?>
  <li class="paging_dot list-inline-item">...</li><?php } ?>
  <?php for($i = $page_start; $i <= $page_end; $i++) { ?>
  <li class="paging_number list-inline-item">
    @include ('searchItems.listPagingListItem', [
      'isNoLink' => ($page_current == $i),
      'class' => 'paging_number',
      'url' => "{$url}&page=".($i),
      'text' => $i
    ])
  </li><?php } ?>
  <?php if($page_last - 1 > $page_end) { ?>
  <li class="paging_dot list-inline-item">...</li><?php } ?>
  <?php if($page_last > $page_end) { ?>
  <li class="paging_last list-inline-item"><a href="{{ $url }}&page={{ $page_last }}" class="paging_last btn btn-white">{{ $page_last }}</a></li><?php } ?>
  <li class="paging_next list-inline-item">
    @include ('searchItems.listPagingListItem', [
      'isNoLink' => ($page_current == $page_end),
      'class' => 'paging_next',
      'url' => "{$url}&page=".($page_current + 1),
      'text' => '次へ'
    ])
  </li>
</ul><?php } ?>

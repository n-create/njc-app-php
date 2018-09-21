<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php
  $query = app('request')->all();
  $nowSort = (!isset($query['sorts'])) ? 'money_at' : $query['sorts'];
  $nowLimit = (!isset($query['limit'])) ? 30 : $query['limit'];
?>
<div class="row">
  <div class="bk-count col-md-4">
    <p class="count-text m-0">
      <?php $meta = $searchManager->getResultMetaData($rentSaleStr); ?>
      該当物件数<span class="count">{{ (empty($meta['total']) ? 0 : $meta['total']) }}</span>件
    </p>
  </div>
  <div class="bk-list-sort col-md-8 text-md-right text-center">
    <select name="sorts" onchange="location.href='{{ $searchManager->getAndUnsetUrl("sorts") }}&sorts='+this.options[this.selectedIndex].value" class="sort-order form-control">
      <?php foreach($searchManager->getSortOrderList($rentSaleStr) as $value => $text) { ?>
      <?php if($value == $nowSort) { ?>
      <option value="{{ $value }}" selected="selected">{{ $text }}</option><?php } else { ?>
      <option value="{{ $value }}">{{ $text }}</option><?php } ?>
      <?php } ?>
    </select>
    <select name="limit" onchange="location.href='{{ $searchManager->getAndUnsetUrl("limit") }}&limit='+this.options[this.selectedIndex].value" class="limit-select form-control">
      <?php foreach([9, 15, 30, 60, 90] as $value) { ?>
      <?php if($value == $nowLimit) { ?>
      <option value="{{ $value }}" selected="selected">表示件数 {{ $value }}件</option><?php } else { ?>
      <option value="{{ $value }}">表示件数 {{ $value }}件</option><?php } ?>
      <?php } ?>
    </select>
  </div>
</div>

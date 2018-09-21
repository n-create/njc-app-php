<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php
  $searchList = null;
  if(isset($master['search'][$rentSaleStr])) {
      $searchList = $master['search'][$rentSaleStr];
  }
?>
<?php if(!empty($searchList)) { ?>
<?php foreach($searchList as $searchData) { ?>
<dl class="parent clearfix {{ $key }}">
  <dt>{{ $searchData['category'] }}</dt>
  <dd>
    <ul class="main {{ $key }}">
      <?php foreach($searchData['list'] as $value => $data) { ?>
      <?php $inputName = $data['name']; ?>
      <li class="sub {{ $key }}">
        <label class="form-control">
          <?php if('setubi_options' == $data['name'] || 'jyoken_options' == $data['name']) { ?>
          <?php
            if(empty($value)) continue;
            $temp = explode("_", $value);
            $inputName = "{$data['name']}[{$temp[0]}][]";
          ?>
          <?php } ?>
          <input type="checkbox" name="{{ $inputName }}" value="{{ $value }}" class="child {{ $key }}"/><span>{{ $data['text'] }}</span>
        </label>
      </li><?php } ?>
    </ul>
  </dd>
</dl><?php } ?>
<?php } ?>

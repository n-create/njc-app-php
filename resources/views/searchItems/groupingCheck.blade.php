<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php
  $groupingData = $searchManager->convertGroupingData($master['search']);
?>
<?php foreach($groupingData as $parentKey => $parentData) { ?>
<dl class="parent clearfix {{ $rKey }}">
  <dt>{{ $parentData['name'] }}</dt>
  <dd>
    <ul class="main {{ $rKey }}"><?php foreach($parentData['child'] as $childKey => $text) { ?>
      <li class="sub {{ $rKey }}">
        <label class="form-control">
          <input type="checkbox" name="{{ $rKey }}[{{ $parentKey }}][]" value="{{ $parentKey }}_{{ $childKey }}" class="child {{ $rKey }}"/><span>{{ $text }}</span>
        </label>
      </li><?php } ?>
    </ul>
  </dd>
</dl><?php } ?>

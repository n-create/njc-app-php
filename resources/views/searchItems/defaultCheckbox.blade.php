<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<ul class="main {{ $rKey }}">
  <?php if(is_array($master['search'])) { ?>
  <?php foreach($master['search'] as $dataValue => $text) { ?>
  <?php
  ?>
  <li class="sub {{ $rKey }}">
    <label class="form-control">
      <input type="checkbox" name="{{ $rKey }}[]" value="{{ $dataValue }}" class="child checksubmit {{ $rKey }}"/><span>{{ $text }}</span>
    </label>
  </li><?php } ?>
  <?php } else { ?>
  <li class="sub sub_{{ $rKey }}">
    <label class="form-control">
      <input type="checkbox" name="{{ $rKey }}" value="{{ $master['search'] }}" class="child checksubmit {{ $rKey }}"/><span>{{ $name }}</span>
    </label>
  </li><?php } ?>
</ul>

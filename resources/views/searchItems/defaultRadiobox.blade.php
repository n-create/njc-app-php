<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<ul class="main_{{ $rKey }}">
  <?php if(is_array($master['search'])) { ?>
  <?php foreach($master['search'] as $dataValue => $text) { ?>
  <li class="sub_{{ $rKey }}">
    <label class="form-control"><?php if ("" === $dataValue) { ?>
      <input type="radio" name="{{ $rKey }}" value="{{ $dataValue }}" checked="checked" class="checksubmit child_{{ $rKey }}"/><?php } else { ?>
      <input type="radio" name="{{ $rKey }}" value="{{ $dataValue }}" class="checksubmit child_{{ $rKey }}"/><?php } ?><span>{{ $text }}</span>
    </label>
  </li><?php } ?>
  <?php } else { ?>
  <li class="sub_{{ $rKey }}">
    <label class="form-control">
      <input type="radio" name="{{ $rKey }}" value="{{ $master['search'] }}" class="checksubmit child_{{ $rKey }}"/><span>{{ $name }}</span>
    </label>
  </li><?php } ?>
</ul>

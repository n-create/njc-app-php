<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<ul class="main {{ $key }}"><?php foreach($master['key'] as $name => $text) { ?>
  <li class="sub {{ $key }}">
    <label class="form-control">
      <input type="checkbox" name="{{ $name }}" value="1" class="child checksubmit {{ $key }} {{ $name }}"/><span>{{ $text }}</span>
    </label>
  </li><?php } ?>
</ul>

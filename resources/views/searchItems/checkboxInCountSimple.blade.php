<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php
  $text = $data[$keyData['keyText']];
  $value = $data[$keyData['keyValue']];
  if(isset($data['count'])) {
      $text .= "(" . $data['count'] . "件)";
  }
?>
<li class="sub_{{ $rKey }}">
  <label class="form-control">
    <input type="checkbox" name="{{ $rKey }}[]" value="{{ $value }}" class="checksubmit child_{{ $rKey }}"/><span>{{ $text }}</span>
  </label>
</li>

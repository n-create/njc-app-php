<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php
  $parentText = $data[$keyData['keyText']];
  $group = $data[$keyData['keyGroup']];
?>
<div class="head">
  <h4>
    <label><span>{{ $parentText }}</span></label>
  </h4>
</div>
<ul class="main_{{ $rKey }}">
  <?php foreach($group as $groupData) { ?>
  <?php
    $text = $groupData[$keyData['keyGroupText']];
    $value = $groupData[$keyData['keyGroupValue']];
    if(isset($groupData['count'])) {
        $text .= "(" . $groupData['count'] . "件)";
    }
  ?>
  <li class="sub_{{ $rKey }}">
    <label class="form-control">
      <input type="checkbox" name="{{ $rKey }}[]" value="{{ $value }}" class="checksubmit child_{{ $rKey }}"/><span>{{ $text }}</span>
    </label>
  </li><?php } ?>
</ul>

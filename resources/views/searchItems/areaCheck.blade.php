<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php
  $keyData = $searchManager::$convertKey[$key];
  $master['search'] = $searchManager->checkAndSetBlankAreaName($master['search']);
  $master['search'] = $searchManager->convertAreaData($master['search']);
?>
<div class="schoolParent parent_{{ $rKey }}"><?php foreach($master['search'] as $dataKey => $data) { ?>
  <div class="head">
    <h4>
      <label><span>{{ $data[$keyData['keyText']] }}</span></label>
    </h4>
  </div><?php foreach($data[$keyData['keyGroup']] as $choHead => $choData) { ?>
  <div class="h5">
    <?php
      if('その他' != $choHead) {
          $choHead .= "行";
      }
    ?>
    {{ $choHead }}
  </div>
  <ul class="clearfix main_{{ $rKey }}">
    <?php foreach($choData as $list) { ?>
    <?php
      $text = $list[$keyData['keyGroupText']];
      $value = $list[$keyData['keyGroupValue']];
      if(isset($list['count'])) {
          $text .= "(" . $list['count'] . "件)";
      }
    ?>
    <li class="sub_{{ $rKey }} col-sm-4">
      <label class="form-control">
        <input type="checkbox" name="{{ $rKey }}[]" value="{{ $value }}" class="checksubmit child_{{ $rKey }}"/><span>{{ $text }}</span>
      </label>
    </li><?php } ?>
  </ul><?php } ?>
  <?php } ?>
</div>

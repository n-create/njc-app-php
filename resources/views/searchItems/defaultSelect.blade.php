
<?php
/**
* Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
*/
?>
<?php
  $defaultText = "";
  if("min" == substr($rKey, -3)) {
      $defaultText = '下限なし';
  } else if("max" == substr($rKey, -3)) {
      $defaultText = '上限なし';
  }
?>
<select name="{{ $rKey }}" class="{{ $rKey }} form-control"><?php if(!empty($defaultText)) { ?>
  <option value="">{{ $defaultText }}</option><?php } ?>
  <?php foreach($master['search'] as $dataValue => $text) { ?>
  <option value="{{ $dataValue }}">{{ $text }}</option><?php } ?>
</select><?php
  $afterText = "";
  if("min" == substr($rKey, -3)) {
      $afterText = "〜";
  } else if($searchManager::BK_DATA_EKITOHO === $key) {
      $afterText = "m以内";
  }
?>
<?php if(!empty($afterText)) { ?><span class="afterSelectText {{ $rKey }}">{{ $afterText }}</span><?php } ?>
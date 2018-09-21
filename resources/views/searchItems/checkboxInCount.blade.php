<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php
  $keyData = $searchManager::$convertKey[$key];
?>
<?php if(!empty($keyData['keyGroup'])) { ?>
<?php foreach($master['search'] as $dataKey => $data) { ?>
@include ('searchItems.checkboxInCountGroup', [$searchManager, $master, $rKey, $keyData, $data])
<?php } ?>
<?php } else { ?>
<ul class="main_{{ $rKey }}">
  <?php foreach($master['search'] as $dataKey => $data) { ?>
  @include ('searchItems.checkboxInCountSimple', [$searchManager, $master, $rKey, $keyData, $data])
  <?php } ?>
</ul><?php } ?>

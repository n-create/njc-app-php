<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<div class="inner">
  <?php if(!empty($master['search'])) { ?>
  <?php if($searchManager::DATA_TYPE_CUSTOM === $master['type']) { ?>
  @include ("searchItems.customCheckbox", [$searchManager, $master, $key])
  <?php } else if($searchManager::DATA_TYPE_CUSTOM_GROUP === $master['type']) { ?>
  @include ("searchItems.customGroupCheck", [$searchManager, $master, $key])
  <?php } else { ?>
  <?php foreach($master['key'] as $rKey) { ?>
  <?php
    switch($master['type']) {
    case $searchManager::DATA_TYPE_LIST:
        $searchItems = 'searchItems.defaultSelect';
        break;
    case $searchManager::DATA_TYPE_GROUP:
        $searchItems = 'searchItems.groupingCheck';
        break;
    case $searchManager::DATA_TYPE_TEXT:
        $searchItems = "searchItems.defaultText";
        break;
    case $searchManager::DATA_TYPE_RADIO:
        $searchItems = "searchItems.defaultRadiobox";
        break;
    case $searchManager::DATA_TYPE_CHECK:
    default:
        $searchItems = "searchItems.defaultCheckbox";
        break;
    }
    switch($key) {
    case $searchManager::BK_DATA_SI_SYOGAKU:
    case $searchManager::BK_DATA_SI_CYUGAKU:
    case $searchManager::BK_DATA_RAILWAY:
    case $searchManager::BK_DATA_STATION:
    case $searchManager::BK_DATA_CITY:
        $searchItems = "searchItems.checkboxInCount";
        break;
    case $searchManager::BK_DATA_AREA:
        $searchItems = "searchItems.areaCheck";
    }
  ?>
  @include ($searchItems, [$searchManager, $master, $rKey, $key])
  <?php } ?>
  <?php } ?>
  <?php } ?>
</div>

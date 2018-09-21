<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php if(!empty($resultData[$searchManager::BK_DATA_ADDRESS])) { ?><span class="{{ $searchManager::BK_DATA_ADDRESS }}"><a href="{{ $link }}" title="{{ $title }}" target="_blank">
    <p class="ad_value">{{ $resultData[$searchManager::BK_DATA_ADDRESS] }}</p></a></span><?php } ?>
<?php $trafficData = $searchManager->getAndConvertTrafficData($resultData[$searchManager::BK_DATA_TRAFFIC]); ?>
<?php if(!empty($trafficData[0])) { ?><span class="{{ $trafficData[0]['class'] }}"><a href="{{ $link }}" title="{{ $title }}" target="_blank">
    <p class="kotu_value">{{ $trafficData[0]['text'] }}</p></a></span><?php } ?>

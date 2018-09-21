
<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
  $trafficData = $searchManager->getMergeEnsenBus($detailData[$searchManager::BK_DATA_TRAFFIC]);
?>
<?php foreach($trafficData['ensen_bus'] as $trafData) { ?>
<p class="kotu_value">{{ $trafData }}</p><?php } ?>

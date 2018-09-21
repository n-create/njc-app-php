<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php $money = intval($money); ?>
<?php if(!empty($money)) { ?>
<?php foreach($searchManager->getMoneyConvert($money) as $moneyData) { ?><span class="{{ $moneyData['class'] }}">{{ $moneyData['value'] }}</span><?php } ?>
<?php } else { ?><span class="empty">-</span><?php } ?>

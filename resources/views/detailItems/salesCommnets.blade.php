<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php if(!empty($detailData[$searchManager::BK_DATA_SELLING_PT1]) || !empty($detailData[$searchManager::BK_DATA_SELLING_PT2])) { ?>
<div class="prcnt">
  <div class="prcnt_title"></div>
  <div class="prcnt_box"><?php if(!empty($detailData['selling_point_1'])) { ?>
    <div class="selling_point_1">{{ $detailData['selling_point_1'] }}</div><?php } ?>
    <?php if(!empty($detailData['selling_point_2'])) { ?>
    <div class="selling_point_2">{{ $detailData['selling_point_2'] }}</div><?php } ?>
  </div>
</div><?php } ?>

<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php
  $placeholder = [
      $searchManager::BK_DATA_FREEWORD => "地名、交通、条件で検索",
  ];
?>
<input type="text" name="{{ $rKey }}" placeholder="{{ $placeholder[$key] }}" maxlength="150" class="text_{{ $rKey }} form-control"/>

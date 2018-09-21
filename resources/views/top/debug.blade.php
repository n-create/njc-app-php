<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php
  $searchManager = new App\Services\Helper\SearchItemHelper();
  $json = new App\Services\Helper\JsonHelper();
?>
<?php
  $data = $searchManager::$tempDispItem;
  $json->jsonResponse($data);
?>

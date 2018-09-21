<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */

define('ROOT', dirname(__DIR__ . ".."));
define('JSON_EXT', '.json');

define('DEMO_MODE_KEY', '71F206B58C68352FC9757D60F5E196365493197514DD479D40124424BB2FA8DD');
define('DEMO_MODE', (!empty($_COOKIE['key_demo_mode']) && DEMO_MODE_KEY === $_COOKIE['key_demo_mode']) ? true : false);
define('DEBUG_MODE_KEY', '8174E37B32F5C66FDFF7BE1C724F72B6E5F2B49A7FA522C4C6DBC97938673C09');
define('DEBUG_MODE', (!empty($_COOKIE['key_debug_mode']) && DEBUG_MODE_KEY === $_COOKIE['key_debug_mode']) ? true : false);
define('SEARCH_METHOD', [
    'index' => '条件から検索',
    'railway' => '沿線・駅から検索',
    'city' => '地域から検索',
    'school' => '学校区から検索',
    'map' => '地図から検索',
]);
define('RS_STR_RENT', 'rent');
define('RS_STR_SALE', 'sale');
define('RS_CODE_RENT', 1);
define('RS_CODE_SALE', 2);
define('BK_TYPE', [
    RS_STR_RENT => RS_CODE_RENT,
    RS_STR_SALE => RS_CODE_SALE,
]);

define('GOOGLE_MAPS_API', 'https://maps.googleapis.com/maps/api/js');

define('PATH_SAMPLE_IMG', '/images/sample.gif');
define('PATH_NOPHOTO_IMG', '/images/nophoto.png');

define('SNS_SVG_PATH', [
    'lineimage' => 'M16,6.9c0-3.6-3.6-6.5-8-6.5S0,3.3,0,6.9c0,3.2,2.8,5.9,6.7,6.4c0.3,0.1,0.6,0.2,0.7,0.4 c0.1,0.2,0.1,0.5,0,0.7l-0.1,0.7c0,0.2-0.2,0.8,0.7,0.4c0.9-0.4,4.6-2.7,6.3-4.7l0,0C15.4,9.6,16,8.3,16,6.9z M5.2,8.8 c0,0.1-0.1,0.2-0.2,0.2H2.8c0,0-0.1,0-0.1,0l0,0l0,0c0,0,0-0.1,0-0.1l0,0V5.3c0-0.1,0.1-0.2,0.2-0.2h0h0.6c0.1,0,0.2,0.1,0.2,0.2 l0,0v2.8H5c0.1,0,0.2,0.1,0.2,0.2L5.2,8.8z M6.5,8.8c0,0.1-0.1,0.2-0.2,0.2H5.8c-0.1,0-0.2-0.1-0.2-0.2V5.3c0-0.1,0.1-0.2,0.2-0.2 l0,0h0.6c0.1,0,0.2,0.1,0.2,0.2V8.8z M10.4,8.8c0,0.1-0.1,0.2-0.2,0.2H9.7h0l0,0h0h0l0,0l0,0h0l0,0c0,0,0,0,0,0L8,6.7v2 c0,0.1-0.1,0.2-0.2,0.2H7.2c-0.1,0-0.2-0.1-0.2-0.2V5.3c0-0.1,0.1-0.2,0.1-0.2c0,0,0,0,0,0h0.6h0l0,0h0l0,0l0,0l0,0l0,0l0,0h0l0,0 l0,0l0,0l0,0l1.6,2.2V5.3c0-0.1,0.1-0.2,0.2-0.2h0.6c0.1,0,0.2,0.1,0.2,0.2L10.4,8.8z M13.5,5.8c0,0.1-0.1,0.2-0.2,0.2h-1.5v0.6 h1.5c0.1,0,0.2,0.1,0.2,0.2v0.6c0,0.1-0.1,0.2-0.2,0.2h-1.5v0.6h1.5c0.1,0,0.2,0.1,0.2,0.2v0.6c0,0.1-0.1,0.2-0.2,0.2h-2.2 c0,0-0.1,0-0.1,0l0,0l0,0c0,0,0-0.1,0-0.1l0,0V5.3l0,0c0,0,0-0.1,0-0.1l0,0c0,0,0.1,0,0.1,0h2.2c0.1,0,0.2,0.1,0.2,0.2V5.8z',
    'fbimage' => 'M15.117 0H.883C.395 0 0 .395 0 .883v14.234c0 .488.395.883.883.883h7.663V9.804H6.46V7.39h2.086V5.607c0-2.066 1.262-3.19 3.106-3.19.883 0 1.642.064 1.863.094v2.16h-1.28c-1 0-1.195.476-1.195 1.176v1.54h2.39l-.31 2.416h-2.08V16h4.077c.488 0 .883-.395.883-.883V.883C16 .395 15.605 0 15.117 0',
    'twimage' => 'M16 3.038c-.59.26-1.22.437-1.885.517.677-.407 1.198-1.05 1.443-1.816-.634.375-1.337.648-2.085.795-.598-.638-1.45-1.036-2.396-1.036-1.812 0-3.282 1.468-3.282 3.28 0 .258.03.51.085.75C5.152 5.39 2.733 4.084 1.114 2.1.83 2.583.67 3.147.67 3.75c0 1.14.58 2.143 1.46 2.732-.538-.017-1.045-.165-1.487-.41v.04c0 1.59 1.13 2.918 2.633 3.22-.276.074-.566.114-.865.114-.21 0-.416-.02-.617-.058.418 1.304 1.63 2.253 3.067 2.28-1.124.88-2.54 1.404-4.077 1.404-.265 0-.526-.015-.783-.045 1.453.93 3.178 1.474 5.032 1.474 6.038 0 9.34-5 9.34-9.338 0-.143-.004-.284-.01-.425.64-.463 1.198-1.04 1.638-1.7z',
    'glimage' => 'M5.09 7.273v1.745H7.98c-.116.75-.873 2.197-2.887 2.197-1.737 0-3.155-1.44-3.155-3.215S3.353 4.785 5.09 4.785c.99 0 1.652.422 2.03.786l1.382-1.33c-.887-.83-2.037-1.33-3.41-1.33C2.275 2.91 0 5.184 0 8s2.276 5.09 5.09 5.09c2.94 0 4.888-2.065 4.888-4.974 0-.334-.036-.59-.08-.843H5.09zM16 7.273h-1.455V5.818H13.09v1.455h-1.454v1.454h1.455v1.455h1.455V8.727H16',
]);

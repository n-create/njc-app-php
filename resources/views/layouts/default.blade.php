<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php
  $path = parse_url(app('request')->url(), PHP_URL_PATH);
  if("/" === $path) {
      $path = "index";
  } else {
      $path = substr($path, 1);
      $path = str_replace("/", "_", $path);
  }
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <title>NJC-APPテストページ</title>@include('layouts.css')
    @include('layouts.script')
    @include('layouts.meta')
  </head>
  <body class="{{ $path }} public-body">
    @include('layouts.header')
    @yield('contents')
  </body>
</html>

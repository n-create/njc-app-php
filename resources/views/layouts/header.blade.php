<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<div class="inner-header-contents-wrap content1">
  <div id="header-contents-wrap">
    <div class="bg-dark">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar navbar-dark row"><a href="/" class="navbar-brand">○○不動産</a>
          <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"><span class="navbar-toggler-icon"></span></button>
          <div id="navbarSupportedContent" class="collapse navbar-collapse justify-content-around">
            <ul class="nav navbar-nav">
              <li class="nav-item"><a href="/" class="nav-link">ホーム</a></li>
            </ul><?php foreach(BK_TYPE as $rentSaleStr => $rentSale) { ?>
            <ul class="nav navbar-nav">
              <li class="nav-item dropdown"><a data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">{{ ((RS_STR_RENT == $rentSaleStr) ? '賃貸' : '売買') }}物件検索</a>
                <div class="dropdown-menu"><?php foreach(SEARCH_METHOD as $key => $text) { ?><a href="/{{ $rentSaleStr }}/{{ $key }}" class="dropdown-item">{{ $text }}</a><?php } ?></div>
              </li>
            </ul><?php } ?>
          </div>
        </nav>
      </div>
    </div>
  </div>
</div>

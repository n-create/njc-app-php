<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php if($isNoLink) { ?><span class="btn btn-white no-link {{ $class }}">{{ $text }}</span><?php } else { ?><a href="{{ $url }}" class="btn btn-white {{ $class }}">{{ $text }}</a><?php } ?>

<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
?>
<?php
   $script_files = [
       "/js/components/jquery/jquery-3.3.1.min.js",
       "/js/components/jquery/jquery-migrate-3.0.0.min.js",
       "/js/components/jquery/jquery-ui/jquery-ui.js",
       "/js/components/jquery/jquery-ui/jquery-ui.custom.js",
       "/js/components/jquery/jquery-ui/jquery.ajaxDialog.js",
       "/js/components/bootstrap/bootstrap.min.js",
       '/js/components/popper/popper.min.js',
       "/js/njc/linkInputLabel.js",
       "/js/njc/searchCheckVaild.js",
   ];
?>
<?php foreach($script_files as $filePath) { ?>
<script type="text/javascript" src="{{ $filePath }}?_={{ date('Ymdhis') }}"></script><?php } ?>

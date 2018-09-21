/// <reference path="../../../../typings/globals/jquery/index.d.ts" />
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
$(function(){
    var $select = $('.theta-select').find('.btn-theta');
    $select.click(function(event) {
        event.preventDefault();
        var $iframe   = $('.thetaPlayerWrap iframe');
        var iframeUrl = $iframe.attr('src').split('?');
        var params    = iframeUrl[1] || '';

        $iframe.attr('src', $(this).data('url') + '?' + params);
        $select.removeClass('active');
        $(this).addClass('active');
        return false;
    });
    var $thetaLinkBox:JQuery = $('.thetaLinkBox');
    $('.theta-disp-wrap').click(function():void {
        if(window.matchMedia('(max-width:767px)').matches) { 
            var $thetaBtn:JQuery = $(this).find('.control-btn');
            if($thetaBtn.hasClass('tmOpenIcon')) {
                $thetaBtn.text('閉じる').addClass('tmCloseIcon').removeClass('tmOpenIcon');
                $thetaLinkBox.fadeIn(200);
            } else {
                $thetaBtn.text('開く').addClass('tmOpenIcon').removeClass('tmCloseIcon');
                $thetaLinkBox.fadeOut(200);
            }
        }
    });
});

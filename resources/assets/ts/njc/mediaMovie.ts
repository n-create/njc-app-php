/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
$(function () {
  $(".movie-disp-wrap").click(function (): void {
    if (window.matchMedia("(max-width:768px)").matches) {
      var $this: JQuery = $(this);
      var $movieBtn: JQuery = $this.find(".control-btn");
      var $target: JQuery = $("#" + $this.attr("data-ng-target-id"));
      if ($movieBtn.hasClass("tmOpenIcon")) {
        $movieBtn
          .text("閉じる")
          .addClass("tmCloseIcon")
          .removeClass("tmOpenIcon");
        $target.fadeIn(200);
      } else {
        $movieBtn
          .text("開く")
          .addClass("tmOpenIcon")
          .removeClass("tmCloseIcon");
        $target.fadeOut(200);
      }
    }
  });
});

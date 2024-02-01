/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
jQuery(document).ready(function ($) {
  // Initially set opacity on thumbs and add
  // additional styling for hover effect on thumbs
  var onMouseOutOpacity: any = 0.67;
  // Initialize Advanced Galleriffic Gallery
  var gallery: any = $("#thumbs").galleriffic({
    buildPageLink: function (): void {},
    delay: 5000,
    numThumbs: 15,
    preloadAhead: 10,
    enableTopPager: false,
    enableBottomPager: true,
    maxPagesToShow: 7,
    imageContainerSel: "#slideshow",
    controlsContainerSel: "#controls",
    captionContainerSel: "#caption",
    loadingContainerSel: "#loading",
    renderSSControls: false,
    renderNavControls: true,
    playLinkText: "Play Slideshow",
    pauseLinkText: "Pause Slideshow",
    prevLinkText: "",
    nextLinkText: "",
    nextPageLinkText: "次へ",
    prevPageLinkText: "前へ",
    enableHistory: false,
    autoStart: false,
    syncTransitions: true,
    defaultTransitionDuration: 900,
    onSlideChange: function (prevIndex, nextIndex): void {},
    onPageTransitionOut: function (callback): void {
      this.fadeTo("fast", 0.0, callback);
    },
    onPageTransitionIn: function (): void {
      this.fadeTo("fast", 1.0);
    },
  });

  var isTchSt: boolean = false;
  var startPosX: number = 0;
  var startTime: number = 0;
  var endPosX: number = 0;
  //フリック機能を追加する
  $("#gallery").on("touchmove", function (e): void {
    //フリックし始めるところ。
    var pos: any = getTouchPosition(e);
    if (!isTchSt) {
      startPosX = pos.x;
      startTime = new Date().getTime();
      isTchSt = true;
    }
    endPosX = pos.x;
  });
  $("#gallery").on("touchend", function (e): void {
    //フリックし終わるところ。
    var move: number = endPosX - startPosX;
    var endTime: number = new Date().getTime();
    if (50 < Math.abs(move) && 1000 >= endTime - startTime) {
      if (0 < move) {
        gallery.previous();
      } else {
        gallery.next();
      }
    }
    isTchSt = false;
  });
  function getTouchPosition(e): any {
    var x: any = e.originalEvent.touches[0].pageX;
    var y: any = e.originalEvent.touches[0].pageY;
    x = Math.floor(x);
    y = Math.floor(y);
    return { x: x, y: y };
  }
});

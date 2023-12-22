/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
$(function () {
  $(".bundle-child-dialog").dialog({
    resizable: false,
    modal: true,
    autoOpen: false,
    title: "同一建物内物件情報",
    draggable: true,
    buttons: {
      閉じる: function (): void {
        $(this).dialog("close");
      },
    },
  });
  $(".bundle-display-btn").click(function (): void {
    var winW: number = $(window).width();
    var winH: number = $(window).height();
    var dlgW: any = 1000;
    var btn: JQuery = $(this);
    if (winW < 1000) {
      dlgW = "90%";
    }
    var dataString: string = btn.attr("data-bundle-childen");
    var resultData: any = $.parseJSON(dataString);
    $.ajax({
      type: "POST",
      url: "/rent/bundle_dialog",
      data: resultData,
      success: function (htmlDat) {
        $(".bundle-child-dialog")
          .dialog({
            width: dlgW,
            draggable: false,
            open: function (): void {
              $(this).html(htmlDat);
              var target: any = $(this).parent(".ui-dialog");
              var sclTop: any =
                document.body.scrollTop || document.documentElement.scrollTop;
              $(target).css({
                position: "fixed",
                top: "50%",
                left: "50%",
                "max-width": "90%",
                "max-height": "90%",
                "overflow-y": "auto",
                transform: "translate(-50%, -50%)",
              });
            },
          })
          .dialog("open");
      },
    });
  });

  // 物件詳細ボタンを作る
  function getLinkDetail(dv): string {
    var link: string = "";
    var find: string = "href=";
    var quote: string = "";
    $.each(dv, function (dmk, dmv) {
      if (dmv["key"] === "link") {
        var pos: number = dmv["value"].indexOf(find) + find.length;
        quote = dmv["value"].substring(pos, pos + 1);
        link = dmv["value"].substring(
          pos + 1,
          dmv["value"].indexOf(quote, pos + 2)
        );
      }
    });
    return link;
  }
});
//物件詳細に飛ぶ、行全体に物件詳細のリンクを付ける時使用
function goDetail(link) {
  var e = window.event ? window.event : arguments.callee.caller.arguments[0];
  var self = e.target || e.srcElement;
  if (
    -1 < self.outerHTML.indexOf("</div>") ||
    -1 < self.outerHTML.indexOf("</td>")
  ) {
    window.open(link);
  }
}

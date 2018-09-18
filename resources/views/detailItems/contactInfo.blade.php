
<?php
/***
* Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
*/
?>
<div class="detail-contact-info card bg-light">
  <div class="detail-contact-info-inner">
    <div class="info-title card-header">この物件のお問い合わせ</div>
    <div class="card-body">
      <div class="info-message mb-2">お電話でお気軽にお問い合わせください。お電話でのお問い合わせの際は、「物件お問い合わせ番号」をお伝えいただけますとスムーズにご案内することができます。</div>
      <div class="row align-items-center">
        <div class="col-md-5">
          <div class="info-num p-3 bg-white text-center mb-sm-0 mb-2"><span class="info-num-title d-inline-block">物件お問い合わせNo.：</span><span class="info-num-conts d-inline-block mb-0 h4 text-danger">
              <?php
                $contactNo = $detailData[$searchManager::BK_DATA_BILDNUM];
                if(RS_STR_RENT === $rentSaleStr && !empty($detailData[$searchManager::BK_DATA_ROOMNO])) {
                    $contactNo .= "-" . $detailData[$searchManager::BK_DATA_ROOMNO];
                }
              ?>
              {{ $contactNo }}</span></div>
        </div>
        <div class="col-md-7">
          <div class="info-telmail row align-items-center">
            <div class="child info-tel col-xl-5">
              <dl class="info-tel-conts mb-sm-0 mb-1">
                <dt class="info-st-title">TEL</dt>
                <dd class="info-st-conts h3">0120-12-3745</dd>
              </dl>
            </div>
            <div class="child info-holiday col-xl-7">
              <dl class="info-st mr-2">
                <dt class="info-st-title">営業時間</dt>
                <dd class="info-st-conts">9：00～18：00</dd>
              </dl>
              <dl class="info-st">
                <dt class="info-st-title">定休日</dt>
                <dd class="info-st-conts">水曜日・祝日(2月・3月は、定休日なしで営業しております。)</dd>
              </dl>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
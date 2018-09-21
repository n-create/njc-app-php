<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Parents\ParentBkController;

class RentController extends ParentBkController
{
    protected $rentSaleStr = RS_STR_RENT;
    protected $rentSale = RS_CODE_RENT;

    public function bundle_dialog() {
        return view("/searchItems/bundleDialog");
    }

}

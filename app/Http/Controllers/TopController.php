<?php

/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */

namespace App\Http\Controllers;

use App\Http\Controllers\AppController as AppController;

class TopController extends AppController
{
    public function index()
    {
        return view("top/index");
    }
    public function debug()
    {
        return view("top/debug");
    }
}

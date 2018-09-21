<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class AppController extends BaseController
{
    protected function getAction() {
        $path = parse_url(app('request')->url(), PHP_URL_PATH);
        if("/" === $path) {
            $path = "index";
        } else {
            $path_s = explode("/", $path);
            $path = end($path_s);
        }
        return $path;
    }
}

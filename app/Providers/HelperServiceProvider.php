<?php

/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        foreach (glob(__DIR__ . ".." . '/app/Services/Helper/*.php') as $filename) {
            require_once($filename);
        }
    }
}

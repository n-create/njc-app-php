<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$routes_path = config('routes');

foreach($routes_path as $method => $routeData) {
    foreach($routeData as $controller => $actionData) {
        foreach($actionData as $url => $action) {
            if('detail' == $url) {
                $router->{$method}("{$controller}/{$url}/{id}", ucfirst($controller) . "Controller@{$action}");
            } else {
                if('top' != $controller) {
                    $router->{$method}("{$controller}/{$url}", ucfirst($controller) . "Controller@{$action}");
                } else {
                    $router->{$method}($url, ucfirst($controller) . "Controller@{$action}");
                }
            }
        }
    }
}

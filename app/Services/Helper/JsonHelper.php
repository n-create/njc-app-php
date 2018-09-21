<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */
namespace App\Services\Helper;

use Illuminate\Http\JsonResponse;
class JsonHelper {
    private function _sendError($code, $message) {
        if(function_exists('xdebug_disable')) {
            xdebug_disable();
        }
        abort($code, $message);
    }
    function jsonResponse($data) {
        $response = JsonResponse::create($data,200);
        $response->send();
    }
    private function _getJsonData($path, $isDecode) {
        $headers = [
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Bearer ' . env('API_TOKEN_KEY'),
        ];
        $optHttp = [
            'method' => 'GET',
            'timeout' => 30,
            'ignore_errors' => true,
        ];
        $optHttp['header'] = implode( "\r\n", $headers );
        $options = array('http' => $optHttp);
        $stream = stream_context_create( $options );
        $body = file_get_contents($path, false, $stream);
        if($isDecode) {
            $body = json_decode($body, "assoc", 512);
        }
        if(null === $body) {
            self::_sendError(404, "404");
        } else if(!empty($body['code']) && 404 == $body['code']){
            self::_sendError($body['code'], "{$body['code']}：{$body['message']}");
        }
        return $body;
    }
    function getJsonDataNoDebug($path, $isDecode) {
        return self::_getJsonData(env('API_DOMAIN') . $path, $isDecode);
    }
    function getJsonData($path, $isDecode) {
        if(DEBUG_MODE) {
            print("<!-- API_URL : {$path} -->");
        }
        return self::_getJsonData(env('API_DOMAIN') . $path, $isDecode);
    }

    function getLocalJsonData($filePath, $isDecode) {
        $body = file_get_contents(ROOT . $filePath);
        if($isDecode) {
            $body = json_decode($body, "assoc", 512);
        }
        return $body;
    }

    function viewJson($data) {
        header('content-type: application/json; charset=utf-8');
        if(is_array($data)) {
            $data = json_encode($data);
        }
        print($data);
    }
}

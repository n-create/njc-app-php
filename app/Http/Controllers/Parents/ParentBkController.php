<?php
/**
 * Copyright(c) 1997-2018 Nihon Jyoho Create Co.,Ltd.
 */

namespace App\Http\Controllers\Parents;

use App\Http\Controllers\AppController as AppController;
use App\Services\Helper\SearchItemHelper;
use App\Services\Helper\JsonHelper;

class ParentBkController extends AppController
{
    protected $rentSaleStr = null;
    protected $rentSale = null;
    protected $dispItems = [];

    private $_ajaxOnly = [
        'getMapArea',
        'getMapCity',
        'getMapZahyou',
        'getMapZahyouBukken',
    ];

    public function __construct() {
        $action = parent::getAction();
        if(in_array($action, $this->_ajaxOnly)) {
            $this->middleware('ajaxOnly');
        }
    }

    public function getMapArea() {
        return view("/map/{$this->rentSaleStr}/bk_search_map_area");
    }

    public function getMapCity() {
        return view("/map/{$this->rentSaleStr}/bk_search_map_city");
    }

    public function getMapZahyou() {
        $result = [];
        $jsonData = (new SearchItemHelper())->getMapZahyouData($this->rentSaleStr);
        (new JsonHelper())->viewJson($jsonData);
    }

    public function getMapZahyouBukken() {
        $result = [];
        $searchManager = new SearchItemHelper();
        $resultKey = (RS_CODE_RENT === $this->rentSale) ? $searchManager::RS_STR_NO_BUNDLE : $this->rentSaleStr;
        $jsonData = $searchManager->getBkResultData($resultKey);
        return view("/map/{$this->rentSaleStr}/ajax_map_zahyo_bukken", compact('jsonData'));
    }

    public function index() {
        return view("{$this->rentSaleStr}/".__FUNCTION__);
    }

    public function railway() {
        return view("{$this->rentSaleStr}/".__FUNCTION__);
    }

    public function station() {
        return view("{$this->rentSaleStr}/".__FUNCTION__);
    }

    public function city() {
        return view("{$this->rentSaleStr}/".__FUNCTION__);
    }

    public function area() {
        return view("{$this->rentSaleStr}/".__FUNCTION__);
    }

    public function location() {
        return view("{$this->rentSaleStr}/".__FUNCTION__);
    }

    public function school() {
        return view("{$this->rentSaleStr}/".__FUNCTION__);
    }

    public function map() {
        return view("{$this->rentSaleStr}/".__FUNCTION__);
    }

    public function result() {
        return view("{$this->rentSaleStr}/".__FUNCTION__);
    }

    public function detail($id) {
        return view("{$this->rentSaleStr}/".__FUNCTION__, compact('id'));
    }
}

<?php

namespace App\Http\Controllers\Api\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @ Form Request 
 **/
use App\Http\Requests\Transaction\StorePutMoney;

/**
 * @ SOLID SRP
 * @ Repository
 **/
use App\Repositories\Transaction\PutMoneyRepository;

class PutMoneyController extends Controller
{
    /**
     * @ Repository Implementation
     **/
    protected $putMoney;

    /**
     * Create new controller instace
     * @param PutMoneyRepository
     * @ constructor 
     **/
    public function __construct(PutMoneyRepository $PutMoneyRepository)
    {
        $this->putMoney = $PutMoneyRepository;
        $this->middleware('auth:api');
    }

    /**
     * @ Show Put Money 
     **/
    public function storePutMoney(StorePutMoney $request)
    {
        return response()->json($this->putMoney->storePutMoney($request));
    }


}

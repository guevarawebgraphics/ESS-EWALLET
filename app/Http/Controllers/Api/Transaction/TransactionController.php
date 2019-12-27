<?php

namespace App\Http\Controllers\Api\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @ Form Request
 **/
use App\Http\Requests\Transaction\StorePrefund;

/**
 * @ SOLID SRP
 * @Repository
 **/
use App\Repositories\Trasanction\PrefundRepository;

class TransactionController extends Controller
{
    /**
     * @ Repository Implementation 
     **/
    protected $prefund;

    /**
     * Create new controller instance
     * @param  PrefundRepository
     * @ constructor
     **/
    public function __construct(PrefundRepository $PrefundRepository){
        $this->prefund = $PrefundRepository;
        // /$this->middleware('auth:api');
    }

    /**
     * @ Store Prefund 
     **/
    public function StorePrefund(StorePrefund $request){
        $prefund = $this->prefund->StorePrefund($request);
        return response()->json($prefund);
    }
}

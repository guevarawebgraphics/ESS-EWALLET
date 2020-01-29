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
 * @ Repository 
 **/
use App\Repositories\Trasanction\PrefundRepository;

class PrefundController extends Controller
{
    /**
     * @ Repository Implementation 
     **/
    protected $prefund;

    /**
     * Create new controller intance
     * @param PrefundRepository
     * @ constructor 
     **/
    public function __construct(PrefundRepository $PrefundRepository)
    {
        $this->prefund = $PrefundRepository;
        $this->middleware('auth:api');
    }

    /**
     * @ Store Prefund 
     **/
    public function storePrefund(StorePrefund $request)
    {
        $prefund = $this->prefund->storePrefund($request);
        return response()->json($prefund);
    }

    /**
     * @ Update Prefund Transaction Status 
     * @param id
     * @return updatePrefundStatus
     **/
    public function updatePrefundStatus($id)
    {
        $updatePrefundStatus = $this->prefund->updatePrefundStatus($id);
        return response()->json($updatePrefundStatus);
    }
}

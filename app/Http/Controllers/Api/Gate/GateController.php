<?php

namespace App\Http\Controllers\Api\Gate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @ SOLID SRP
 * @ Repository 
 **/
use App\Repositories\Gate\GateRepository;

class GateController extends Controller
{
    /**
     * @ Repository Implementation 
     **/
    protected $gate;

    /**
     * Create new controller instance
     * @param GateRepository
     * @ constructor 
     **/
    public function __construct(GateRepository $GateRepository)
    {
        $this->gate = $GateRepository;
        $this->middleware('auth:api');
    }

    public function gate()
    {
        return response()->json($this->gate->gate());
    }
}

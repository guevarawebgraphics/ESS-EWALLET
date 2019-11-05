<?php

namespace App\Http\Controllers\Api\ServiceMatrix;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @ Respository 
 **/
use App\Repositories\ServiceMatrix\ServiceMatrixRepository;

class ServiceMatrixController extends Controller
{
    /**
     * @ Respositry Implementation
     **/
    protected $ServiceMatrix;

    /**
     * Create a new controller instance
     * @param ServiceMatrixRepository $ServiceMatrixRepository
     * @ Constructor
     **/
    public function __construct(ServiceMatrixRepository $ServiceMatrixRepository){
        $this->ServiceMatrix = $ServiceMatrixRepository;
        $this->middleware('auth:api');
    }

    /**
     * @ Store Service Matrix
     **/
    public function StoreServiceMatrix(Request $request){
        $service_matrix = $this->ServiceMatrix->StoreServiceMatrix($request);

        return response()->json([
            'status' => 'success'
        ]);
    }


}

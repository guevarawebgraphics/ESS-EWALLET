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
     * @ Respository Implementation
     **/
    protected $ServiceMatrix;

    /**
     * Create a new controller instance
     * @param ServiceMatrixRepository $ServiceMatrixRepository
     * @ Constructor
     **/
    public function __construct(ServiceMatrixRepository $ServiceMatrixRepository)
    {
        $this->ServiceMatrix = $ServiceMatrixRepository;
        $this->middleware('auth:api');
    }

    /**
     * @ Store Service Matrix
     **/
    public function storeServiceMatrix(Request $request)
    {
        return response()->json($this->ServiceMatrix->storeServiceMatrix($request->all()));
    }

     /**
     * @ Get Services 
     **/
    public function showServices()
    {
        return response()->json($this->ServiceMatrix->showServices());
    }

    /**
     * @ Get Service Matrix Config 
     **/
    public function getServiceMatrixConfig()
    {
        return response()->json($this->ServiceMatrix->getServiceMatrix());
    }

    /**
     * @ search service matrix setup
     * @return  ServiceMatrix
     **/
    public function searchServiceMatrix($query)
    {
        return response()->json($this->ServiceMatrix->searchServiceMatrix($query));
    }


}

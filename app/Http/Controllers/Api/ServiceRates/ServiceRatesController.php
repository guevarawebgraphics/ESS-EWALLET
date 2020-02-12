<?php

namespace App\Http\Controllers\Api\ServiceRates;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @ Form Request 
 **/
use App\Http\Requests\ServiceRates\StoreServiceRates;
/**
 * @ Repository 
 **/
use App\Repositories\ServiceRates\ServiceRatesRepository;

class ServiceRatesController extends Controller
{
    /**
     *@ Repository Implementation 
     **/
    protected $ServiceRates;

    /**
     * Create a new controller instance
     * @param ServiceRatesRepository $ServiceRatesRepository
     * @ Constructor 
     **/
    public function __construct(ServiceRatesRepository $ServiceRatesRepository)
    {
        $this->ServiceRates = $ServiceRatesRepository;
        $this->middleware('auth:api');
    }

    /**
     * Get All Service Rates 
     **/
    public function showAllServiceRates()
    {
        return response()->json($this->ServiceRates->showAllServiceRates());
    }

    /**
     * @ Store Service Rates 
     **/
    public function storeServiceRates(StoreServiceRates $request)
    {
        $service_group = $this->ServiceRates->storeServiceRates($request);
        return response()->json(['status' => 'success']);
    }


    /**
     * @ Update Service Rates 
     **/
    public function updateServiceRates(StoreServiceRates $request)
    {
        $service_group = $this->ServiceRates->updateServiceRates($request);
        return response()->json(['status' => 'success']);
    }
}

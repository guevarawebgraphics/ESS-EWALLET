<?php

namespace App\Http\Controllers\Api\ServiceMatrix;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @ Form Request 
 **/
use App\Http\Requests\ServiceMatrix\StoreServiceGroup;
/**
 * @ Repository 
 **/
use App\Repositories\ServiceMatrix\ServiceGroupRepository;

class ServiceGroupController extends Controller
{
    /**
     *@ Repository Implementation 
     **/
    protected $serviceGroupRepository;

    /**
     * Create a new controller instance
     * @param ServiceGroupRepository $ServiceGroupRepository
     * @ Constructor 
     **/
    public function __construct(ServiceGroupRepository $ServiceGroupRepository){
        $this->serviceGroupRepository = $ServiceGroupRepository;
    }

    /**
     * Get All Service group 
     **/
    public function get_all_service(){
        $service_group = $this->serviceGroupRepository->get_all_service();
        return response()->json($service_group);
    }
    /**
     * @ Store Service Group 
     **/
    public function StoreServiceGroup(StoreServiceGroup $request){
        $service_group = $this->serviceGroupRepository->store_service_group($request);

        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * @ Update Service Group
     **/
    public function UpdateServiceGroup(StoreServiceGroup $request){
        $service_group = $this->serviceGroupRepository->update_service_group($request);

        return response()->json([
            'status' => 'success'
        ]);
    }
}

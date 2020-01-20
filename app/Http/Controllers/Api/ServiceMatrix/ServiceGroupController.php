<?php

namespace App\Http\Controllers\Api\ServiceMatrix;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @ Form Request 
 **/
use App\Http\Requests\ServiceMatrix\StoreServiceGroup;
use App\Http\Requests\ServiceMatrix\UpdateServiceGroup;
/**
 * @ Repository 
 **/
use App\Repositories\ServiceMatrix\ServiceGroupRepository;

class ServiceGroupController extends Controller
{
    /**
     *@ Repository Implementation 
     **/
    protected $ServiceGroup;

    /**
     * Create a new controller instance
     * @param ServiceGroupRepository $ServiceGroupRepository
     * @ Constructor 
     **/
    public function __construct(ServiceGroupRepository $ServiceGroupRepository){
        $this->ServiceGroup = $ServiceGroupRepository;
        $this->middleware('auth:api');
    }

    /**
     * Get All Service group 
     **/
    public function GetAllService(){
        $service_group = $this->ServiceGroup->GetAllService();
        return response()->json($service_group);
    }
    /**
     * @ Store Service Group 
     **/
    public function StoreServiceGroup(StoreServiceGroup $request){
        $service_group = $this->ServiceGroup->StoreServiceGroup($request);

        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * @ Update Service Group
     **/
    public function UpdateServiceGroup(UpdateServiceGroup $request, $id){
        $service_group = $this->ServiceGroup->UpdateServiceGroup($request, $id);

        return response()->json([
            'status' => 'success'
        ]);
    }
}

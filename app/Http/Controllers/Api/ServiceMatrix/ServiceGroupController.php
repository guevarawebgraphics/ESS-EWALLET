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
    public function __construct(ServiceGroupRepository $ServiceGroupRepository)
    {
        $this->ServiceGroup = $ServiceGroupRepository;
        $this->middleware('auth:api');
    }

    /**
     * Get All Service group 
     **/
    public function showAllService()
    {
        return response()->json($this->ServiceGroup->showAllService());
    }
    /**
     * @ Store Service Group 
     **/
    public function storeServiceGroup(StoreServiceGroup $request)
    {
        $serviceGroup = $this->ServiceGroup->storeServiceGroup($request);
        return response()->json(['status' => $serviceGroup]);
    }

    /**
     * @ Update Service Group
     * @param id
     **/
    public function updateServiceGroup(UpdateServiceGroup $request, $id)
    {
        $serviceGoup = $this->ServiceGroup->updateServiceGroup($request, $id);
        return response()->json(['status' => $serviceGoup]);
    }

    /**
     * @ search service group 
     **/
    public function searchServiceGroup($query)
    {
        return response()->json($this->ServiceGroup->searchServiceGroup($query));
    }
}

<?php

namespace App\Http\Controllers\Api\ServiceType;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ServiceType\ServiceTypeRepository;
/**
 * Service Type Module For Create/Update/READ
 * Validation Soon**
 */
class ServiceTypeController extends Controller
{
    protected $serviceType;

    public function __construct(ServiceTypeRepository $ServiceTypeRepository)
    {
        $this->serviceType = $ServiceTypeRepository;
        $this->middleware('auth:api');
    }

    /**
     * For showing Service Types Table 
     */
    public function showServiceTypeDetails(Request $request)
    {
        return response()->json($this->serviceType->showServiceTypeDetails());
    }
    /**
    * Retrieve all behaviors/Details on update
    */
    public function serviceTypeSetUp(Request $request,$st_id)
    {
        return response()->json($this->serviceType->showServiceDetailsAndBehavior($st_id));
    }
    /**
     * Updating Service Details (Behaviors changes)
     */
    public function saveServiceDetailsBehavior(Request $request,$st_id)
    {
        $SaveDetailsBehavior = $this->serviceType->updateServiceDetailsAndBehavior($request,$st_id);
        return response()->json(['status' => 'success']);    
    }
    /**
     * For saving service type templates
     */
    public function saveServiceTemplates(Request $request)
    {
        $SaveServiceTypeTemplates = $this->serviceType->updateServiceTypeTemplates($request);
        return response()->json(['status' => 'success']);    
    }
    /**
     * Saving Service Type
     */
    public function storeServiceType(Request $request)
    {
        $SaveServiceType = $this->serviceType->storeServiceType($request);
        return response()->json(['status' => 'success']);    
    }
    /**
     * For showing all services that used this service type.
     * @param st_id
     */
    public function showServices($st_id)
    {
        $ShowServices = $this->serviceType->showBelongServices($st_id);
        return $ShowServices;
    }

    /**
     * @ search Service Type 
     **/
    public function searchServiceType($query)
    {
        return response()->json($this->serviceType->searchServiceType($query));
    }
}

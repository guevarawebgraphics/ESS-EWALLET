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

    public function __construct(ServiceTypeRepository $ServiceTypeRepository){
        $this->serviceType = $ServiceTypeRepository;
        $this->middleware('auth:api');
    }
    /**
     * For showing Service Types Table 
     */
    public function GetServiceTypeTable(Request $request){
        $ServiceTypeTable = $this->serviceType->get_service_type_table();
        return response()->json($ServiceTypeTable);
    }
    /**
    * Retrieve all behaviors/Details on update
    */
    public function ServiceTypeSetUp(Request $request,$st_id){
        $STSetUp = $this->serviceType->get_service_details_and_behavior($st_id);
        return response()->json($STSetUp);
    }
    /**
     * Updating Service Details (Behaviors changes)
     */
    public function SaveServiceDetailsBehavior(Request $request,$st_id){
        $SaveDetailsBehavior = $this->serviceType->update_service_details_and_behavior($request,$st_id);
        return response()->json([
            'status' => 'success'
        ]);    
    }
    /**
     * For saving service type templates
     */
    public function SaveServiceTemplates(Request $request){
        $SaveServiceTypeTemplates = $this->serviceType->update_service_type_templates($request);
        return response()->json([
            'status' => 'success'
        ]);    
    }
    /**
     * Saving Service Type
     */
    public function SaveServiceType(Request $request){
        $SaveServiceType = $this->serviceType->create_service_type($request);
        return response()->json([
            'status' => 'success'
        ]);    
    }
    /**
     * For showing all services that used this service type.
     */
    public function ShowServices($st_id){
        $ShowServices = $this->serviceType->show_belong_services($st_id);
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

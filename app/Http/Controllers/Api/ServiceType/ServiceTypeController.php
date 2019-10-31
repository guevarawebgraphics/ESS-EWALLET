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
    public function GetServiceTypeTable(Request $request){
        $ServiceTypeTable = $this->serviceType->get_service_type_table();
        return response()->json($ServiceTypeTable);
    }
    public function ServiceTypeSetUp(Request $request,$st_id){
        $STSetUp = $this->serviceType->get_service_details_and_behavior($st_id);
        return response()->json($STSetUp);
    }
    public function SaveServiceDetailsBehavior(Request $request,$st_id){
        $SaveDetailsBehavior = $this->serviceType->update_service_details_and_behavior($request,$st_id);
        return response()->json([
            'status' => 'success'
        ]);    
    }
    public function SaveServiceType(Request $request){
        $SaveServiceType = $this->serviceType->create_service_type($request);
        return response()->json([
            'status' => 'success'
        ]);    
    }
}

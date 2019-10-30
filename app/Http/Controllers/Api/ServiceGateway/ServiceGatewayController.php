<?php

namespace App\Http\Controllers\Api\ServiceGateway;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ServiceGateway\ServiceGatewayRepository; 

/**
 * Service Gateway Module For Create 
 * 
 */
class ServiceGatewayController extends Controller
{ 
    protected $ServiceGateway;
    public function __construct(ServiceGatewayRepository $ServiceGateway){
        $this->servicegateway = $ServiceGateway; 
   //     $this->middleware('auth:api');
    }
    
    public function CreateServiceGateway(Request $request){
        $insert_servicegateway = $this->servicegateway->CreateServiceGatewayMethod($request);
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function GetServiceGateway() { 
        $get_servicegateway = $this->servicegateway->GetServiceGatewayMethod();
        return response()->json($get_servicegateway);
    }
    public function UpdateServiceGateway(Request $request,$gw_id) {
        $update_servicegateway = $this->servicegateway->UpdateServiceGatewayMethod($request,$gw_id);
        return response()->json([
            'status' => 'success'
        ]);
    }
    
}

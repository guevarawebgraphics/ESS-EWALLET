<?php

namespace App\Http\Controllers\Api\ServiceGateway;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ServiceGateway\ServiceGatewayRepository; 
/**
 * Request
 */ 

use App\Http\Requests\ServiceGateway\ServiceGateway;
use App\Http\Requests\ServiceGateway\updateServiceGateway;
/**
 * Service Gateway Module For Create 
 * 
 */
class ServiceGatewayController extends Controller
{ 
    protected $ServiceGateway;
    
    public function __construct(ServiceGatewayRepository $ServiceGateway){
        $this->servicegateway = $ServiceGateway; 
        $this->middleware('auth:api');
    }
    /**
     * For creating new service Gateway
     */
    public function CreateServiceGateway(ServiceGateway $request){
        $insert_servicegateway = $this->servicegateway->CreateServiceGatewayMethod($request);
        return response()->json([
            'status' => 'success'
        ]);
    }
    /**
     * For getting the service gateway info
     */
    public function GetServiceGateway() { 
        $get_servicegateway = $this->servicegateway->GetServiceGatewayMethod();
        return response()->json($get_servicegateway);
    }
    /**
     * For updating Service Gateway
     */
    public function UpdateServiceGateway(updateServiceGateway $request,$gw_id) {
        $update_servicegateway = $this->servicegateway->UpdateServiceGatewayMethod($request,$gw_id);
        return response()->json([
            'status' => 'success'
        ]);
    }
    
}

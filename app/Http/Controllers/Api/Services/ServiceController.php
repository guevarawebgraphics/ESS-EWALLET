<?php

namespace App\Http\Controllers\Api\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Service\ServiceRepository; 
/**
 * Form Request Validation
 */ 
use App\Http\Requests\Services\ServiceValidate;
/**
 * Service Module For Create 
 * Validation & other method SOON***
 */
class ServiceController extends Controller
{
    protected $services; 
    public function __construct(ServiceRepository $ServiceRepository){
        $this->services =  $ServiceRepository; 
      //  $this->middleware('auth:api');
    }
    /**
     * For inserting Service , Wallet Details and Service & Service Type ID
     */
    public function InsertService(ServiceValidate $request){
        $InsertService = $this->services->InsertServiceMethod($request);
        return response()->json([
            'status' => 'success'
        ]);    
    }
    public function fillServiceType(Request $request,$service_type_code){
        $fill_service_type = $this->services->FillServiceTypeMethod();
        return response()->json([
            'status' => 'success'
        ]);
    } 

}

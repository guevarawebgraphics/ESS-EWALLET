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
    /**
     * For getting Service Name using service code 
     */
    public function fillServiceType(Request $request,$service_type_code){
        $fill_service_type = $this->services->FillServiceTypeMethod($service_type_code);
        return response()->json($fill_service_type);
    } 
    /**
     * Fill principal redeem account name
     */
    public function FillPrWalletMethod($pr_wallet_acc_no){
        $fill_pr_account_name = $this->services->FillPrAccountNameMethod($pr_wallet_acc_no);
        return response()->json($fill_pr_account_name);
    } 
    public function FillIrWalletMethod($ir_wallet_acc_no){
        $fill_ir_account_name = $this->services->FillIrAccountNameMethod($ir_wallet_acc_no);
        return response()->json($fill_ir_account_name);
    }

}

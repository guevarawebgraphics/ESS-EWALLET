<?php

namespace App\Http\Controllers\Api\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Service\ServiceRepository; 
/**
 * Form Request Validation
 */ 
use App\Http\Requests\Services\ServiceValidate;
use App\Http\Requests\Services\JointValidate;
/**
 * Service Module For Create 
 * Validation & other method SOON***
 */
class ServiceController extends Controller
{
    /**
     * @ Repository Implementation 
     **/
    protected $services; 

    /**
     * Create a new Controller instance
     * @param ServiceRepository $ServiceRepository
     * @ Contructor 
     **/
    public function __construct(ServiceRepository $ServiceRepository){
        $this->services =  $ServiceRepository; 
        $this->middleware('auth:api');
    }
    /**
     * For inserting Service , Wallet Details and Service & Service Type ID
     */
    public function InsertService(ServiceValidate $request){
        $InsertService = $this->services->InsertServiceMethod($request);
        return response()->json($InsertService);    
    } 
    /**
     * For Updating Services , Wallet Details etc.
     */
    public function UpdateService(ServiceValidate $request){
        $UpdateService = $this->services->UpdateServiceMethod($request);
        return response()->json($UpdateService);    
    }
    /**
     * For Inserting Joint Services 
     */
    public function InsertJointService(JointValidate $request){
        $InsertJointService = $this->services->InsertJointServices($request);
        return response()->json($InsertJointService);
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
    /**
     * Get service table
     */
    public function GetService(){
        $get_services = $this->services->GetAllServices();
        return response()->json($get_services);
    }
    public function GetServiceDetails($service_id){
        $get_service_details = $this->services->GetServiceDetails($service_id);
        return response()->json($get_service_details);
    }
    public function GetWalletDetails($id){
        $get_wallet_details = $this->services->GetWalletDetails($id);
        return response()->json($get_wallet_details);
    }
    public function GetVSDR($service_id){
        $get_vsdr = $this->services->GetVSDR($service_id);
        return response()->json($get_vsdr);
    }
    /**
     * Get Joint Services
     */
    public function GetJointServicesList($id){
        $get_list_services = $this->services->JointServiceslist($id);
        return response()->json($get_list_services);
    }
    /**
     * Identifies which Service Type Code of this ID
     */
    public function GetServiceTypeCode($id,$wallet_condition){
        $get_service_type_code = $this->services->GetServiceTypeCode($id,$wallet_condition);
        return response()->json($get_service_type_code);
    }

    /**
     * @ List Services 
     * @return JSON($list_services)
     **/
    public function ListServices(){
        $list_services = $this->services->ListOfServices();
        return response()->json($list_services);
    }

}

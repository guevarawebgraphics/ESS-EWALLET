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
    public function __construct(ServiceRepository $ServiceRepository)
    {
        $this->services =  $ServiceRepository; 
        $this->middleware('auth:api');
    }
    /**
     * For inserting Service , Wallet Details and Service & Service Type ID
     */
    public function storeService(ServiceValidate $request)
    {
        $InsertService = $this->services->storeService($request);
        return response()->json($InsertService);    
    } 
    /**
     * For Updating Services , Wallet Details etc.
     */
    public function updateService(ServiceValidate $request)
    {
        $UpdateService = $this->services->updateServiceMethod($request);
        return response()->json($UpdateService);    
    }
    /**
     * For Inserting Joint Services 
     */
    public function storetJointServices(JointValidate $request)
    {
        $InsertJointService = $this->services->storetJointServices($request);
        return response()->json($InsertJointService);
    }
    /**
     * For getting Service Name using service code 
     */
    public function fillServiceType(Request $request,$service_type_code)
    {
        $fill_service_type = $this->services->fillServiceType($service_type_code);
        return response()->json($fill_service_type);
    } 
    /**
     * Fill principal redeem account name
     */
    public function fillPrWallet($pr_wallet_acc_no)
    {
        $fill_pr_account_name = $this->services->fillPrAccountName($pr_wallet_acc_no);
        return response()->json($fill_pr_account_name);
    } 
    public function fillIrWallet($ir_wallet_acc_no)
    {
        $fill_ir_account_name = $this->services->fillIrAccountName($ir_wallet_acc_no);
        return response()->json($fill_ir_account_name);
    }
    /**
     * Get service table
     */
    public function showService()
    {
        return response()->json($this->services->showServices());
    }
    public function getServiceDetails($service_id)
    {
        $get_service_details = $this->services->getServiceDetails($service_id);
        return response()->json($get_service_details);
    }
    public function getWalletDetails($id)
    {
        $get_wallet_details = $this->services->getWalletDetails($id);
        return response()->json($get_wallet_details);
    }
    public function getVSDR($service_id)
    {
        $get_vsdr = $this->services->getVSDR($service_id);
        return response()->json($get_vsdr);
    }
    /**
     * Get Joint Services
     */
    public function getJointServicesList($id)
    {
        $get_list_services = $this->services->jointServiceslist($id);
        return response()->json($get_list_services);
    }
    /**
     * Identifies which Service Type Code of this ID
     */
    public function getServiceTypeCode($id,$wallet_condition)
    {
        $get_service_type_code = $this->services->getServiceTypeCode($id,$wallet_condition);
        return response()->json($get_service_type_code);
    }

    /**
     * @ List Services 
     * @return JSON($list_services)
     **/
    public function showListServices()
    {
        $list_services = $this->services->showListOfServices();
        return response()->json($list_services);
    }

    /**
     * @ List Services 
     * @return searchListofServices
     **/
    public function searchListOfServices($query)
    {
        return response()->json($this->services->searchListOfServices($query));
    }

}

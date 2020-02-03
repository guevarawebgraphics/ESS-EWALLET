<?php

namespace App\Repositories\Service;

use DB; 
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
/**
 * Models
 */
use App\Models\Services\WService;
use App\Models\Services\WDetails;
use App\Models\Services\ServiceAndServiceType;
use App\Models\Services\ServiceAmountLimit;
use App\Models\Services\ServiceTransactionLimit;
use App\Models\ServiceMatrix\ServiceMatrix;
use App\Models\Services\Services;
use App\Models\Services\ServicesBaseTable; 
use App\Models\Services\ValuesSourceDestinationRates; 
use App\Models\Services\JointService;
use App\Models\Services\ServiceTypeDetailsBasetable;


/**
 * Class ServiceRepository.
 */
class ServiceRepository
{
    /**
     * @ connection 
     **/
    protected $connection;
    /**
     * @ constructor 
     **/
    public function __construct(){
        // E-Wallet Connection
        $this->connection = DB::connection('mysql');
    }
    /**
     * @return string
     *  Return the model
     */ 
    /**
     * For creating service
     */
    public function InsertServiceMethod($service_data){ 
                /**
                 * Inserting into Service table
                 */
             /*   $wservice = WService::create([
                    'service_code'=> $service_data->service_code,
                    'service_name'=> $service_data->service_name,
                    'service_description' => $service_data->service_description,
                    'service_gateway_id'=> $service_data->service_gateway, 
                    'service_group_id'=> $service_data->service_group_id,
                    'service_template' => "sameple.template", // sample string for template
                    'require_approval' => $service_data->approval,
                    'assign_approver_id' => $service_data->merchand_admin_id,
                    'wallet_type_id' => $service_data->wallet_type_id,
                ]); 
               */ /**
                 * Gets the service inserted and insert into wdetails table
                 */
              /*  $wservice_id = $wservice->id;
                $wdetails = WDetails::create([
                    'wservice_id' =>  $wservice_id,
                    'pr_wdetails_id' => $service_data->pr_wallet_id , 
                    'ir_wdetails_id' => $service_data->ir_wallet_id ,
                ]);*/

                /**
                 * Inserting into service_and_servicetype table
                 */
                /*$service_and_st = ServiceAndServiceType::create([
                    'service_id' => $wservice_id,
                    'service_type_id' => $service_data->service_type_id 
                ]);*/

                /**
                 * Inserting into service_amount_limit
                 */
                /*    
                $service_amount_limit = ServiceAmountLimit::create([ 
                    'service_id_amount'=> $wservice_id,
                    'limit_minimum'=> $service_data->limit_minimum,
                    'limit_maximum'=> $service_data->limit_maximum,
                    'amount_per_day' => $service_data->amount_per_day, 
                    'amount_per_month' => $service_data->amount_per_month,
                    'amount_per_year' => $service_data->amount_per_year
                ]);  
                */
                /**
                 * Inserting into service_transaction_limit
                 */
                /*
                $service_transaction_limit = ServiceTransactionLimit::create([
                    'service_id_transaction' => $wservice_id,
                    'limit_per_day' => $service_data->limit_per_day,
                    'limit_per_month' => $service_data->limit_per_month,
                    'limit_per_year' => $service_data->limit_per_year
                ]);
                */
                /**
                 * Inserting into Service Matrix
                 */ 
             /*   $service_matrix = ServiceMatrix::create([
                    'service_id' => $wservice_id,
                    'created_by' => '1',
                    'updated_by' => '1',

                ]);
                
                return $wservice;*/ 
                /**
                 * For Uploading Service Template
                 */ 
                $service_template = null;
                if($service_data->service_template !== 'empty'){
                    $filename_with_extension_app = $service_data->service_template->getClientOriginalName();
                    $file_name = pathinfo($filename_with_extension_app, PATHINFO_FILENAME);
                    $service_template = time().'_'.$file_name.'.'.$service_data->service_template->getClientOriginalExtension();
                    $upload  = $service_data->service_template->storeAs('public/uploads/templates/services_template', $service_template);   
                }
                else {
                    $service_template ==="empty";
                }
                /*---------------------------------------------------------------------------------------------*/
                /**
                 * Connection for Service Matrix 
                 **/
                $wservice = WService::create([
                    'service_code'=> $service_data->service_code,
                    'service_name'=> $service_data->service_name,
                    'service_description' => $service_data->service_description,
                    'service_gateway_id'=> $service_data->service_gateway, 
                    'service_group_id'=> $service_data->service_group_id,
                    'service_template' => "sameple.template", // sample string for template
                    'require_approval' => $service_data->approval,
                    'assign_approver_id' => $service_data->merchand_admin_id,
                    'wallet_type_id' => $service_data->wallet_type_id,
                ]); 
                $wservice_id = $wservice->id;
                /**
                 * Inserting into service_and_servicetype table
                 */
                $service_and_st = ServiceAndServiceType::create([
                    'service_id' => $wservice_id,
                    'service_type_id' => $service_data->service_type_id 
                ]);
                /*------------------------------------------------------------------------------------------*/
                /**
                 * Inserting Service 
                 */
                $insert_services = Services::create([
                            'service_code' => $service_data->service_code ,
                            'service_name' => $service_data->service_name,
                            'service_description' => $service_data->service_description,
                            's_wallet_type' =>  $service_data->wallet_type,
                            'wallet_condition' => $service_data->service_condition, 
                ]); 

                // Get Service Details Id
                $GetServiceDetailsId = $this->connection
                                        ->table('servicetypedetails')
                                        ->select('id')
                                        ->where('st_code', '=', $service_data->servicetype_code)
                                        ->first();

                // Store Service Type Details Basetable
                $StoreServiceTypeDetailsBasetable = ServiceTypeDetailsBasetable::create([
                                        'services_id' => $insert_services->id,
                                        'service_type_details_id' => $GetServiceDetailsId->id
                ]);
                /**
                 * Insert Service Base Table
                 */
                $insert_services_basetable = ServicesBaseTable::create([ 
                        'service_id' => $insert_services->id, 
                        'service_type_id' => $service_data->service_type_id,
                        'wallet_condition_id' => null,
                        'pr_details_id' => $service_data->pr_wallet_id ,
                        'ir_details_id' =>  $service_data->ir_wallet_id,
                        'service_gateway_id' => $service_data->service_gateway,
                        'service_group_id' => $service_data->service_group_id,
                        'assign_approver_id' => '1',
                        'service_template' => $service_template, 
                        'require_approver' => true, 
                ]);  
                /**
                 * Inserting service matrix for retrieving the primary key of service 
                 */
                $service_matrix = ServiceMatrix::create([
                    'service_id' => $insert_services->id,
                    'created_by' => '1',
                    'updated_by' => '1',

                ]); 
                
                /**
                 * Inserting into service_amount_limit
                 */
                 
                $service_amount_limit = ServiceAmountLimit::create([ 
                    'service_id_amount'=> $insert_services->id,
                    'limit_minimum'=> $service_data->limit_minimum,
                    'limit_maximum'=> $service_data->limit_maximum,
                    'amount_per_day' => $service_data->amount_per_day, 
                    'amount_per_month' => $service_data->amount_per_month,
                    'amount_per_year' => $service_data->amount_per_year
                ]);

                /**
                 * Inserting into service_transaction_limit
                 */
                
                $service_transaction_limit = ServiceTransactionLimit::create([
                    'service_id_transaction' => $insert_services->id,
                    'limit_per_day' => $service_data->limit_per_day,
                    'limit_per_month' => $service_data->limit_per_month,
                    'limit_per_year' => $service_data->limit_per_year
                ]); 
                /**
                 * Insert rows in the table (values,source wallet, initiator wallet, rates table) 
                 */
                $sd_values = json_decode($service_data->sd_values, true);
                foreach($sd_values as $data){
                    $store = ValuesSourceDestinationRates::create([
                        'service_id' => $insert_services->id,
                        'service_value' => $data['service_value'],
                        'service_source_wallet' => 'initiatorwallet', 
                        'service_destination_wallet' => $data['service_destination_wallet'], 
                        'service_rate_table' => $data['service_rate_table']
                    ]);
                } 
                /**
                 * Inserting into service_and_servicetype table
                 */
               /* $service_and_st = ServiceAndServiceType::create([
                    'service_id' => $insert_services->id,
                    'service_type_id' => $service_data->service_type_id 
                ]);
               */
    }

    /**
     * @ Update Service Method
     *  
     **/
    public function UpdateServiceMethod($service_data){ 
                /**
                 * Service Template File Update
                 */
                $service_template = null; 
                $existing_service_template = $this->connection->table('services_basetable')
                                                ->where('service_id','=',$service_data->service_id)
                                                ->first();
                $get_service_template =  $existing_service_template->service_template;
                
                if($service_data->service_template !== 'empty'){ 
                    if($service_data->service_template !== $get_service_template){
                        $filename_with_extension_app = $service_data->service_template->getClientOriginalName();
                        $file_name = pathinfo($filename_with_extension_app, PATHINFO_FILENAME);
                        $service_template = time().'_'.$file_name.'.'.$service_data->service_template->getClientOriginalExtension();
                        $upload  = $service_data->service_template->storeAs('public/uploads/templates/services_template', $service_template);
                    }
                    else {
                        $service_template = $get_service_template;
                    }
                }
                /**
                 * Deleting existing vsdt
                 */
                $delete_vsdt = $this->connection->table('sd_wallet_service_set_up')->where('service_id','=',$service_data->service_id)->delete();
                
                /**
                 * Renewing the VSDT that comes from object in Array 
                 */ 
                  /**
                 * Insert rows in the table (values,source wallet, initiator wallet, rates table) 
                 */
                $sd_values = json_decode($service_data->sd_values, true);
                foreach($sd_values as $data){
                    $store = ValuesSourceDestinationRates::create([
                        'service_id' => $service_data->service_id,
                        'service_value' => $data['service_value'],
                        'service_source_wallet' => 'initiatorwallet', 
                        'service_destination_wallet' => $data['service_destination_wallet'], 
                        'service_rate_table' => $data['service_rate_table']
                    ]);
                }
    
                /**
                 * Updating Service 
                 */
                $insert_services = Services::where('id','=',$service_data->service_id)->update([
                            'service_code' => $service_data->service_code ,
                            'service_name' => $service_data->service_name,
                            'service_description' => $service_data->service_description,
                            's_wallet_type' =>  $service_data->wallet_type,
                            'wallet_condition' => $service_data->service_condition, 
                ]);  

                 /**
                 * Update Service Base Table
                 */
                $insert_services_basetable = ServicesBaseTable::where('service_id','=',$service_data->service_id)->update([ 
                    'service_type_id' => $service_data->service_type_id,
                    'wallet_condition_id' => null,
                    'pr_details_id' => $service_data->pr_wallet_id ,
                    'ir_details_id' =>  $service_data->ir_wallet_id,
                    'service_gateway_id' => $service_data->service_gateway,
                    'service_group_id' => $service_data->service_group_id,
                    'assign_approver_id' => '1',
                    'service_template' => $service_template, 
                    'require_approver' => true, 
                ]);  
                /**
                 * Updating into service_amount_limit
                 */
                
                $service_amount_limit = ServiceAmountLimit::where('service_id_amount','=',$service_data->service_id)->update([ 
                    'limit_minimum'=> $service_data->limit_minimum,
                    'limit_maximum'=> $service_data->limit_maximum,
                    'amount_per_day' => $service_data->amount_per_day, 
                    'amount_per_month' => $service_data->amount_per_month,
                    'amount_per_year' => $service_data->amount_per_year
                ]);

                /**
                 * Updating into service_transaction_limit
                 */
                
                $service_transaction_limit = ServiceTransactionLimit::where('service_id_transaction','=',$service_data->service_id)->update([
                    'limit_per_day' => $service_data->limit_per_day,
                    'limit_per_month' => $service_data->limit_per_month,
                    'limit_per_year' => $service_data->limit_per_year
                ]); 
                
    }

    /**
     * @ Insert Joint Services 
     **/
    public function InsertJointServices($service_data){
                $insert_services = Services::create([
                    'service_code' => $service_data->service_code,
                    'service_name' => $service_data->service_name,
                    'service_description' => $service_data->service_description,
                    's_wallet_type' =>  $service_data->wallet_type,
                    'wallet_condition' => 'joint', 
                ]);  

                // Store Service Type Details Basetable
                    $StoreServiceTypeDetailsBasetable = ServiceTypeDetailsBasetable::create([
                        'services_id' => $insert_services->id,
                        'joint_services_id' => $insert_services->id,
                ]);
            
                foreach($service_data->joint_services as $data){
                    $store = JointService::create([
                        'main_service_id' => $insert_services->id,
                        'joint_service_id' => $data['service_id'],
                    ]);
                } 
    }

     /*
      * For searching/filling Service Type 
      */
    public function FillServiceTypeMethod($service_type_code){
                $service_type = DB::connection('mysql')
                        ->table('servicetypedetails')
                        ->where('st_code', '=', $service_type_code)
                        ->first();
                return $service_type;
    }
    public function FillPrAccountNameMethod($pr_wallet_acc_no){
        
                $account_name = DB::connection('mysql')
                                ->table('wallet_account')
                                ->where('wallet_account_no','=',$pr_wallet_acc_no)
                                ->first();
                                return $account_name;
    }
    /**
     * For searching/filling IR Account details
     */
    public function FillIrAccountNameMethod($ir_wallet_acc_no){
                $account_name = DB::connection('mysql')
                                ->table('wallet_account')
                                ->where('wallet_account_no','=',$ir_wallet_acc_no)
                                ->first();
                                return $account_name;
    }
    /**
     * Get services table
     * @return Services
     */
    public function GetAllServices(){

        $Services = [];
        /**
         * @ Get all Data From Service Type Details Basetable 
         **/
        $getservices_table = $this->connection
                        ->table('service_type_details_basetable')
                        ->join('services', 'service_type_details_basetable.services_id', '=', 'services.id')
                        ->get(); 
        /**
         * @ Get Service With Details 
         **/
        $get_service_with_details = $this->connection
                        ->table('service_type_details_basetable')
                            ->join('services', 'service_type_details_basetable.services_id', '=', 'services.id')
                            ->join('servicetypedetails', 'service_type_details_basetable.service_type_details_id', '=', 'servicetypedetails.id')
                        ->get(); 
        foreach($get_service_with_details as $test1){
            array_push($Services, $test1);
        }
        
        /**
         * @ Get Service with joint Service 
         **/
        $get_service_with_joint = $this->connection
                        ->table('service_type_details_basetable')
                        ->join('services', 'service_type_details_basetable.joint_services_id', '=', 'services.id')
                        ->get(); 

        foreach($get_service_with_joint as $test2){
            array_push($Services, $test2);
        }
    
        return $Services;
    }

    /**
     * @ Get a List of Services
     * @return  listServices
     **/
    public function ListOfServices(){
        $listServices = $this->connection
                        ->table('services')
                        ->join('services_basetable', 'services.id', '=', 'services_basetable.service_id')
                        ->join('wallet_account', 'services_basetable.pr_details_id', '=', 'wallet_account.id')
                        ->select(
                            'services.id',
                            'services.service_code',
                            'services.service_name',
                            'services.service_description',
                            'services.s_wallet_type',
                            'services.wallet_condition',
                            'wallet_account.wallet_account_no as rwan',
                            'wallet_account.wallet_account_name as rname'

                        )
                        ->paginate(10);
        return $listServices;
    }

    /**
     * @ Search list services
     * @return  searchlistServices
     **/
    public function searchListOfServices($query){
        $listServices = $this->connection
                        ->table('services')
                        ->join('services_basetable', 'services.id', '=', 'services_basetable.service_id')
                        ->join('wallet_account', 'services_basetable.pr_details_id', '=', 'wallet_account.id')
                        ->select(
                            'services.id',
                            'services.service_code',
                            'services.service_name',
                            'services.service_description',
                            'services.s_wallet_type',
                            'services.wallet_condition',
                            'wallet_account.wallet_account_no as rwan',
                            'wallet_account.wallet_account_name as rname'

                        )
                        ->orWhere('services.service_code', 'LIKE', '%'.$query.'%')
                        ->orWhere('services.service_name', 'LIKE', '%'.$query.'%')
                        ->orWhere('services.service_description', 'LIKE', '%'.$query.'%')
                        ->orWhere('services.s_wallet_type', 'LIKE', '%'.$query.'%')
                        ->orWhere('services.service_code', 'LIKE', '%'.$query.'%')
                        ->orWhere('wallet_account.wallet_account_no', 'LIKE', '%'.$query.'%')
                        ->orWhere('wallet_account.wallet_account_name', 'LIKE', '%'.$query.'%')
                        ->paginate(10);
        return $listServices;
    }

    /**
     * @  Get Service Details
     * @return service_details
     **/
    public function GetServiceDetails($service_id){
                  $service_details = $this->connection
                                    ->table('services')
                                    ->join('services_basetable','services.id','services_basetable.service_id') 
                                    ->join('servicetypedetails','servicetypedetails.id','services_basetable.service_type_id')
                                    ->join('service_gateway','service_gateway.id','services_basetable.service_gateway_id')
                                    ->join('service_amount_limit','service_amount_limit.service_id_amount','services.id') 
                                    ->join('service_transaction_limit','service_transaction_limit.service_id_transaction','services.id')
                                    ->where('services.id','=',$service_id)
                                    ->get();
                  return $service_details;
    }   

    /**
     * @ Get Wallet Details
     * @return wallet_details 
     **/
    public function GetWalletDetails($id){
                   $wallet_details = $this->connection
                                    ->table('wallet_account')
                                    ->where('id','=',$id) 
                                    ->select('id','wallet_account_no','wallet_account_name')
                                    ->get();
                    return $wallet_details; 
    }

    /**
     * @GetVSDR
     * @return vsdr 
     **/
    public function GetVSDR($service_id){
                   $vsdr = $this->connection
                                    ->table('sd_wallet_service_set_up')
                                    ->where('service_id','=',$service_id)
                                    ->select('id','service_value','service_source_wallet','service_destination_wallet','service_rate_table')
                                    ->get();
                    return $vsdr;
    }

    /**
     * @ Joint service List
     * @return list_joint_services 
     **/
    public function JointServiceslist($id){
                    $list_joint_services = $this->connection
                                    ->table('joint_services') 
                                    ->join('services','services.id','=','joint_services.main_service_id')
                                    ->where('joint_services.main_service_id','=', $id)
                                    ->get();
                    return $list_joint_services;
    } 

    /**
     * @ Get Service Type Code
     * @return service_type_code 
     **/
    public function GetServiceTypeCode($id,$wallet_condition){
        if($wallet_condition === "solo"){
            $service_type_code = $this->connection 
                                ->table('services_basetable')
                                ->Join('servicetypedetails','servicetypedetails.id','=','services_basetable.service_type_id') 
                                ->where('services_basetable.service_id','=',$id)
                                ->select('st_code')
                                ->first();
        }
    
        return $service_type_code;
    }

    /**
     * @ search service 
     **/
    public function searchService($query)
    {
        
    }

}

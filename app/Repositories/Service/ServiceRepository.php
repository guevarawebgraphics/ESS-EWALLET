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


/**
 * Class ServiceRepository.
 */
class ServiceRepository
{
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
                /**
                 * Gets the service inserted and insert into wdetails table
                 */
                $wservice_id = $wservice->id;
                $wdetails = WDetails::create([
                    'wservice_id' =>  $wservice_id,
                    'pr_wdetails_id' => $service_data->pr_wallet_id , 
                    'ir_wdetails_id' => $service_data->ir_wallet_id ,
                ]);
                /**
                 * Inserting into service_and_servicetype table
                 */
                $service_and_st = ServiceAndServiceType::create([
                    'service_id' => $wservice_id,
                    'service_type_id' => $service_data->service_type_id 
                ]);  
                /**
                 * Inserting into service_amount_limit
                 */

                $service_amount_limit = ServiceAmountLimit::create([ 
                    'service_id_amount'=> $wservice_id,
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
                    'service_id_transaction' => $wservice_id,
                    'limit_per_day' => $service_data->limit_per_day,
                    'limit_per_month' => $service_data->limit_per_month,
                    'limit_per_year' => $service_data->limit_per_year
                ]);
                
                /**
                 * Inserting into Service Matrix
                 */ 
                $service_matrix = ServiceMatrix::create([
                    'service_id' => $wservice_id,
                    'created_by' => '1',
                    'updated_by' => '1',

                ]);
                
                return $wservice;
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
     */
    public function GetAllServices(){
                $getservicetable = DB::connection('mysql')
                                ->table('service_and_servicetype')
                                ->join('wservice','service_and_servicetype.service_id','=','wservice.id')
                                ->join('servicetypedetails','service_and_servicetype.service_type_id','=','servicetypedetails.id') 
                                ->join('wdetails','wdetails.wservice_id','=','service_and_servicetype.service_id') 
                                ->join('wallet_account','wallet_account.id','=','wdetails.pr_wdetails_id') // this is temporary
                                ->join('wallet_account_types','wallet_account_types.id','=','wservice.wallet_type_id')
                                ->get();
                                return $getservicetable;
    }   

}

<?php

namespace App\Repositories\Service;

use DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\Services\WService;
use App\Models\Services\WDetails;
use App\Models\Services\ServiceAndServiceType;


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
        $wservice = WService::create([
            'service_code'=> $service_data->service_code,
            'service_name'=> $service_data->service_name,
            'service_description' => $service_data->service_description,
            'service_gateway_id'=> $service_data->service_gateway, 
            'service_group_id'=> $service_data->service_group_id,
            'service_template' => "sameple.template",
        ]);
        $wservice_id = $wservice->id;
        $wdetails = WDetails::create([
            'wservice_id' =>  $wservice_id,
            'pr_wdetails_id' => $service_data->pr_wallet_id , 
            'ir_wdetails_id' => $service_data->ir_wallet_id ,
        ]);

        $service_and_st = ServiceAndServiceType::create([
            'service_id' => $wservice_id,
            'service_type_id' => $service_data->service_type_id 
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
                        ->get();
                        return $getservicetable;
    }   

}

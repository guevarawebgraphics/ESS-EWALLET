<?php

namespace App\Repositories\Service;

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
    public function InsertServiceMethod($service_data){
        $wservice = WService::create([
            'service_code'=> $service_data->service_code,
            'service_name'=> $service_data->service_name,
            'service_description' => $service_data->service_description,
            'service_gateway'=> $service_data->service_gateway,
            'service_template' => $service_data->service_template,
        ]);
        $wservice_id = $wservice->id;
        $wdetails = WDetails::create([
            'wservice_id' =>  $wservice_id,
            'pr_wallet_type' => $service_data->wallet_type,
            'pr_wallet_account_no'=> $service_data->pr_wallet_acc_no,
            'ir_wallet_account_no'=> $service_data->ir_wallet_acc_no,
            'ir_wallet_account_name' => $service_data->ir_wallet_acc_name,
        ]);

        $service_and_st = ServiceAndServiceType::create([
            'service_id' => $wservice_id,
            'service_type_id' => '1' //example
        ]); 
        return $wservice;
    }

}

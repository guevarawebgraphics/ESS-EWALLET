<?php

namespace App\Repositories\ServiceGateway;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\ServiceGateway\ServiceGateway;
use DB;
/**
 * Class ServiceGatewayRepository.
 */
class ServiceGatewayRepository 
{
    /**
     * @return string
     *  Return the model
     */
    public function CreateServiceGatewayMethod($gateway_data){
        $service_gate = ServiceGateway::create([
                'gateway_code' => $gateway_data['gateway_code'],
                'gateway_name' => $gateway_data['gateway_name'],
        ]);
        return $service_gate;
    }

    public function GetServiceGatewayMethod(){  
        $service_gateways = DB::connection('mysql')
                                ->table('service_gateway')
                                ->get();
        return $service_gateways;
    }
    public function UpdateServiceGatewayMethod($request,$gw_id){
        $update_gateway = DB::connection('mysql')
                            ->table('service_gateway')
                            ->where('id','=',$gw_id)
                            ->update(array(
                                    'gateway_code' => $request->gateway_code,
                                    'gateway_name' => $request->gateway_name,
                            ));

        return $update_gateway;
    }
}

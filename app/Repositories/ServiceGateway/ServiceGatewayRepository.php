<?php

namespace App\Repositories\ServiceGateway;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Models\ServiceGateway\ServiceGateway;
use DB;
use Keygen;
/**
 * Class ServiceGatewayRepository.
 */
class ServiceGatewayRepository 
{
    /**
     * @ connection 
     **/
    protected $connection;

    /**
     * @ constructor 
     **/
    public function __construct(){
        // Ess Connection
        $this->connection = DB::connection('mysql');
    }

    /**
     * @return string
     *  Return the model
     */
    public function CreateServiceGatewayMethod($gateway_data){
        $service_gate = ServiceGateway::create([
                'gateway_code' => $this->generateServiceGatewayCode(),
                'gateway_name' => $gateway_data['gateway_name'],
        ]);
        return $service_gate;
    }

    /**
     * getServiceGateway
     * @return ServiceGateway
     **/

    public function GetServiceGatewayMethod(){  
        $service_gateway = $this->connection
                                ->table('service_gateway')
                                ->get();
        return $service_gateway;
    }

    /**
     * @ Update Service Gateway
     * @return UpdatedGateway 
     **/
    public function UpdateServiceGatewayMethod($request,$gw_id){
        $update_gateway = $this->connection
                            ->table('service_gateway')
                            ->where('id','=',$gw_id)
                            ->update(array(
                                    'gateway_code' => $request->gateway_code,
                                    'gateway_name' => $request->gateway_name,
                            ));

        return $update_gateway;
    }


    /*****************************************************************************
     * Helpers Functions
     * Below Add Helpers Function
     * Securities
     **/

     /**
      * @ Generate Service Gateway Code
      * @return ServiceCode
      */
      public function generateServiceGatewayCode() {
        $gateway_code = $this->generateNO();          

        /**
         * @ Check if there is existing servie code
         * @ generate a new one if already exists 
         **/
        while(ServiceGateway::where('gateway_code', '=', $gateway_code)->count() > 0) {
            $gateway_code = $this->generateNO();
        }

        return $gateway_code;
      }

      /**
       * @ Generate No
       * @return generateNo 
       **/
      public function generateNO(){
        $gateway_code = Keygen::length(8)->numeric()->generate();

        return $gateway_code;
      }
}

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
    public function __construct()
    {
        // Ess Connection
        $this->connection = DB::connection('mysql');
    }

    /**
     * @return string
     *  Return the model
     */
    public function storeServiceGateway($gateway_data)
    {
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
    public function showServiceGateway()
    {  
        $service_gateway = $this->connection
                                ->table('service_gateway')
                                ->paginate(10);
        return $service_gateway;
    }

    /**
     * @ Update Service Gateway
     * @return UpdatedGateway 
     **/
    public function updateServiceGateway($request,$gw_id)
    {
        $update_gateway = $this->connection
                            ->table('service_gateway')
                            ->where('id','=',$gw_id)
                            ->update(array(
                                    'gateway_code' => $request->gateway_code,
                                    'gateway_name' => $request->gateway_name,
                            ));
        return $update_gateway;
    }

    /**
     * @ search Prepaid Service Gateway 
     **/
    public function searchServiceGateway($query)
    {
        $service_gateway = $this->connection
                        ->table('service_gateway')
                        ->orWhere('gateway_code', 'LIKE', '%'.$query.'%')
                        ->orWhere('gateway_name', 'LIKE', '%'.$query.'%')
                        ->paginate(10);
        return $service_gateway;
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
      public function generateServiceGatewayCode() 
      {
        $gateway_code = $this->generateNo();          

        /**
         * @ Check if there is existing servie code
         * @ generate a new one if already exists 
         **/
        while(ServiceGateway::where('gateway_code', '=', $gateway_code)->count() > 0) {
            $gateway_code = $this->generateNo();
        }

        return $gateway_code;
      }

      /**
       * @ Generate No
       * @return generateNo 
       **/
      public function generateNo(){
        $gateway_code = Keygen::length(8)->numeric()->generate();

        return $gateway_code;
      }
}

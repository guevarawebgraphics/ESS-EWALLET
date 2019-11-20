<?php

namespace App\Repositories\ServiceMatrix;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model
use DB;
use App\Models\ServiceMatrix\ServiceMatrix;
/**
 * Class ServiceMatrixRepository.
 */
class ServiceMatrixRepository
{
    /**
     * @ Connection 
     **/
    protected $connection;
    /**
     * @ constructor 
     **/
    public function __construct(){
        // E-Wallet
        $this->connection = DB::connection('mysql');
    }
    /**
     * @return string
     *  Store Service Matrix
     */
    public function StoreServiceMatrix($service_matrix_data){
        $user = auth('api')->user();
        foreach($service_matrix_data as $data){
            $service_matrix = $this->connection
                    ->table('service_matrix')
                    ->where('id', '=', $data['id'])
                    ->update(array(
                    // 'service_id' => 1,
                    // 'group_code_id' => 1,
                    'redeem' => 'test',
                    'admin' => $data['admin'],
                    // 'admin_some' => $data['admin_some'],
                    'merchant' => $data['merchant'],
                    // 'merchant_some' => $data['merchant_some'],
                    'branch' => $data['branch'],
                    // 'branch_some' => $data['branch_some'],
                    'agent' => $data['agent'],
                    // 'agent_some' => $data['agent_some'],
                    'created_by' => $user->id,
                    'updated_by' => $user->id
            ));
        }
        return $service_matrix_data;
    }

    /**
     * @ Get Services 
     **/
    public function GetServices(){
        $services = $this->connection
                     ->table('service_matrix')
                     ->join('wservice', 'service_matrix.service_id', '=', 'wservice.id')
                     ->join('service_and_servicetype', 'service_matrix.service_id', 'service_and_servicetype.service_id')
                     ->join('servicetypedetails', 'service_and_servicetype.service_type_id', '=', 'servicetypedetails.id')
                     ->join('service_grouping', 'wservice.service_group_id', '=', 'service_grouping.id')
                     ->select(
                         'service_matrix.id',
                         'wservice.service_name',
                         'servicetypedetails.st_name',
                         'service_grouping.group_description',
                         'service_matrix.admin',
                         //'service_matrix.admin_some',
                         'service_matrix.merchant',
                         //'service_matrix.merchant_some',
                         'service_matrix.branch',
                         //'service_matrix.branch_some',
                         'service_matrix.agent',
                         //'service_matrix.agent_some',
                     )
                     ->get();
        return $services;
    }
}

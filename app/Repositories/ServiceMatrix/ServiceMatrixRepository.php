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
                    'admin_all' => $data['admin_all'],
                    'admin_some' => $data['admin_some'],
                    'merchant_all' => $data['merchant_all'],
                    'merchant_some' => $data['merchant_some'],
                    'branch_all' => $data['branch_all'],
                    'branch_some' => $data['branch_some'],
                    'agent_all' => $data['agent_all'],
                    'agent_some' => $data['agent_some'],
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
                         'service_matrix.service_id',
                         'wservice.service_name',
                         'servicetypedetails.st_name',
                         'service_grouping.group_description',
                         'service_matrix.admin_all',
                         'service_matrix.admin_some',
                         'service_matrix.merchant_all',
                         'service_matrix.merchant_some',
                         'service_matrix.branch_all',
                         'service_matrix.branch_some',
                         'service_matrix.agent_all',
                         'service_matrix.agent_some',
                     )
                     ->get();
        return $services;
    }
}

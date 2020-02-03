<?php

namespace App\Repositories\ServiceMatrix;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model
use DB;
use App\Models\ServiceMatrix\ServiceMatrix;
use App\Models\WalletAccount\wallet_account;
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
    public function __construct()
    {
        // E-Wallet
        $this->connection = DB::connection('mysql');
    }
    /**
     * @return string
     *  Store Service Matrix
     */
    public function StoreServiceMatrix($service_matrix_data)
    {
        $user = auth('api')->user();
        foreach($service_matrix_data['data'] as $data){
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
    public function GetServices()
    {
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
                     ->paginate(10);
        return $services;
    }

    /**
     * @ Get Service Matrix
     * @return ServiceMatrix 
     **/
    public function GetServiceMatrix()
    {
        /**
         * @ Get Wallet Account Id
         * @return WalletAccountId 
         **/
        $wallet_account_id = wallet_account::where('ess_id', '=', auth('api')->user()->username)->select('id')->first();

        /**
         * @return ServiceMatrix 
         **/
        $ServiceMatrix = $this->connection
                            ->table('wallet_service_matrix_config')
                            ->join('wservice', 'wallet_service_matrix_config.service_id', '=', 'wservice.id')
                            ->join('service_and_servicetype', 'wallet_service_matrix_config.service_id', 'service_and_servicetype.service_id')
                            ->join('servicetypedetails', 'service_and_servicetype.service_type_id', '=', 'servicetypedetails.id')
                            ->join('service_grouping', 'wservice.service_group_id', '=', 'service_grouping.id')
                            ->select(
                                'wallet_service_matrix_config.id',
                                'wallet_service_matrix_config.service_id',
                                'wservice.service_name',
                                'servicetypedetails.st_name',
                                'service_grouping.group_description',
                                'wallet_service_matrix_config.admin_all',
                                'wallet_service_matrix_config.admin_some',
                                'wallet_service_matrix_config.merchant_all',
                                'wallet_service_matrix_config.merchant_some',
                                'wallet_service_matrix_config.branch_all',
                                'wallet_service_matrix_config.branch_some',
                                'wallet_service_matrix_config.agent_all',
                                'wallet_service_matrix_config.agent_some',
                            )
                            ->where('wallet_service_matrix_config.wallet_account_id' , '=', $wallet_account_id->id)
                            ->get();
        return $ServiceMatrix;
    }

    /**
     * @ search service matrix 
     **/
    public function searchServiceMatrix($query)
    {
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
                    ->orWhere('servicetypedetails.st_name', 'LIKE', '%'.$query.'%')
                    ->orWhere('wservice.service_name', 'LIKE', '%'.$query.'%')
                    ->orWhere('service_grouping.group_description', 'LIKE', '%'.$query.'%')
                    ->paginate(10);
        return $services;
    }
}

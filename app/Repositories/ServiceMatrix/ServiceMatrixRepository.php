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
     * @return string
     *  Store Service Matrix
     */
    public function StoreServiceMatrix($service_matrix_data){
        $user = auth('api')->user();
        $service_matrix = ServiceMatrix::create([
            'service_id' => 1,
            'group_code_id' => 1,
            'redeem' => 'test',
            'admin_all' => $service_matrix_data->admin_all,
            'admin_some' => $service_matrix_data->admin_some,
            'merchant_all' => $service_matrix_data->merchant_all,
            'merchant_some' => $service_matrix_data->merchant_some,
            'branch_all' => $service_matrix_data->branch_all,
            'branch_some' => $service_matrix_data->branch_some,
            'agent_all' => $service_matrix_data->agent_all,
            'agent_some' => $service_matrix_data->agent_some,
            'created_by' => 1,
            'updated_by' => 1
        ]);
        return $service_matrix;
    }
}

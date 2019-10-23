<?php

namespace App\Repositories\ServiceMatrix;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model
use DB;
use App\Models\ServiceMatrix\ServiceGroup;

/**
 * Class ServiceGroupRepository.
 */
class ServiceGroupRepository
{
    /**
     * Get All Service group 
     **/
    public function get_all_service(){
        $service_group = ServiceGroup::select('id', 'group_code', 'group_description')->get();
        return $service_group;
    }

    /**
     * @return string
     * Store Service Group
     */
    public function store_service_group($servicedata){
        $user = auth('api')->user();
        $service_group = ServiceGroup::create([
            'group_code' => $servicedata->group_code,
            'group_description' => $servicedata->group_description,
            'created_by' => $user->id,
            'updated_by' => $user->id
        ]);
        return $service_group;
    }

    /**
     * Update Service Group
     **/
    public function update_service_group($servicedata, $id){
        $user = auth('api')->user();
        $service_group = ServiceGroup::where('created_by', '=', $user->id)
            ->where('id', '=', $id)
            ->update([
            'group_code' => $servicedata->group_code,
            'group_description' => $servicedata->group_description,
            'created_by' => $user->id,
            'updated_by' => $user->id
        ]);
        return $service_group;
    }

}

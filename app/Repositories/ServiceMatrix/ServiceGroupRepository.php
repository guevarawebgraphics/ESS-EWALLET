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
    public function GetAllService(){
        $service_group = ServiceGroup::select('id', 'group_code', 'group_description')->orderBy('created_at', 'DESC')->get();
        return $service_group;
    }

    /**
     * @return string
     * Store Service Group
     */
    public function StoreServiceGroup($servicedata){
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
    public function UpdateServiceGroup($servicedata, $id){
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

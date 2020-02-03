<?php

namespace App\Repositories\ServiceMatrix;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model
use DB;
use Keygen;
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
        $service_group = ServiceGroup::select('id', 'group_code', 'group_description')
                            ->latest()
                            ->paginate(10);
        return $service_group;
    }

    /**
     * @return string
     * Store Service Group
     */
    public function StoreServiceGroup($servicedata){
        $user = auth('api')->user();
        $service_group = ServiceGroup::create([
            'group_code' => $this->generate_group_code(),
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
            //'group_code' => $servicedata->group_code,
            'group_description' => $servicedata->group_description,
            'created_by' => $user->id,
            'updated_by' => $user->id
        ]);
        return $service_group;
    }

    /**
     * @ search service group 
     **/
    public function searchServiceGroup($query)
    {
        $service_group = ServiceGroup::select('id', 'group_code', 'group_description')
                            ->orWhere('group_code', 'LIKE', '%'.$query.'%')
                            ->orWhere('group_description', 'LIKE', '%'.$query.'%')
                            ->latest()
                            ->paginate();
        return $service_group;
    }


    /***********************************************************************************
     * Helpers Functions
     * Below Add Helpers Function
     * Securities
     ***********************************************************************************/
    
     /**
      * @ Generate Group Code
      * @return 
      */
      public function generate_group_code(){
        $group_no = $this->generate_no();

        /**
         * @ Check if thereis existing group code
         * @ generate a new one if already exists 
         **/
        while(ServiceGroup::where('group_code', '=', $group_no)->count() > 0){
            $group_no = $this->generate_no();
        }
        
        return $group_no;
      }

      /**
       * @ Generate No
       * @return generate_no 
       **/
      public function generate_no(){
          $group_no = Keygen::length(8)->numeric()->prefix('SGC-', false)->generate();

          return $group_no;
      }
}

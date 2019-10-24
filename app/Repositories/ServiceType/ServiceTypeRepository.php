<?php

namespace App\Repositories\ServiceType;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

use Illuminate\Http\Request; 
use DB; 
use App\Models\ServiceType\ServiceTypeDetails; 
use App\Models\ServiceType\STBehavior;
/**
 * Class ServiceTypeRepository.
 */
class ServiceTypeRepository 
{
   /**
     * @return string
     * @ mysql (E-Wallet Database)
     * @ get service type table
     */  
    public function get_service_type_table(){
                $servicetype_table = DB::connection('mysql')
                                        ->table('servicetypedetails')
                                        ->select('id',
                                                 'st_code',
                                                 'st_name',
                                                 'st_description')
                                        ->get();
                                        return $servicetype_table;
                } 
       /**
         * @return string
         * @ mysql (E-Wallet Database)
         * @ get service details and behavior
        */  
    public function get_service_details_and_behavior($st_id){ 
               $user = auth('api')->user();
                $behavior_details = DB::connection('mysql') 
                                        ->table('servicetypedetails')
                                        ->join('stbehavior','servicetypedetails.id','=','stbehavior.st_id')
                                        ->where('stbehavior.st_id','=',$st_id)
                                        ->first();  
                                        return $behavior_details;
    }
    public function update_service_details_and_behavior($stdata,$st_id){ 
                $user = auth('api')->user();
                $update_details = DB::connection('mysql') 
                                        ->table('servicetypedetails')->where('id','=',$st_id)
                                        ->update(array(
                                                'st_name' => $stdata->service_name,
                                                'st_description' =>  $stdata->service_description
                                        )); 

                $update_behavior = DB::connection('mysql') 
                                        ->table('stbehavior')->where('st_id','=',$st_id)
                                        ->update(array(
                                                'added_ssw_sdw' => $stdata->added_ssw_sdw,
                                                'added_ssw_mdw' => $stdata->added_ssw_mdw,
                                                'added_msw_sdw' => $stdata->added_msw_sdw,
                                                'added_msw_mdw' => $stdata->added_msw_mdw,
                                                'deducted_sdw_ssw' => $stdata->deducted_sdw_ssw,
                                                'deducted_sdw_msw' => $stdata->deducted_sdw_msw,
                                                'deducted_mdw_ssw' => $stdata->deducted_mdw_ssw,
                                                'deducted_mdw_msw' => $stdata->deducted_mdw_msw
                                        ));
                                        return $update_behavior;
                                 

              }
     public function create_service_type($service_type_data){ 
            $user = auth('api')->user();
            $service_details = ServiceTypeDetails::create([
                'st_code' => $service_type_data->servicetype_code,
                'st_name' => $service_type_data->servicetype_name,
                'st_description' => $service_type_data->servicetype_description
            ]); 
            $st_id = $service_details->id;
            $service_group = STBehavior::create([
                'st_id' => $st_id,
                'st_code' => $service_type_data->servicetype_code,
                'added_ssw_sdw' => $service_type_data->added_ssw_sdw,
                'added_ssw_mdw' => $service_type_data->added_ssw_mdw,
                'added_msw_sdw' => $service_type_data->added_msw_sdw,
                'added_msw_mdw' => $service_type_data->added_msw_mdw,
                'deducted_sdw_ssw' => $service_type_data->deducted_sdw_ssw,
                'deducted_sdw_msw' => $service_type_data->deducted_sdw_msw,
                'deducted_mdw_ssw' => $service_type_data->deducted_mdw_ssw,
                'deducted_mdw_msw' => $service_type_data->deducted_mdw_msw
            ]);
            return $service_group;

                                         

     }


}

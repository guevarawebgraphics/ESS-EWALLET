<?php

namespace App\Repositories\ServiceType;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

use Illuminate\Http\Request; 
use DB;
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
                $behavior_details = DB::connection('mysql') 
                                        ->table('servicetypedetails')
                                        ->join('stbehavior','servicetypedetails.id','=','stbehavior.st_id')
                                        ->where('stbehavior.st_id','=',$st_id)
                                        ->first();  
                                        return $behavior_details;
    }
    public function update_service_details_and_behavior($st_id){
                $update_details = DB::connection('mysql') 
                                        ->table('servicetypedetails')->where('id','=',$st_id)
                                        ->update(array(
                                                'st_name' => "test",
                                                'st_description' => "test"
                                        )); 
                $update_behavior = DB::connection('mysql') 
                                        ->table('stbehavior')->where('st_id','=',$st_id)
                                        ->update(array(
                                                'added_ssw_sdw' => 0,
                                                'added_ssw_mdw' => 0,
                                                'added_msw_sdw' => 0,
                                                'added_msw_mdw' => 0,
                                                'deducted_sdw_ssw' => 0,
                                                'deducted_sdw_msw' => 0,
                                                'deducted_mdw_ssw' => 0,
                                                'deducted_mdw_msw' => 0
                                        ));

              }

}

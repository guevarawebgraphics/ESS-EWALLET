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

}

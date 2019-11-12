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
                                             /*   'added_ssw_sdw' => $stdata->added_ssw_sdw,
                                                'added_ssw_mdw' => $stdata->added_ssw_mdw,
                                                'added_msw_sdw' => $stdata->added_msw_sdw,
                                                'added_msw_mdw' => $stdata->added_msw_mdw,
                                                'deducted_sdw_ssw' => $stdata->deducted_sdw_ssw,
                                                'deducted_sdw_msw' => $stdata->deducted_sdw_msw,
                                                'deducted_mdw_ssw' => $stdata->deducted_mdw_ssw,
                                                'deducted_mdw_msw' => $stdata->deducted_mdw_msw*/
                                                'behavior_value' => $stdata->behavior_value,
                                        ));
                                        return $update_behavior;
                                 

              }
     public function create_service_type($service_type_data){  
                $user = auth('api')->user();  
                /**
                 * Get the acknowledgement_template file 
                 */
                //gets the original file name
                $filename_with_extension = $service_type_data->file_acknowledgement_template->getClientOriginalName();
                //gets the original file name except the extension
                $file_name = pathinfo($filename_with_extension, PATHINFO_FILENAME);
                $acknowledgement_template = time().'_'.$file_name.'.'.$service_type_data->file_acknowledgement_template->getClientOriginalExtension();
                //$service_type_data->file_acknowledgement_template->move(public_path('uploads/templates'), $acknowledgement_template);
                $upload = $service_type_data->acknowledgement_template->storeAs('public/uploads/templates/acknowledgement_template', $acknowledgement_template);
                /**
                 * Get the approval_template file
                 */
                $service_details = ServiceTypeDetails::create([
                    'st_code' => $service_type_data->servicetype_code,
                    'st_name' => $service_type_data->servicetype_name,
                    'st_description' => $service_type_data->servicetype_description,
                    'acknowledgement_template' => $acknowledgement_template,
                    'approval_template' => "123",
                    'confirmation_template' => "123"
                ]); 
                $st_id = $service_details->id; 

                $service_group = STBehavior::create([
                    'st_id' => $st_id,
                    'st_code' => $service_type_data->servicetype_code,
                    'behavior_value' => $service_type_data->behavior_value,
                /*  'added_ssw_sdw' => $service_type_data->added_ssw_sdw,
                    'added_ssw_mdw' => $service_type_data->added_ssw_mdw,
                    'added_msw_sdw' => $service_type_data->added_msw_sdw,
                    'added_msw_mdw' => $service_type_data->added_msw_mdw,
                    'deducted_sdw_ssw' => $service_type_data->deducted_sdw_ssw,
                    'deducted_sdw_msw' => $service_type_data->deducted_sdw_msw,
                    'deducted_mdw_ssw' => $service_type_data->deducted_mdw_ssw,
                    'deducted_mdw_msw' => $service_type_data->deducted_mdw_msw*/
                ]);
                return $service_group;
                    
     } 
     /**
      * Update Service Type show the services that used this service type
      */
     public function show_belong_services($st_id){
                $show_services = DB::connection('mysql')
                                    ->table('service_and_servicetype')
                                    ->join('wservice','wservice.id','=','service_and_servicetype.service_id') 
                                    ->join('service_gateway','wservice.service_gateway_id','=','service_gateway.id')
                                    ->where('service_and_servicetype.service_type_id','=',$st_id)
                                    ->select('wservice.service_code','wservice.service_name','service_gateway.gateway_name')
                                    ->get();
                return $show_services;
     }


}

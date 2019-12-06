<?php

namespace App\Repositories\ServiceType;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

use Illuminate\Http\Request;  
use Illuminate\Support\Facades\Storage;  
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
    public function update_service_type_templates($service_type_data){ 
              
                /**
                 * Declaration of Variables (Important)
                 */
                $acknowledgement_template_get = DB::connection('mysql')->table('servicetypedetails')
                                        ->where('id','=',$service_type_data->id)
                                        ->select('acknowledgement_template')
                                        ->first();
                $acknowledgement_template = $acknowledgement_template_get->acknowledgement_template;

                $approval_template_get = DB::connection('mysql')->table('servicetypedetails')
                                        ->where('id','=',$service_type_data->id) 
                                        ->select('approval_template')
                                        ->first();
                $approval_template = $approval_template_get->approval_template;

                $confirmation_template_get = DB::connection('mysql')->table('servicetypedetails')
                                        ->where('id','=',$service_type_data->id)
                                        ->select('confirmation_template')
                                        ->first();
                $confirmation_template = $confirmation_template_get->confirmation_template;

                if($service_type_data->file_acknowledgement_template != "null"){
                    if($service_type_data->file_acknowledgement_template != $acknowledgement_template){
                        $filename_with_extension_ack = $service_type_data->file_acknowledgement_template->getClientOriginalName(); /**Whole File Name w/ ext.*/
                        $file_name_ack = pathinfo($filename_with_extension_ack, PATHINFO_FILENAME); /**Actual File Name */ 
                        Storage::delete('public/uploads/templates/acknowledgement_template/'.$acknowledgement_template); /** Delete old file */
                        $acknowledgement_template = time().'_'.$file_name_ack.'.'.$service_type_data->file_acknowledgement_template->getClientOriginalExtension();
                        $upload_ack = $service_type_data->file_acknowledgement_template->storeAs('public/uploads/templates/acknowledgement_template', $acknowledgement_template);    
                    }
                }
                if($service_type_data->file_approval_template != "null"){
                    if($service_type_data->file_approval_template != $approval_template){
                        $filename_with_extension_app = $service_type_data->file_approval_template->getClientOriginalName();
                        $file_name_app = pathinfo($filename_with_extension_app, PATHINFO_FILENAME);
                        Storage::delete('public/uploads/templates/approval_template/'.$approval_template); 
                        $approval_template = time().'_'.$file_name_app.'.'.$service_type_data->file_approval_template->getClientOriginalExtension();
                        $upload_app = $service_type_data->file_approval_template->storeAs('public/uploads/templates/approval_template', $approval_template);     
                    } 
                }
                if($service_type_data->file_confirmation_template != "null"){
                    if($service_type_data->file_confirmation_template != $confirmation_template){
                        $filename_with_extension_con = $service_type_data->file_confirmation_template->getClientOriginalName();
                        $file_name_con = pathinfo($filename_with_extension_con, PATHINFO_FILENAME);
                        Storage::delete('public/uploads/templates/confirmation_template/'.$confirmation_template);
                        $confirmation_template = time().'_'.$file_name_con.'.'.$service_type_data->file_confirmation_template->getClientOriginalExtension();
                        $upload_con = $service_type_data->file_confirmation_template->storeAs('public/uploads/templates/confirmation_template', $confirmation_template);    
                    }
                }
     
                $update_template = DB::connection('mysql') 
                ->table('servicetypedetails')->where('id','=',$service_type_data->id)
                ->update(array(
                        'acknowledgement_template' => $acknowledgement_template, 
                        'approval_template' =>  $approval_template,
                        'confirmation_template' => $confirmation_template 
                ));
                return $update_template;
    }
    public function create_service_type($service_type_data){  
                $user = auth('api')->user();   
                /**
                 * Declaration of Variables (Important)
                 */
                $acknowledgement_template = null; 
                $approval_template = null; 
                $confirmation_template = null;
                /**
                 * Get the acknowledgement_template file 
                 */
                //gets the original file name 
                if($service_type_data->file_acknowledgement_template !== 'empty'){
                    $filename_with_extension_ack = $service_type_data->file_acknowledgement_template->getClientOriginalName(); /**Whole File Name w/ ext.*/
                    $file_name_ack = pathinfo($filename_with_extension_ack, PATHINFO_FILENAME); /**Actual File Name */
                    $acknowledgement_template = time().'_'.$file_name_ack.'.'.$service_type_data->file_acknowledgement_template->getClientOriginalExtension();
                    $upload_ack = $service_type_data->file_acknowledgement_template->storeAs('public/uploads/templates/acknowledgement_template', $acknowledgement_template);    
                }
     
                /**
                 * Get the approval_template file
                 */
                //gets the original file name
                if($service_type_data->file_approval_template !== 'empty'){
                    $filename_with_extension_app = $service_type_data->file_approval_template->getClientOriginalName();
                    $file_name_app = pathinfo($filename_with_extension_app, PATHINFO_FILENAME);
                    $approval_template = time().'_'.$file_name_app.'.'.$service_type_data->file_approval_template->getClientOriginalExtension();
                    $upload_app = $service_type_data->file_approval_template->storeAs('public/uploads/templates/approval_template', $approval_template);   
                }

                /**
                 * Get the confirmation_template file
                 */ 
                if($service_type_data->file_confirmation_template !== 'empty'){
                    $filename_with_extension_con = $service_type_data->file_confirmation_template->getClientOriginalName();
                    $file_name_con = pathinfo($filename_with_extension_con, PATHINFO_FILENAME);
                    $confirmation_template = time().'_'.$file_name_app.'.'.$service_type_data->file_confirmation_template->getClientOriginalExtension();
                    $upload_con = $service_type_data->file_confirmation_template->storeAs('public/uploads/templates/confirmation_template', $confirmation_template);    
                }

                /**
                 * Saving into servicetypedetails 
                 */
                $service_details = ServiceTypeDetails::create([
                    'st_code' => $service_type_data->servicetype_code,
                    'st_name' => $service_type_data->servicetype_name,
                    'st_description' => $service_type_data->servicetype_description,
                    'acknowledgement_template' => $acknowledgement_template,
                    'approval_template' => $approval_template,
                    'confirmation_template' => $confirmation_template
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
                                    ->table('services_basetable')
                                    ->join('services','services.id','=','services_basetable.service_id') 
                                    ->join('service_gateway','services_basetable.service_gateway_id','=','service_gateway.id')
                                    ->where('services_basetable.service_type_id','=',$st_id)
                                    ->select('services.service_code','services.service_name','service_gateway.gateway_name')
                                    ->get();
                return $show_services;
     }


}

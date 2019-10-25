<?php

namespace App\Http\Controllers\Api\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Service\ServiceRepository; 
/**
 * Service Module For Create 
 * Validation & other method SOON***
 */
class ServiceController extends Controller
{
    protected $services; 
    public function __construct(ServiceRepository $ServiceRepository){
        $this->services =  $ServiceRepository; 
        $this->middleware('auth:api');
    }
    /**
     * For inserting Service , Wallet Details and Service & Service Type ID
     */
    public function InsertService(Request $request){
        $InsertService = $this->services->InsertServiceMethod($request);
        return response()->json([
            'status' => 'success'
        ]);    
    }

}

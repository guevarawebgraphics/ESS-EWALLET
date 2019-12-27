<?php

namespace App\Repositories\Trasanction;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model
use DB;
use App\Models\Transaction\Prefund;

/**
 * Class PrefundRepository.
 */
class PrefundRepository
{
    /**
     * @ Connection 
     **/
    protected $connection;
    /**
     * @ Constructor 
     **/
    public function __construct(){
        // E-Wallet
        $this->connection = DB::connection('mysql');
    }

    /**
     * @ Store Prefund 
     **/
    public function StorePrefund($prefund_data){
        $user = auth('api')->user();
        /**
         * @ Handle File Upload 
         **/
         //gets the original file name
         $depositSlip_ext = $prefund_data->depositSlip->getClientOriginalName();
         //gets the original file name except the extension
         $depositSlip_filename = pathinfo($depositSlip_ext, PATHINFO_FILENAME);
         $depositSlip_file = time().'_'.$depositSlip_filename.'.'.$prefund_data->depositSlip->getClientOriginalExtension();
         // Store File
         $depositSlip = $prefund_data->depositSlip->storeAs('public/wallet_account_files/kyc_form', $kyc_form_file);

        $prefund = Prefund::create([
                'prefund_amount' => $prefund->prefund_amount,
                'name_of_bank' => $prefund->prefund_amount,
                'branch' => $prefund->prefund_amount,
                'account_type' => $prefund->account_type,
                'account_name' => $prefund->account_name,
                'account_no' => $prefund->account_no,
                'remarks' => 'remarks',
                'created_by' => $user->id,
                'updated_by' => $user->id
        ]);
        return $prefund;
    }
}

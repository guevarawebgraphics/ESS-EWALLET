<?php

namespace App\Repositories\Transaction;

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
    private $user;
    /**
     * @ Constructor 
     **/
    public function __construct()
    {
        // E-Wallet
        $this->connection = DB::connection('mysql');
        $this->user = auth('api')->user();
    }

    /**
     * @ Store Prefund 
     **/
    public function storePrefund($prefund_data)
    {
        $user = auth('api')->user();
        /**
         * @ Handle File Upload 
         **/
         if($prefund_data->depositSlip) {
             //gets the original file name
            $depositSlip_ext = $prefund_data->depositSlip->getClientOriginalName();
            //gets the original file name except the extension
            $depositSlip_filename = pathinfo($depositSlip_ext, PATHINFO_FILENAME);
            $depositSlip_file = time().'_'.$depositSlip_filename.'.'.$prefund_data->depositSlip->getClientOriginalExtension();
            // Store File
            $depositSlip = $prefund_data->depositSlip->storeAs('public/wallet_account_files/kyc_form', $depositSlip_file);
            
         }

        // Store Prefund Data
        $prefund = Prefund::create([
            'wallet_id' => $prefund_data->walletId,
            'prefund_amount' => $prefund_data->prefundAmount,
            'name_of_bank' => $prefund_data->nameofbank,
            'branch' => $prefund_data->branch,
            'account_type' => $prefund_data->accountType,
            'account_name' => $prefund_data->accountName,
            'account_no' => $prefund_data->accountNo,
            'deposit_slip' => ($prefund_data->depositSlip ? $depositSlip_filename : 'none' ),
            'remarks' => 'remarks',
            'transaction_type' => 'Prefund',
            'created_by' => $user->id,
            'updated_by' => $user->id
        ]);
        return $prefund;
    }

    /**
     * Update Transaction Request 
     * @return updatePrefundStatus
     **/
    public function updatePrefundStatus($id)
    {
        $updatePrefundStatus = Prefund::where('id', '=', $id)->update(['transaction_status' => 1]);
        return $updatePrefundStatus;
    }
}

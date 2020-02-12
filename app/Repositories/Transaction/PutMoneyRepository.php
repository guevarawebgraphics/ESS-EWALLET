<?php

namespace App\Repositories\Transaction;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model
use DB;
use App\Models\Transaction\PutMoney;

/**
 * Class PutMoneyRepository.
 */
class PutMoneyRepository
{
    private $user;

    /**
     * @ Constructor 
     **/
    public function __construct()
    {
        $this->user = auth('api')->user();
    }

    /**
     * @ Show Put Money 
     * @return putMoney
     **/
    public function storePutMoney($putMoney_data)
    {
        /**
         * @ Handle File Upload 
         **/
        if($putMoney_data->depositSlip) {
            //gets the original file name
           $depositSlip_ext = $putMoney_data->depositSlip->getClientOriginalName();
           //gets the original file name except the extension
           $depositSlip_filename = pathinfo($depositSlip_ext, PATHINFO_FILENAME);
           $depositSlip_file = time().'_'.$depositSlip_filename.'.'.$putMoney_data->depositSlip->getClientOriginalExtension();
           // Store File
           $depositSlip = $putMoney_data->depositSlip->storeAs('public/wallet_account_files/put_money', $depositSlip_file);
        }

        // Store Put Money
        $putMoney = PutMoney::create([
            'wallet_id' => '1',
            'put_money_amount' => $putMoney_data->put_money_amount,
            'bank_name' => $putMoney_data->bank_name,
            'branch' => $putMoney_data->branch,
            'account_type' => $putMoney_data->accountType,
            'account_name' => $putMoney_data->accountName,
            'account_no' => $putMoney_data->accountNo,
            'deposit_slip' => ($putMoney_data->depositSlip ? $depositSlip_filename : 'none' ),
            'remarks' => 'remarks',
            'transaction_type' => 'PutMoney',
            'created_by' => $this->user->id,
            'updated_by' => $this->user->id
        ]);

        return $putMoney;
    }
}

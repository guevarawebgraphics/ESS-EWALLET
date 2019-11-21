<?php

namespace App\Repositories\WalletAccount;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model
use App\Models\WalletAccount\wallet_account;
use App\Models\WalletAccount\wallet_bank_account;
use App\Models\WalletAccount\wallet_amount_limits_config;
use App\Models\WalletAccount\wallet_amount_limits;
use App\Models\WalletAccount\wallet_limit_no_transaction_config;
use App\Models\WalletAccount\wallet_limit_no_transaction;
use App\Models\WalletAccount\wallet_service_matrix_config;

use DB;
use Carbon\Carbon;
/**
 * Class WalletAccountRepository.
 */
class WalletAccountRepository
{
    /**
     * @ connection 
     **/
    protected $connection;
    /**
     * @ constructor
     **/
    public function __construct(){
        // E-Wallet Connection
        $this->connection = DB::connection('mysql');
    }

    /**
     * @ Get All E-Wallet Account 
     **/
    public function GetAllWalletAccount(){
        $user = auth('api')->user();
        $wallet_account = $this->connection
                            ->table('wallet_account')
                            ->join('wallet_account_types', 'wallet_account.wallet_account_type', '=', 'wallet_account_types.id')
                            ->select(
                                'wallet_account.ess_id',
                                'wallet_account.wallet_type',
                                'wallet_account_types.wallet_account_type',
                                'wallet_account.wallet_account_no',
                                'wallet_account.wallet_account_name',
                                'wallet_account.status')
                            ->where('wallet_account.created_by', '=', $user->id)
                            ->orderBy('wallet_account.created_at', 'DESC')
                            ->get();
        return $wallet_account;
    }
    /**
     * @ Get Wallet Account Details 
     **/
    public function GetWalletAccountDetails($essid){
        $user = auth('api')->user();
        $wallet_account = $this->connection
                            ->table('wallet_account')
                            ->join('wallet_account_types', 'wallet_account.wallet_account_type', '=', 'wallet_account_types.id')
                            ->join('wallet_bank_account', 'wallet_account.id', '=', 'wallet_bank_account.wallet_account_id')
                            ->join('wallet_amount_limits_config', 'wallet_account.id', '=', 'wallet_amount_limits_config.wallet_account_id')
                            ->join('wallet_amount_limits', 'wallet_amount_limits_config.id', '=', 'wallet_amount_limits.wallet_amount_limits_config_id')
                            ->join('wallet_limit_no_transaction_config', 'wallet_account.id', '=', 'wallet_limit_no_transaction_config.wallet_account_id')
                            ->join('wallet_limit_no_transaction', 'wallet_limit_no_transaction_config.id', '=' , 'wallet_limit_no_transaction.wlnt_id')
                            ->select(
                                'wallet_account.id',
                                'wallet_account.wallet_account_type',
                                'wallet_account.wallet_type',
                                'wallet_amount_limits_config.amount_limit',
                                'wallet_amount_limits_config.am_per_transaction',
                                'wallet_amount_limits_config.am_per_day',
                                'wallet_amount_limits_config.am_per_month',
                                'wallet_amount_limits_config.am_per_year',
                                'wallet_amount_limits.am_minimum',
                                'wallet_amount_limits.am_maximum',
                                'wallet_amount_limits.am_transaction_minimum',
                                'wallet_amount_limits.am_transaction_maximum',
                                'wallet_amount_limits.am_day_minimum',
                                'wallet_amount_limits.am_day_maximum',
                                'wallet_amount_limits.am_month_minimum',
                                'wallet_amount_limits.am_month_maximum',
                                'wallet_amount_limits.am_year_minimum',
                                'wallet_amount_limits.am_year_maximum',
                                'wallet_limit_no_transaction_config.lm_per_day as c_lm_per_day',
                                'wallet_limit_no_transaction_config.lm_per_month as c_lm_per_month',
                                'wallet_limit_no_transaction_config.lm_per_year as c_lm_per_year',
                                'wallet_limit_no_transaction_config.allow_negative_balance as c_allow_negative_balance',
                                'wallet_limit_no_transaction_config.com_daily_balance as c_com_daily_balance',
                                'wallet_limit_no_transaction_config.com_daily_usage as c_com_daily_usage',
                                'wallet_limit_no_transaction.lm_per_day',
                                'wallet_limit_no_transaction.lm_per_month',
                                'wallet_limit_no_transaction.lm_per_year',
                                'wallet_limit_no_transaction.allow_negative_balance',
                                'wallet_bank_account.bank_name',
                                'wallet_bank_account.branch',
                                'wallet_bank_account.account_type',
                                'wallet_bank_account.account_name',
                                'wallet_bank_account.account_no',
                                'wallet_bank_account.status'
                                )
                            ->where('wallet_account.ess_id', '=', $essid)
                            ->get();
        return $wallet_account;
    }
    /**
     * @return string
     *  Store Wallet Account
     */
    public function StoreWalletAccount($wallet_account_data){
        $user = auth('api')->user();
        /**
         * @ Handle File Upload 
         **/
         //gets the original file name
         $kyc_form_ext = $wallet_account_data->kyc_form->getClientOriginalName();
         $valid_id_ext = $wallet_account_data->valid_id->getClientOriginalName();
         //gets the original file name except the extension
         $kyc_form_filename = pathinfo($kyc_form_ext, PATHINFO_FILENAME);
         $valid_id_name = pathinfo($valid_id_ext, PATHINFO_FILENAME);
         $kyc_form_file = time().'_'.$kyc_form_filename.'.'.$wallet_account_data->kyc_form->getClientOriginalExtension();
         $valid_id_file = time().'_'.$valid_id_name.'.'.$wallet_account_data->valid_id->getClientOriginalExtension();
         // Store File
         $kyc_form = $wallet_account_data->kyc_form->storeAs('public/wallet_account_files/kyc_form', $kyc_form_file);
         $valid_id = $wallet_account_data->valid_id->storeAs('public/wallet_account_files/valid_id', $valid_id_file);
        // Store to Wallet Account
        $wallet_account = wallet_account::create([
                            'ess_id' => $wallet_account_data->username,
                            'wallet_type' => $wallet_account_data->WalletType,
                            'wallet_account_type' => $wallet_account_data->WalletAccountType,
                            'wallet_account_no' => $wallet_account_data->WalletAccountNo,
                            'wallet_account_name' => $wallet_account_data->WalletAccountName,
                            'wallet_title' => $wallet_account_data->Wallettitle,
                            'kyc_form' => $kyc_form,
                            'valid_id'=> $valid_id_file,
                            'status' => true,
                            'created_by' => $user->id,
                            'updated_by' => $user->id,
                        ]);
        // Store to Wallet Bank Account
        $wallet_account_bank = wallet_bank_account::create([
                                    'wallet_account_id' => $wallet_account->id,
                                    'branch' => $wallet_account_data->Branch,
                                    'bank_name' => $wallet_account_data->bank_name,
                                    'account_type' => $wallet_account_data->account_type,
                                    'account_name' => $wallet_account_data->account_name,
                                    'account_no' => $wallet_account_data->account_no,
                                    'status' => true,
                                    'created_by' => $user->id,
                                    'updated_by' => $user->id,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now()
                                ]);
        // Store Wallet ammount limits config
        $wallet_amount_limits_config = wallet_amount_limits_config::create([
                                            'wallet_account_id' => $wallet_account->id,
                                            'amount_limit' => $wallet_account_data->amount_limit,
                                            'am_per_transaction' => $wallet_account_data->am_per_transaction,
                                            'am_per_day' => $wallet_account_data->am_per_day,
                                            'am_per_month' => $wallet_account_data->am_per_month,
                                            'am_per_year' => $wallet_account_data->am_per_year,
                                            'created_by' => $user->id,
                                            'updated_by' => $user->id,
                                            'created_at' => Carbon::now(),
                                            'updated_at' => Carbon::now()
                                        ]);
        // Store Wallet Amount Limits
        $wallet_ammount_limits = wallet_amount_limits::create([
                                    'wallet_amount_limits_config_id' => $wallet_amount_limits_config->id,
                                    'am_minimum' => $wallet_account_data->am_minimum,
                                    'am_maximum' => $wallet_account_data->am_maximum,
                                    'am_transaction_minimum' => $wallet_account_data->am_transaction_minimum,
                                    'am_transaction_maximum' => $wallet_account_data->am_transaction_maximum,
                                    'am_day_minimum' => $wallet_account_data->am_day_minimum,
                                    'am_day_maximum' => $wallet_account_data->am_day_maximum,
                                    'am_month_minimum' => $wallet_account_data->am_month_minimum,
                                    'am_month_maximum' => $wallet_account_data->am_month_maximum,
                                    'am_year_minimum' => $wallet_account_data->am_year_minimum,
                                    'am_year_maximum' => $wallet_account_data->am_year_maximum,
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now()
                                ]);
        // Store Wallet Limit no Transaction Config
        $wallet_limit_no_transaction_config = wallet_limit_no_transaction_config::create([
                                                'wallet_account_id' => $wallet_account->id,
                                                'lm_per_day' => $wallet_account_data->lm_per_day,
                                                'lm_per_month' => $wallet_account_data->lm_per_month,
                                                'lm_per_year' => $wallet_account_data->lm_per_year,
                                                'allow_negative_balance' => $wallet_account_data->allow_negative_balance,
                                                'com_daily_balance' => $wallet_account_data->c_com_daily_balance,
                                                'com_daily_usage' => $wallet_account_data->c_com_daily_usage,
                                                'created_by' => $user->id,
                                                'updated_by' => $user->id,
                                                'created_at' => Carbon::now(),
                                                'updated_at' => Carbon::now()

                                            ]);
        // Store Wallet Limit no Transaction
        $wallet_limit_no_transaction = wallet_limit_no_transaction::create([
                                        'wlnt_id' => $wallet_limit_no_transaction_config->id,
                                        'lm_per_day' => $wallet_account_data->c_lm_per_day,
                                        'lm_per_month' => $wallet_account_data->c_lm_per_month,
                                        'lm_per_year' => $wallet_account_data->c_lm_per_year,
                                        'allow_negative_balance' => $wallet_account_data->c_allow_negative_balance,
                                        'created_by' => $user->id,
                                        'updated_by' => $user->id,
                                        'created_at' => Carbon::now(),
                                        'updated_at' => Carbon::now()

                                     ]);

        return $wallet_account->id;
    }

    /**
     * @ Update Wallet Account
     **/
    public function UpdateWalletAccount($wallet_account_data){
        $user = auth('api')->user();
        // Wallet ID
        $wallet_id = wallet_account::where('ess_id', '=', $wallet_account_data->username)->first();
        // Update to Wallet Account
        $wallet_account = wallet_account::where('ess_id', '=', $wallet_account_data->username)
        ->update([
            'wallet_type' => $wallet_account_data->WalletType,
            'wallet_account_type' => $wallet_account_data->WalletAccountType,
            //'wallet_account_no' => $wallet_account_data->WalletAccountNo,
            'wallet_account_name' => $wallet_account_data->WalletAccountName,
            'wallet_title' => $wallet_account_data->Wallettitle,
        ]);

         // Update to Wallet Bank Account
         $wallet_account_bank = wallet_bank_account::where('wallet_account_id', '=', $wallet_id->id)
         ->update([
            'branch' => $wallet_account_data->Branch,
            'account_type' => $wallet_account_data->account_type,
            'account_name' => $wallet_account_data->account_name,
            'account_no' => $wallet_account_data->account_no,
            'updated_at' => Carbon::now()
        ]);

        // Update Wallet ammount limits config
        $wallet_amount_limits_config = wallet_amount_limits_config::where('wallet_account_id', '=', $wallet_id->id)
        ->update([
            'amount_limit' => $wallet_account_data->amount_limit,
            'am_per_transaction' => $wallet_account_data->am_per_transaction,
            'am_per_day' => $wallet_account_data->am_per_day,
            'am_per_month' => $wallet_account_data->am_per_month,
            'am_per_year' => $wallet_account_data->am_per_year,
            'updated_by' => $user->id,
            'updated_at' => Carbon::now()
            ]);
        $wallet_amount_limits_config_id = wallet_amount_limits_config::where('wallet_account_id', '=', $wallet_id->id)->first();
        // Update Wallet Amount Limits
        $wallet_ammount_limits = wallet_amount_limits::where('wallet_amount_limits_config_id', '=', $wallet_amount_limits_config_id->id)
        ->update([
            'am_minimum' => $wallet_account_data->am_minimum,
            'am_maximum' => $wallet_account_data->am_maximum,
            'am_transaction_minimum' => $wallet_account_data->am_transaction_minimum,
            'am_transaction_maximum' => $wallet_account_data->am_transaction_maximum,
            'am_day_minimum' => $wallet_account_data->am_day_minimum,
            'am_day_maximum' => $wallet_account_data->am_day_maximum,
            'am_month_minimum' => $wallet_account_data->am_month_minimum,
            'am_month_maximum' => $wallet_account_data->am_month_maximum,
            'am_year_minimum' => $wallet_account_data->am_year_minimum,
            'am_year_maximum' => $wallet_account_data->am_year_maximum,
            'updated_at' => Carbon::now()
        ]);

         // Update Wallet Limit no Transaction Config
         $wallet_limit_no_transaction_config = wallet_limit_no_transaction_config::where('wallet_account_id', '=', $wallet_id->id)
         ->update([
            'lm_per_day' => $wallet_account_data->c_lm_per_day,
            'lm_per_month' => $wallet_account_data->c_lm_per_month,
            'lm_per_year' => $wallet_account_data->c_lm_per_year,
            'allow_negative_balance' => $wallet_account_data->c_allow_negative_balance,
            'com_daily_balance' => $wallet_account_data->c_com_daily_balance,
            'com_daily_usage' => $wallet_account_data->c_com_daily_usage,
            'updated_by' => $user->id,
            'updated_at' => Carbon::now()

            ]);
        $wallet_limit_no_transaction_config_id = wallet_limit_no_transaction_config::where('wallet_account_id', '=', $wallet_id->id)->first();
        // Update Wallet Limit no Transaction
        $wallet_limit_no_transaction = wallet_limit_no_transaction::where('wlnt_id', '=', $wallet_limit_no_transaction_config_id->id)
        ->update([
            'lm_per_day' => $wallet_account_data->lm_per_day,
            'lm_per_month' => $wallet_account_data->lm_per_month,
            'lm_per_year' => $wallet_account_data->lm_per_year,
            'allow_negative_balance' => $wallet_account_data->allow_negative_balance,
            'updated_by' => $user->id,
            'updated_at' => Carbon::now()

        ]);

        return $wallet_account . $wallet_account_bank;
    }

    public function StoreServiceMatrixConfig($wallet_account_data, $wallet_account_id){
        // Store Wallet Account Service Matrix Config
        $user = auth('api')->user();
        foreach($wallet_account_data as $data){
            $wallet_service_matrix_config = wallet_service_matrix_config::create([
                                            'wallet_account_id' => $wallet_account_id,
                                            'service_id' => $data['service_id'],
                                            'admin' => $data['admin'],
                                            'merchant' => $data['merchant'],
                                            'branch' => $data['branch'],
                                            'agent' => $data['agent'],
                                            'created_by' => $user->id,
                                            'updated_by' => $user->id,
                                            'created_at' => Carbon::now(),
                                            'updated_at' => Carbon::now()
                                        ]);
        }
        return $wallet_service_matrix_config;
    }
    
}

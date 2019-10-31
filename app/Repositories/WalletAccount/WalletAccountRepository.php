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
    public function get_all_wallet_account(){
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
                            ->get();
        return $wallet_account;
    }
    /**
     * @return string
     *  Store Wallet Account
     */
    public function store_wallet_account($wallet_account_data){
        $user = auth('api')->user();
        // Store to Wallet Account
        $wallet_account = wallet_account::create([
                            'ess_id' => $wallet_account_data->username,
                            'wallet_type' => $wallet_account_data->WalletType,
                            'wallet_account_type' => $wallet_account_data->WalletAccountType,
                            'wallet_account_no' => $wallet_account_data->WalletAccountNo,
                            'wallet_account_name' => $wallet_account_data->WalletAccountName,
                            'wallet_title' => $wallet_account_data->Wallettitle,
                            'status' => true,
                            'created_by' => $user->id,
                            'updated_by' => $user->id,
                        ]);
        // Store to Wallet Bank Account
        $wallet_account_bank = wallet_bank_account::create([
                                    'wallet_account_id' => $wallet_account->id,
                                    'branch' => $wallet_account_data->Branch,
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
                                                'com_daily_balance' => $wallet_account_data->com_daily_balance,
                                                'com_daily_usage' => $wallet_account_data->com_daily_usage,
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

        return $wallet_account . $wallet_account_bank;
    }
}

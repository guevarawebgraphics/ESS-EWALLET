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
use App\Models\WalletAccount\wallet_joint_account;
use App\Models\WalletAccount\wallet_account_details;

use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
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
    public function __construct()
    {
        // E-Wallet Connection
        $this->connection = DB::connection('mysql');
    }

    /**
     * @ Get All E-Wallet Account 
     **/
    public function showAllWalletAccount()
    {
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
            // ->get();
            //->latest()
            ->paginate(10);
        return $wallet_account;
    }
    /**
     * @ Get Wallet Account Details 
     **/
    public function showWalletAccountDetails($essid)
    {
        $user = auth('api')->user();
        // Check if the user is admin
        if($user->user_type_id === 1) {
            $wallet_account = $this->connection
                ->table('wallet_account')
                ->join('wallet_account_types', 'wallet_account.wallet_account_type', '=', 'wallet_account_types.id')
                // /->join('wallet_bank_account', 'wallet_account.id', '=', 'wallet_bank_account.wallet_account_id')
                ->join('wallet_amount_limits_config', 'wallet_account.id', '=', 'wallet_amount_limits_config.wallet_account_id')
                ->join('wallet_amount_limits', 'wallet_amount_limits_config.id', '=', 'wallet_amount_limits.wallet_amount_limits_config_id')
                ->join('wallet_limit_no_transaction_config', 'wallet_account.id', '=', 'wallet_limit_no_transaction_config.wallet_account_id')
                ->join('wallet_limit_no_transaction', 'wallet_limit_no_transaction_config.id', '=' , 'wallet_limit_no_transaction.wlnt_id')
                ->join('wallet_account_details', 'wallet_account.id', '=', 'wallet_account_details.wallet_account_id')
                ->select(
                    'wallet_account.wallet_account_type',
                    'wallet_account.wallet_type',
                    'wallet_account.wallet_account_no as wan',
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
                    'wallet_account.kyc_form',
                    'wallet_account.valid_id',
                    'wallet_account_details.wallet_account_no as WalletAccountNoDetails',
                    'wallet_account_details.wallet_account_name as WalletAccountNameDetails',
                    'wallet_account.wallet_title'
                    )
                ->where('wallet_account.ess_id', '=', $essid)
                ->get();
        }
        else {
            $wallet_account = $this->connection
                ->table('wallet_account')
                ->join('wallet_account_types', 'wallet_account.wallet_account_type', '=', 'wallet_account_types.id')
                // /->join('wallet_bank_account', 'wallet_account.id', '=', 'wallet_bank_account.wallet_account_id')
                ->join('wallet_amount_limits_config', 'wallet_account.id', '=', 'wallet_amount_limits_config.wallet_account_id')
                ->join('wallet_amount_limits', 'wallet_amount_limits_config.id', '=', 'wallet_amount_limits.wallet_amount_limits_config_id')
                ->join('wallet_limit_no_transaction_config', 'wallet_account.id', '=', 'wallet_limit_no_transaction_config.wallet_account_id')
                ->join('wallet_limit_no_transaction', 'wallet_limit_no_transaction_config.id', '=' , 'wallet_limit_no_transaction.wlnt_id')
                ->join('wallet_account_details', 'wallet_account.id', '=', 'wallet_account_details.wallet_account_id')
                ->join('wallet_joint_account', 'wallet_joint_account.wallet_account_id', '=', 'wallet_account.id')
                ->select(
                    'wallet_account.wallet_account_type',
                    'wallet_account.wallet_type',
                    'wallet_account.wallet_account_no as wan',
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
                    // 'wallet_bank_account.bank_name',
                    // 'wallet_bank_account.branch',
                    // 'wallet_bank_account.account_type',
                    // 'wallet_bank_account.account_name',
                    // 'wallet_bank_account.account_no',
                    // 'wallet_bank_account.status',
                    'wallet_account.kyc_form',
                    'wallet_account.valid_id',
                    'wallet_account_details.wallet_account_no as WalletAccountNoDetails',
                    'wallet_account_details.wallet_account_name as WalletAccountNameDetails',
                    'wallet_joint_account.joint_wallet_account_no',
                    'wallet_account.wallet_title'
                    )
                ->where('wallet_account.ess_id', '=', $essid)
                ->get();
        }
        
        return $wallet_account;
    }
    /**
     * @ Get Wallet Bank Accounts 
     * @param essid
     **/
    public function showWalletBankAccount($essid)
    {
        $user = auth('api')->user();
        $wallet_account_id = wallet_account::where('ess_id', '=', $essid)->first();
        $wallet_account = wallet_bank_account::where('wallet_account_id', '=', $wallet_account_id->id)
            ->select(
                'id',
                'bank_name',
                'branch',
                'account_type',
                'account_name',
                'account_no',
                'default',
                'status'
                )
            ->get();
        return $wallet_account;
    }
    /**
     * @return string
     *  Store Wallet Account
     */
    public function storeWalletAccount($wallet_account_data)
    {
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
            'kyc_form' => $kyc_form_file,
            'valid_id'=> $valid_id_file,
            'status' => true,
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);
        
        $BankAccount = json_decode($wallet_account_data->BankAccount, true);
        foreach($BankAccount as $data) {
            // Store to Wallet Bank Account
            $wallet_account_bank = wallet_bank_account::create([
                'wallet_account_id' => $wallet_account->id,
                'branch' => $data['Branch'],
                'bank_name' => $data['bank_name'],
                'account_type' => $data['account_type'],
                'account_name' => $data['account_name'],
                'account_no' => $data['account_no'],
                'default' => $data['default'],
                'status' => $data['status'],
                'created_by' => $user->id,
                'updated_by' => $user->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        // Store Wallet Account Details
        $wallet_account_details = wallet_account_details::create([
            'wallet_account_id' => $wallet_account->id,
            'wallet_account_name' => $wallet_account_data->WalletAccountNameDetails,
            'wallet_account_no' => $wallet_account_data->WalletAccountNoDetails,
            'created_by' => $user->id,
            'updated_by' => $user->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // Store Wallet ammount limits config
        $wallet_amount_limits_config = wallet_amount_limits_config::create([
            'wallet_account_id' => $wallet_account->id,
            'amount_limit' => $this->checkValue($wallet_account_data->amount_limit),
            'am_per_transaction' => $this->checkValue($wallet_account_data->am_per_transaction),
            'am_per_day' => $this->checkValue($wallet_account_data->am_per_day),
            'am_per_month' => $this->checkValue($wallet_account_data->am_per_month),
            'am_per_year' => $this->checkValue($wallet_account_data->am_per_year),
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
            'lm_per_day' => $this->checkValue($wallet_account_data->c_lm_per_day),
            'lm_per_month' => $this->checkValue($wallet_account_data->c_lm_per_month),
            'lm_per_year' => $this->checkValue($wallet_account_data->c_lm_per_year),
            'allow_negative_balance' => $this->checkValue($wallet_account_data->c_allow_negative_balance),
            'com_daily_balance' => $this->checkValue($wallet_account_data->c_com_daily_balance),
            'com_daily_usage' => $this->checkValue($wallet_account_data->c_com_daily_usage),
            'created_by' => $user->id,
            'updated_by' => $user->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        // Store Wallet Limit no Transaction
        $wallet_limit_no_transaction = wallet_limit_no_transaction::create([
            'wlnt_id' => $wallet_limit_no_transaction_config->id,
            'lm_per_day' => $wallet_account_data->lm_per_day,
            'lm_per_month' => $wallet_account_data->lm_per_month,
            'lm_per_year' => $wallet_account_data->lm_per_year,
            'allow_negative_balance' => $wallet_account_data->allow_negative_balance,
            'created_by' => $user->id,
            'updated_by' => $user->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        /**
         * @ Store Wallet Service Matrix Config 
         **/
        $Services = json_decode($wallet_account_data->Services, true);
        foreach($Services as $data) {
            $wallet_service_matrix_config = wallet_service_matrix_config::create([
                'wallet_account_id' => $wallet_account->id,
                'service_id' => $data['service_id'],
                'redeem' => 'test',
                'admin_all' => $data['admin_all'],
                'admin_some' => $data['admin_some'],
                'merchant_all' => $data['merchant_all'],
                'merchant_some' => $data['merchant_some'],
                'branch_all' => $data['branch_all'],
                'branch_some' => $data['branch_some'],
                'agent_all' => $data['agent_all'],
                'agent_some' => $data['agent_some'],
                'created_by' => $user->id,
                'updated_by' => $user->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        /**
         * @ Store joint wallet account
         * @return wallet_joint_account
         **/

         // Check if Prepaid
        if($wallet_account_data->WalletAccountType === "5") {
            $store_wallet_joint_account_prepaid = wallet_joint_account::create([
                'wallet_account_id' => $wallet_account->id,
                'wallet_account_no' => $wallet_account_data->WalletAccountNo,
                'joint_wallet_account_no' => $wallet_account_data->joint_wallet_account_no,
            ]);
        }

        // Check if Credit
        if($wallet_account_data->WalletAccountType === "8") {
            $store_joint_wallet_account_credit = wallet_joint_account::create([
                'wallet_account_id' => $wallet_account->id,
                'wallet_account_no' => $wallet_account_data->WalletAccountNo,
                'joint_wallet_account_no' => $wallet_account_data->joint_wallet_account_no,
                'cms_credit_account_no' => $wallet_account_data->CMSCreditAccountNo
            ]);
        }

        return $wallet_account->id;
    }

    /**
     * @ Update Wallet Account
     * @param wallet_account_data
     **/
    public function updateWalletAccount($wallet_account_data)
    {
        $user = auth('api')->user();
        // Wallet ID
        $wallet_id = wallet_account::where('ess_id', '=', $wallet_account_data->username)->first();
        /**
         * @ Check kyc form 
         **/
        if($wallet_account_data->kyc_form != $wallet_id->kyc_form) {
            /**
             * @ Handle File Upload 
             **/
            //gets the original file name
            $kyc_form_ext = $wallet_account_data->kyc_form->getClientOriginalName();
            //gets the original file name except the extension
            $kyc_form_filename = pathinfo($kyc_form_ext, PATHINFO_FILENAME);
            //get the client origignal extension
            $kyc_form_file = time().'_'.$kyc_form_filename.'.'.$wallet_account_data->kyc_form->getClientOriginalExtension();
            // Store File
            $kyc_form = $wallet_account_data->kyc_form->storeAs('public/wallet_account_files/kyc_form', $kyc_form_file);
            // Delete Old File
            Storage::delete('public/wallet_account_files/kyc_form/'.$wallet_id->kyc_form);


        }
        else {
            // New Updated File
            $kyc_form_file = $wallet_id->kyc_form;
        }
        
        /**
         * @ Check for valid id 
         **/
        if($wallet_account_data->valid_id != $wallet_id->valid_id) {
            /**
             * @ Handle File Upload 
             **/
            $valid_id_ext = $wallet_account_data->valid_id->getClientOriginalName();
            //get the original file name excep the extension
            $valid_id_name = pathinfo($valid_id_ext, PATHINFO_FILENAME);
            //get the client original extension
            $valid_id_file = time().'_'.$valid_id_name.'.'.$wallet_account_data->valid_id->getClientOriginalExtension();
            // Store File
            $valid_id = $wallet_account_data->valid_id->storeAs('public/wallet_account_files/valid_id', $valid_id_file);
            // Delete Old file
            Storage::delete('public/wallet_account_files/valid_id/'.$wallet_id->valid_id);
        }
        else {
            // New Updated File
            $valid_id_file = $wallet_id->valid_id;
        }

        
        // Update to Wallet Account
        $wallet_account = wallet_account::where('ess_id', '=', $wallet_account_data->username)
        ->where('id', '=', $wallet_id->id)
        ->update([
            'wallet_type' => $wallet_account_data->WalletType,
            'wallet_account_type' => $wallet_account_data->WalletAccountType,
            //'wallet_account_no' => $wallet_account_data->WalletAccountNo,
            'wallet_account_name' => $wallet_account_data->WalletAccountName,
            'wallet_title' => $wallet_account_data->Wallettitle,
            'kyc_form' => $kyc_form_file,
            'valid_id'=> $valid_id_file,
        ]);

        $BankAccount = json_decode($wallet_account_data->BankAccount, true);
        foreach($BankAccount as $data) {
                    
                    // Create if ID is not exists
                    if(empty($data['id'])){
                        // Store to Wallet Bank Account
                        $wallet_account_bank = wallet_bank_account::create([
                            'wallet_account_id' => $wallet_id->id,
                            'branch' => $data['Branch'],
                            'bank_name' => $data['bank_name'],
                            'account_type' => $data['account_type'],
                            'account_name' => $data['account_name'],
                            'account_no' => $data['account_no'],
                            'default' => $data['default'],
                            'status' => $data['status'],
                            'created_by' => $user->id,
                            'updated_by' => $user->id,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]);
                    }
                    else {
                        // Update to Wallet Bank Account
                            $wallet_account_bank = wallet_bank_account::where('id', '=', $data['id'])
                                ->where('wallet_account_id', '=', $wallet_id->id)
                                ->update([
                                'branch' => $data['Branch'],
                                'bank_name' => $data['bank_name'],
                                'account_type' => $data['account_type'],
                                'account_name' => $data['account_name'],
                                'account_no' => $data['account_no'],
                                'default' => $data['default'],
                                'status' => $data['status'],
                                'updated_by' => $user->id,
                                'updated_at' => Carbon::now()
                        ]);
                    }
        }
        // Update Wallet Account Details
        $wallet_account_details = wallet_account_details::where('wallet_account_id', '=', $wallet_id->id)
            ->update([
                'wallet_account_name' => $wallet_account_data->WalletAccountNameDetails,
                'wallet_account_no' => $wallet_account_data->WalletAccountNoDetails,
                'created_by' => $user->id,
                'updated_by' => $user->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

        // Update Wallet ammount limits config
        $wallet_amount_limits_config = wallet_amount_limits_config::where('wallet_account_id', '=', $wallet_id->id)
            ->update([
                'amount_limit' => $this->checkValue($wallet_account_data->amount_limit),
                'am_per_transaction' => $this->checkValue($wallet_account_data->am_per_transaction),
                'am_per_day' => $this->checkValue($wallet_account_data->am_per_day),
                'am_per_month' => $this->checkValue($wallet_account_data->am_per_month),
                'am_per_year' => $this->checkValue($wallet_account_data->am_per_year),
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
                'lm_per_day' => $this->checkValue($wallet_account_data->c_lm_per_day),
                'lm_per_month' => $this->checkValue($wallet_account_data->c_lm_per_month),
                'lm_per_year' => $this->checkValue($wallet_account_data->c_lm_per_year),
                'allow_negative_balance' => $this->checkValue($wallet_account_data->c_allow_negative_balance),
                'com_daily_balance' => $this->checkValue($wallet_account_data->c_com_daily_balance),
                'com_daily_usage' => $this->checkValue($wallet_account_data->c_com_daily_usage),
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

        /**
         * @ Store Wallet Service Matrix Config 
         **/
        $test = json_decode($wallet_account_data->Services, true);
        foreach($test as $data) {
            $wallet_service_matrix_config = wallet_service_matrix_config::where('wallet_account_id', '=', $data['wallet_account_id'])
                ->where('service_id', '=', $data['service_id'])
                ->update([
                'redeem' => 'test',
                'admin_all' => $data['admin_all'],
                'admin_some' => $data['admin_some'],
                'merchant_all' => $data['merchant_all'],
                'merchant_some' => $data['merchant_some'],
                'branch_all' => $data['branch_all'],
                'branch_some' => $data['branch_some'],
                'agent_all' => $data['agent_all'],
                'agent_some' => $data['agent_some'],
                'updated_by' => $user->id,
                'updated_at' => Carbon::now()
            ]);
        }

        return $wallet_account . $wallet_account_bank;
    }

    /**
     * @ Store Service Matrix config 
     **/
    public function storeServiceMatrixConfig($wallet_account_data, $wallet_account_id)
    {
        // Store Wallet Account Service Matrix Config
        $user = auth('api')->user();
        foreach($wallet_account_data as $data) {
            $wallet_service_matrix_config = wallet_service_matrix_config::create([
                'wallet_account_id' => $wallet_account_id,
                'service_id' => $data['service_id'],
                'redeem' => 'test',
                'admin_all' => $data['admin_all'],
                'admin_some' => $data['admin_some'],
                'merchant_all' => $data['merchant_all'],
                'merchant_some' => $data['merchant_some'],
                'branch_all' => $data['branch_all'],
                'branch_some' => $data['branch_some'],
                'agent_all' => $data['agent_all'],
                'agent_some' => $data['agent_some'],
                'created_by' => $user->id,
                'updated_by' => $user->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
        return $wallet_service_matrix_config;
    }

    /**
     * @ Update Service Matrix Config 
     * @param wallet_account_date
     * @param essid
     **/
    public function updateServiceMatrixConfig($wallet_account_data, $essid)
    {
        // Update Wallet Account Service Matrix Config
        $user = auth('api')->user();
        // Wallet ID
        $wallet_id = wallet_account::where('ess_id', '=', $essid)->first();
        foreach($wallet_account_data as $data) {
            $wallet_service_matrix_config = wallet_service_matrix_config::where('wallet_account_id', '=', $wallet_id->id)
                ->where('id', '=', $data['id'])
                ->update([
                    'service_id' => $data['service_id'],
                    'redeem' => 'test',
                    'admin_all' => $data['admin_all'],
                    'admin_some' => $data['admin_some'],
                    'merchant_all' => $data['merchant_all'],
                    'merchant_some' => $data['merchant_some'],
                    'branch_all' => $data['branch_all'],
                    'branch_some' => $data['branch_some'],
                    'agent_all' => $data['agent_all'],
                    'agent_some' => $data['agent_some'],
                    'updated_by' => $user->id,
                    'updated_at' => Carbon::now()
                ]);
        }
        return $wallet_service_matrix_config;
    }

    /**
     * @ Get Service Matrix Config For Update 
     * @param essid
     **/
    public function showServiceMatrixConfig($essid)
    {
        $wallet_account = $this->connection
            ->table('wallet_account')
            ->where('ess_id', '=', $essid)
            ->select('id')
            ->first();
        $wallet_service_matrix_config = $this->connection
            ->table('wallet_service_matrix_config')
            ->join('wservice', 'wallet_service_matrix_config.service_id', '=', 'wservice.id')
            ->join('service_and_servicetype', 'wallet_service_matrix_config.service_id', 'service_and_servicetype.service_id')
            ->join('servicetypedetails', 'service_and_servicetype.service_type_id', '=', 'servicetypedetails.id')
            ->join('service_grouping', 'wservice.service_group_id', '=', 'service_grouping.id')
            ->select(
                'wallet_service_matrix_config.id',
                'wallet_service_matrix_config.wallet_account_id',
                'wallet_service_matrix_config.service_id',
                'wservice.service_name',
                'servicetypedetails.st_name',
                'service_grouping.group_description',
                'wallet_service_matrix_config.admin_all',
                'wallet_service_matrix_config.admin_some',
                'wallet_service_matrix_config.merchant_all',
                'wallet_service_matrix_config.merchant_some',
                'wallet_service_matrix_config.branch_all',
                'wallet_service_matrix_config.branch_some',
                'wallet_service_matrix_config.agent_all',
                'wallet_service_matrix_config.agent_some'
            )
            ->where('wallet_service_matrix_config.wallet_account_id', '=', $wallet_account->id)
            ->get();
        return $wallet_service_matrix_config;
    }

    /**
     * @ Search Wallet Joint Account 
     * @param wallet_account_no
     **/
    public function searchWalletJointAccount($wallet_account_no)
    {
        $wallet_account = $this->connection
            ->table('wallet_account')
            ->join('wallet_account_types', 'wallet_account.wallet_account_type', '=', 'wallet_account_types.id')
            ->select(
                'wallet_account.wallet_account_no',
                'wallet_account.wallet_account_name',
                'wallet_account.wallet_type',
                'wallet_account_types.wallet_account_type'
            )
            ->where('wallet_account.wallet_account_no', '=', $wallet_account_no)
            ->get();
        return $wallet_account;
    }

    /**
     * @ Search Wallet Account No Details 
     * @param wallet_account_no_details
     **/
    public function searchWalletAccountNo($wallet_account_no_details)
    {
        $account_details = wallet_account::where('wallet_account_no', '=', $wallet_account_no_details)->select('wallet_account_name')->first();
        if(!$account_details) {
            return 404;
        }
        return $account_details->wallet_account_name;                     
    }

    /**
     * @ show List of Wallet Accounts
     * @return WalletAccounts 
     **/
    public function showListWalletAccounts()
    {
        $list_of_wallet_account = $this->connection
            ->table('wallet_account')
            ->join('wallet_account_types', 'wallet_account.wallet_account_type', '=', 'wallet_account_types.id')
            ->select(
                'wallet_account.wallet_account_no',
                'wallet_account.wallet_account_name',
                'wallet_account.wallet_type',
                'wallet_account_types.wallet_account_type',
                'wallet_account.wallet_title',
                'wallet_account_types.wallet_account_type as wat'
            )
            ->whereIn('wallet_account.wallet_account_type', [1, 2])
            //->where('wallet_account.created_by', '=', auth('api')->user()->id)
            ->paginate(10);
        return $list_of_wallet_account;
    }

    /**
     * @ List of Wallet Accounts
     * @return WalletAccounts 
     * @param query
     **/
    public function searchListWalletAccount($query)
    {
        $list_of_wallet_account = $this->connection
            ->table('wallet_account')
            ->join('wallet_account_types', 'wallet_account.wallet_account_type', '=', 'wallet_account_types.id')
            ->select(
                'wallet_account.wallet_account_no',
                'wallet_account.wallet_account_name',
                'wallet_account.wallet_type',
                'wallet_account_types.wallet_account_type',
                'wallet_account.wallet_title',
                'wallet_account_types.wallet_account_type as wat'
            )
            ->orWhere('wallet_account.wallet_account_no', 'LIKE', '%'.$query.'%')
            ->orWhere('wallet_account.wallet_account_name', 'LIKE', '%'.$query.'%')
            ->orWhere('wallet_account.wallet_account_type', 'LIKE', '%'.$query.'%')
            ->orWhere('wallet_account.wallet_title', 'LIKE', '%'.$query.'%')
            ->orWhere('wallet_account_types.wallet_account_type', 'LIKE', '%'.$query.'%')
            //->where('wallet_account.created_by', '=', auth('api')->user()->id)
            ->paginate(10);
        return $list_of_wallet_account;
    }

    /**
     * @ List of Merchant Accounts
     * @return ListofMerchantAccounts 
     **/
    public function showListofMerchantsAccounts()
    {
        $list_of_merchant_account = $this->connection
            ->table('wallet_account')
            ->join('wallet_account_types', 'wallet_account.wallet_account_type', '=', 'wallet_account_types.id')
            ->select(
                'wallet_account.id',
                'wallet_account.wallet_account_no',
                'wallet_account.wallet_account_name',
                'wallet_account.wallet_type',
                'wallet_account_types.wallet_account_type as wat'
            )
            ->where('wallet_account.created_by', '=', 1)
            // Uncomment Below after Confirmation to sir meo regarding list of merchants
            //->where('wallet_account.wallet_account_type', '=', 3)
            ->get();
        return $list_of_merchant_account;
    }

    /**
     * @ Search Function 
     **/
    public function searchWalletAccount($query)
    {
        if (!$query) {
            $user = auth('api')->user();
            $walletAccount = $this->connection
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
                // ->get();
                //->latest()
                ->paginate(10);
        }
        else {
            $walletAccount = wallet_account::join('wallet_account_types', 'wallet_account.wallet_account_type', '=', 'wallet_account_types.id')
                ->select(
                    'wallet_account.ess_id',
                    'wallet_account.wallet_type',
                    'wallet_account_types.wallet_account_type',
                    'wallet_account.wallet_account_no',
                    'wallet_account.wallet_account_name',
                    'wallet_account.status')
                ->orWhere('wallet_account.ess_id', 'LIKE', "%".$query."%")
                ->orWhere('wallet_account.wallet_type', 'LIKE', "%".$query."%")
                ->orWhere('wallet_account.wallet_account_no', 'LIKE', "%".$query."%")
                ->orWhere('wallet_account.wallet_account_name', 'LIKE', "%".$query."%")
                //->orWhere('wallet_account.wallet_title', 'LIKE', "%".$query."%")
                ->paginate(10);
        }
        return $walletAccount;
    }

    /**
     * @ Get Services 
     **/
    public function showServiceMatrix()
    {
        $services = $this->connection
            ->table('service_matrix')
            ->join('wservice', 'service_matrix.service_id', '=', 'wservice.id')
            ->join('service_and_servicetype', 'service_matrix.service_id', 'service_and_servicetype.service_id')
            ->join('servicetypedetails', 'service_and_servicetype.service_type_id', '=', 'servicetypedetails.id')
            ->join('service_grouping', 'wservice.service_group_id', '=', 'service_grouping.id')
            ->select(
                'service_matrix.id',
                'service_matrix.service_id',
                'wservice.service_name',
                'servicetypedetails.st_name',
                'service_grouping.group_description',
               //  'service_matrix.admin_all',
               //  'service_matrix.admin_some',
               //  'service_matrix.merchant_allP',
               //  'service_matrix.merchant_some',
               //  'service_matrix.branch_all',
               //  'service_matrix.branch_some',
               //  'service_matrix.agent_all',
               //  'service_matrix.agent_some'
            )
            ->get();
        return $services;
    }


    /***********************************************************************
     * Helpers Functions
     * Below Add Helpers Function
     * 
     ***********************************************************************/
    /**
     * @ Check Value of the $value
     * @return $value 
     **/
    public function checkValue($value)
    {
        if($value == 'true'){
            return true;
        }
        else{
            return false;
        }
    }
    
}

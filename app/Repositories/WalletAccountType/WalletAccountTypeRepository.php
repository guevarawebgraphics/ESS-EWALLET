<?php

namespace App\Repositories\WalletAccountType;

use DB;
use Keygen;
use Carbon\Carbon;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Illuminate\Http\Request;
//use Your Model
use App\Models\WalletAccountType\wallet_account_type;

/**
 * Class WalletAccountTypeRepository.
 */
class WalletAccountTypeRepository
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
     *@ Get All Wallet Account Types 
     **/
    public function get_wallet_account_types(){
        $user = auth('api')->user();
        if($user->user_type_id == 1){
            $wallet_account_type = wallet_account_type::where('created_by', '=', 1)
                                    ->select(
                                        'id',
                                        'type_code',
                                        'wallet_account_type',
                                        'wallet_type',
                                        'status')
                                    ->get();
        }
        else {
            $wallet_account_type = wallet_account_type::whereNotIn('id', [1, 2])
                                    ->select(
                                        'id',
                                        'type_code',
                                        'wallet_account_type',
                                        'wallet_type',
                                        'status')
                                    ->get();
        }

        return $wallet_account_type;

    }

    /**
     * @return string
     *  Store Wallet Account Type
     */
    public function store_wallet_account_type($wallaccounttype){
        $user = auth('api')->user();
        $type_code = 'EW' . $this->generate_type_code();
        $wallet_account_type = wallet_account_type::create([
                                'type_code' => $type_code,
                                'wallet_account_type' => $wallaccounttype->wallet_account_type,
                                'wallet_type' => $wallaccounttype->wallet_type,
                                'created_by' => $user->id,
                                'updated_by' => $user->id,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now()
                            ]);
        return $wallet_account_type;
    }

    /**
     * @ Update Wallet Account Type 
     **/
    public function update_wallet_account_type($wallaccounttype){
        $user = auth('api')->user();
        $type_code = 'EW' . $this->generate_type_code();
        $wallet_account_type = wallet_account_type::where('id', '=', $wallaccounttype->id)
                            ->where('created_by', '=', $user->id)
                            ->update([
                                'wallet_account_type' => $wallaccounttype->wallet_account_type,
                                'wallet_type' => $wallaccounttype->wallet_type,
                                'status' => $wallaccounttype->status,
                                'updated_by' => $user->id,
                                'updated_at' => Carbon::now()
                            ]);
        return $wallet_account_type;
    }

    /******************************************************************************************
     *  Helpers Functions
     *  Below Add Helpers Function
     *  Securities
     ******************************************************************************************/

    /**
     * @ Generate Wallet Account Type Code
     **/
    public function generate_type_code(){
        $type_code = $this->generate_no();

        /**
         * @ check if there is existing Wallet Account Type Code
         * @ Generate a new one if already exists 
         **/
        while (wallet_account_type::where('type_code', '=', $type_code)->count() > 0){
            $type_code = $this->generate_no();
        }
        return $type_code;
    }


    /**
     * @ Generate No
     * @return type_code 
     **/
    public function generate_no(){
        $type_code = Keygen::length(6)->numeric()->generate();

        return $type_code;
    }


}

<?php

namespace App\Repositories\WalletAccountType;

use DB;
use Keygen;
use Carbon\Carbon;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Illuminate\Http\Request;
//use Your Model

/**
 * Class WalletAccountTypeRepository.
 */
class WalletAccountTypeRepository
{
    /**
     *@ Get All Wallet Account Types 
     **/
    public function get_wallet_account_types(){
        $user = auth('api')->user();
        $wallet_account_type = DB::connection('mysql')
                                ->table('wallet_account_types')
                                ->select(
                                    'id',
                                    'type_code',
                                    'wallet_account_type',
                                    'status')
                                ->where('created_by', '=', $user->id)
                                ->get();
        return $wallet_account_type;

    }

    /**
     * @return string
     *  Store Wallet Account Type
     */
    public function store_wallet_account_type($wallaccounttype){
        $user = auth('api')->user();
        $type_code = 'EW' . $this->generate_type_code();
        $wallet_account_type = DB::connection('mysql')
                            ->table('wallet_account_types')
                            ->insert([
                                'type_code' => $type_code,
                                'wallet_account_type' => $wallaccounttype->wallet_account_type,
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
        $wallet_account_type = DB::connection('mysql')
                            ->table('wallet_account_types')
                            ->where('id', '=', $wallaccounttype->id)
                            ->where('created_by', '=', $user->id)
                            ->update([
                                'wallet_account_type' => $wallaccounttype->wallet_account_type,
                                'status' => $wallaccounttype->status,
                                'updated_by' => $user->id,
                                'updated_at' => Carbon::now()
                            ]);
        return $wallet_account_type;
    }

    /**
     * @ Generate Wallet Account Type Code
     **/
    public function generate_type_code(){
        $account_no = Keygen::length(6)->numeric()->generate();
        return $account_no;
    }


}

<?php

namespace App\Repositories\Gate;

use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model
use DB;
use App\Models\WalletAccount\wallet_account;
/**
 * Class GateRepository.
 */
class GateRepository
{
    /**
     * @ connection 
     **/
    private $connection;
    private $user;


    /**
     * @ constructor
     **/
    public function __construct()
    {
        $this->user = auth('api')->user();
        $this->connection = DB::connection('mysql');

    }

    public function gate()
    {
        return $gate = wallet_account::where('ess_id', $this->user->username)->select('wallet_account_type')->first();
    }
}

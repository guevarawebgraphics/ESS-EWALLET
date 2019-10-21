<?php

namespace App\Http\Controllers\Api\Account;

use DB;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @ SOLID(SRP)
 * @ Repository
 **/
use App\Repositories\Account\AccountRepository;

class AccountController extends Controller
{
    /**
     * @ Get Account
     * @ mysql2 (ESS Database)
     * @ Return Response JSon
     **/
    public function GetAccountViaEssId(Request $request, AccountRepository $AccountRepository, $essid){
        $Account = $AccountRepository->get_all_account($essid);
        return response()->json($Account);
    }
}

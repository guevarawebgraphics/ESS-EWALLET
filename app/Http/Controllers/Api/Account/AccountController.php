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
     * @ Repository Implementation 
     **/ 
    protected $accountRepository;

    /**
     * Create new controller instance
     * @param AccountRespository $AccountRepository
     * @ constructor 
     **/
    public function __construct(AccountRepository $AccountRepository)
    {
        $this->accountRepository = $AccountRepository;
        $this->middleware('auth:api');
    }

    /**
     * @ Get Account
     * @ mysql2 (ESS Database)
     * @ Return Response JSon
     * @param essid
     **/
    public function showAccountViaEssId(Request $request, $essid)
    {
        return response()->json($this->accountRepository->showAccountViaEssId($essid));
    }

    /**
     * @ Generate Wallet Account No
     **/ 
    public function GenerateAccountNo(Request $request)
    {
        return response()->json($this->accountRepository->generate_account_no());
    }
}

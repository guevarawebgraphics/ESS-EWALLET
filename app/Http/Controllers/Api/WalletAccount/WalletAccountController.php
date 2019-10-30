<?php

namespace App\Http\Controllers\Api\WalletAccount;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\WalletAccount\ValidateFirstStep;
/**
 * @ Form Request 
 **/
use App\Http\Requests\WalletAccount\StoreWalletAccount;

/**
 * @ SOLID SRP
 * @Repository 
 **/
use App\Repositories\WalletAccount\WalletAccountRepository;

class WalletAccountController extends Controller
{
    /**
     * @ Repository Impementation 
     **/
    protected $WalletAccount;

    /**
     * Create new controller instance
     * @param WalletAccountRepository $WalletAccountRepository
     * @ constructor 
     **/
    public function __construct(WalletAccountRepository $WalletAccountRepository){
        $this->WalletAccount = $WalletAccountRepository;
        $this->middleware('auth:api');
    }

    /**
     * @ Get all E-Wallet Account 
     **/
    public function get_all_wallet_account(){
        $WalletAccount = $this->WalletAccount->get_all_wallet_account();
        return response()->json($WalletAccount);
    }

    /**
     * @ Store Wallet Account 
     **/
    public function store_wallet_account(StoreWalletAccount $request){
        $WalletAccount = $this->WalletAccount->store_wallet_account($request);
        return response()->json([
            'status' => 'success'
        ]);
    }


    public function ValidateFirstStep(ValidateFirstStep $request){
        return response()->json('hello');
    }
}

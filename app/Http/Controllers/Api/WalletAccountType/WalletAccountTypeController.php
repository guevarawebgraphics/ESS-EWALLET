<?php

namespace App\Http\Controllers\Api\WalletAccountType;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/**
 * @ Form Request 
 **/
use App\Http\Requests\WalletAccountType\StoreWalletAccountType;
/**
 * @ SOLID SRP
 * @Repository 
 **/
use App\Repositories\WalletAccountType\WalletAccountTypeRepository;

class WalletAccountTypeController extends Controller
{
    /**
     * @ Repository Implementation 
     **/
    protected $walletAccountRepository;

    /**
     * Create new controller instance
     * @param WalletAccountTypeRepository $walletAccountRepository
     * @ constructor 
     **/
    public function __construct(WalletAccountTypeRepository $WalletAccountTypeRepository){
        $this->walletAccountRepository = $WalletAccountTypeRepository;
        $this->middleware('auth:api');
    }

    /**
     * @ Show All Wallet Account Type 
     **/
    public function showAllWalletAccountType() {
        return response()->json($this->walletAccountRepository->showAllWalletAccountType());
    }

    /**
     * @ Get all wallet account types 
     **/
    public function GetAllWalletAccountType(){
        $wallet_account_type = $this->walletAccountRepository->get_wallet_account_types();
        return response()->json($wallet_account_type);
    }

    /**
     * @ Store Wallet Account Type 
     **/
    public function StoreWalletAccountType(StoreWalletAccountType $request){
        $wallet_account_type = $this->walletAccountRepository->store_wallet_account_type($request);

        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * @ Update Wallet Account Type 
     **/
    public function UpdateWalletAccountType(StoreWalletAccountType $request){
        $wallet_account_type = $this->walletAccountRepository->update_wallet_account_type($request);

        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * @ Search Wallet Account Type 
     **/
    public function searchWalletAccountType($query){
        return response()->json($this->walletAccountRepository->searchWalletAccountType($query));
    }

}

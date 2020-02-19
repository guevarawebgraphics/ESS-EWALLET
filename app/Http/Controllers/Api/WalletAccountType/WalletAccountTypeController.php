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
    public function __construct(WalletAccountTypeRepository $WalletAccountTypeRepository)
    {
        $this->walletAccountRepository = $WalletAccountTypeRepository;
        $this->middleware('auth:api');
    }

    /**
     * @ Show All Wallet Account Type 
     **/
    public function showAllWalletAccountType() 
    {
        return response()->json($this->walletAccountRepository->showAllWalletAccountType());
    }

    /**
     * @ Get all wallet account types 
     **/
    public function showWalletAccountTypes()
    {
        return response()->json($this->walletAccountRepository->showWalletAccountTypes());
    }

    /**
     * @ Store Wallet Account Type 
     **/
    public function storeWalletAccountType(StoreWalletAccountType $request)
    {
        $wallet_account_type = $this->walletAccountRepository->storeWalletAccountType($request);

        return response()->json(['status' => 'success']);
    }

    /**
     * @ Update Wallet Account Type 
     **/
    public function updateWalletAccountType(StoreWalletAccountType $request)
    {
        $wallet_account_type = $this->walletAccountRepository->updateWalletAccountType($request);

        return response()->json(['status' => $wallet_account_type]);
    }

    /**
     * @ Search Wallet Account Type 
     **/
    public function searchWalletAccountType($query)
    {
        return response()->json($this->walletAccountRepository->searchWalletAccountType($query));
    }

}

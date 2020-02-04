<?php

namespace App\Http\Controllers\Api\WalletAccount;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\WalletAccount\ValidateFirstStep;
/**
 * @ Form Request 
 **/
use App\Http\Requests\WalletAccount\StoreWalletAccount;
use App\Http\Requests\WalletAccount\UpdateWalletAccount;

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
    public function __construct(WalletAccountRepository $WalletAccountRepository)
    {
        $this->WalletAccount = $WalletAccountRepository;
        $this->middleware('auth:api');
    }

    /**
     * @ Get all E-Wallet Account 
     **/
    public function showAllWalletAccount()
    {
        return response()->json($this->WalletAccount->showAllWalletAccount());
    }

    /**
     * @ Store Wallet Account 
     **/
    public function storeWalletAccount(StoreWalletAccount $request)
    {
        $WalletAccount = $this->WalletAccount->storeWalletAccount($request);
        return response()->json(['status' => $WalletAccount]);
    }
    
    /**
     * @ Store Servicec Matrix Config 
     **/
    public function storeServiceMatrixConfig(Request $request, $wallet_account_id)
    {
        $WalletAccount = $this->WalletAccount->storeServiceMatrixConfig($request->all(), $wallet_account_id);
        return response()->json(['status' => 'success']);
    }

    /**
     * @ Update Wallet Account
     **/
    public function updateWalletAccount(UpdateWalletAccount $request)
    {
        $WalletAccount = $this->WalletAccount->updateWalletAccount($request);
        return response()->json(['status' => 'success']);
    }

    /**
     * @ Get Wallet Account Details 
     **/
    public function showWalletAccountDetails(Request $request , $essid)
    {
        return response()->json( $this->WalletAccount->showWalletAccountDetails($essid));
    }

    /**
     * @ Get Wallet Bank Account 
     **/
    public function showWalletBankAccount(Request $request, $essid)
    {
        return response()->json($this->WalletAccount->showWalletBankAccount($essid));
    }

    /**
     * @ Get Service Matrix Config 
     * @param essid
     **/
    public function showServiceMatrixConfig(Request $request, $essid)
    {
        return response()->json($this->WalletAccount->showServiceMatrixConfig($essid));
    }

    /**
     * @ Update Servicec Matrix Config 
     * @param essid
     **/
    public function updateServiceMatrixConfig(Request $request, $essid)
    {
        $WalletAccount = $this->WalletAccount->updateServiceMatrixConfig($request->all(), $essid);
        return response()->json($WalletAccount);
    }

    /**
     * @ Search Wallet Account Details 
     * @param wallet_account_no_details
     **/
    public function searchWalletAccountNo($wallet_account_no_details)
    {
        return response()->json($this->WalletAccount->searchWalletAccountNo($wallet_account_no_details));
    }

    /**
     * @ Search Wallet Joint Account 
     * @param wallet_account_no
     **/
    public function searchWalletJointAccount($wallet_account_no)
    {
        return response()->json($this->WalletAccount->searchWalletJointAccount($wallet_account_no));
    }

    /**
     * @ ListOfWalletAccounts 
     * @return ListWalletAccounts
     **/
    public function showListWalletAccounts()
    {
        return response()->json($this->WalletAccount->showListWalletAccounts());
    }

    /**
     * @ searchListWalletAccount 
     * @param query
     **/
    public function searchListWalletAccount($query)
    {
        return response()->json($this->WalletAccount->searchListWalletAccount($query));
    }

    /**
     * @ List of Merchant Accounts 
     * @return merchantAccounts
     **/
    public function showListofMerchantsAccounts()
    {
        return response()->json($this->WalletAccount->showListofMerchantsAccounts());
    }

    /**
     * @ Search Wallet Account 
     * @param query
     **/
    public function searchWalletAccount($query) 
    {
        return response()->json($this->WalletAccount->searchWalletAccount($query));
    }

    /**
     * @ Search Wallet Account 
     **/
    public function showServiceMatrix()
     {
        return response()->json($this->WalletAccount->showServiceMatrix());
    }

}

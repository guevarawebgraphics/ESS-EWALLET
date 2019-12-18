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
    public function __construct(WalletAccountRepository $WalletAccountRepository){
        $this->WalletAccount = $WalletAccountRepository;
        $this->middleware('auth:api');
    }

    /**
     * @ Get all E-Wallet Account 
     **/
    public function GetAllWalletAccount(){
        $WalletAccount = $this->WalletAccount->GetAllWalletAccount();
        return response()->json($WalletAccount);
    }

    /**
     * @ Store Wallet Account 
     **/
    public function StoreWalletAccount(StoreWalletAccount $request){
        $WalletAccount = $this->WalletAccount->StoreWalletAccount($request);
        return response()->json([
            'status' => $WalletAccount
        ]);
    }
    
    /**
     * @ Store Servicec Matrix Config 
     **/
    public function StoreServiceMatrixconfig(Request $request, $wallet_account_id){
        $WalletAccount = $this->WalletAccount->StoreServiceMatrixConfig($request->all(), $wallet_account_id);
        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * @ Update Wallet Account
     **/
    public function UpdateWalletAccount(UpdateWalletAccount $request){
        $WalletAccount = $this->WalletAccount->UpdateWalletAccount($request);
        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * @ Get Wallet Account Details 
     **/
    public function GetWalletAccountDetails(Request $request , $essid){
        $WalletAccount = $this->WalletAccount->GetWalletAccountDetails($essid);
        return response()->json($WalletAccount);
    }

    /**
     * @ Get Wallet Bank Account 
     **/
    public function GetWalletBankAccount(Request $request, $essid){
        $WalletAccount = $this->WalletAccount->GetWalletBankAccount($essid);
            return response()->json($WalletAccount);
        
    }

    /**
     * @ Get Service Matrix Config 
     **/
    public function GetServiceMatrixConfig(Request $request, $essid){
        $WalletAccount = $this->WalletAccount->GetServiceMatrixConfig($essid);
        return response()->json($WalletAccount);
    }

    /**
     * @ Update Servicec Matrix Config 
     **/
    public function UpdateServiceMatrixConfig(Request $request, $essid){
        $WalletAccount = $this->WalletAccount->UpdateServiceMatrixConfig($request->all(), $essid);
        return response()->json($WalletAccount);
    }

    /**
     * @ Search Wallet Account Details 
     **/
    public function SearchWalletAccountNo($wallet_account_no_details){
        $WalletAccount = $this->WalletAccount->SearchWalletAccountNo($wallet_account_no_details);
        return response()->json($WalletAccount);
    }

    /**
     * @ Search Wallet Joint Account 
     **/
    public function SearchWalletJointAccount($wallet_account_no){
        $wallet_account = $this->WalletAccount->SearchWalletJointAccount($wallet_account_no);
        return response()->json($wallet_account);
    }

    /**
     * @ ListOfWalletAccounts 
     **/
    public function ListOfWalletAccounts(){
        $ListOfWalletAccounts = $this->WalletAccount->ListOfWalletAccounts();
        return response($ListOfWalletAccounts);
    }


    public function ValidateFirstStep(ValidateFirstStep $request){
        return response()->json('hello');
    }
}

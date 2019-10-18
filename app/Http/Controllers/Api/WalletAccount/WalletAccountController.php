<?php

namespace App\Http\Controllers\Api\WalletAccount;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\WalletAccount\ValidateFirstStep;

class WalletAccountController extends Controller
{
    public function ValidateFirstStep(ValidateFirstStep $request){
        return response()->json('hello');
    }
}

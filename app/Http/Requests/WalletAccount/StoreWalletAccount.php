<?php

namespace App\Http\Requests\WalletAccount;

use Illuminate\Foundation\Http\FormRequest;

class StoreWalletAccount extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|max:255',
            'WalletType' => 'required|max:255',
            'WalletAccountType' => 'required|max:255',
            'WalletAccountNo' => 'required|max:255',
            'WalletAccountName' => 'required|max:255',
            'bank_name' => 'required|max:255',
            'Branch' => 'required|max:255',
            'account_type' => 'required|max:255',
            'account_name' =>'required|max:255',
            'account_no' =>'required|max:255',
        ];
    }
}

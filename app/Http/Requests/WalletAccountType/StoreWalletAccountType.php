<?php

namespace App\Http\Requests\WalletAccountType;

use Illuminate\Foundation\Http\FormRequest;

class StoreWalletAccountType extends FormRequest
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
            'wallet_account_type' => 'required|max:255',
        ];
    }
}

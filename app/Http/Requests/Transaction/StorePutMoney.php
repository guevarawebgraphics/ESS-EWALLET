<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class StorePutMoney extends FormRequest
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
            'put_money_amount' => 'required',
            'bank_name' => 'required|max:255',
            'branch' => 'required|max:255',
            'accountType' => 'required|max:255',
            'accountName' => 'required|max:255',
            'accountNo' => 'required|max:255',
            'depositSlip' => 'required|file',
        ];
    }
}

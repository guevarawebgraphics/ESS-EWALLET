<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class StorePrefund extends FormRequest
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
            'prefund_amount' => 'required',
            'name_of_bank' => 'required|max:255',
            'branch' => 'required|max:255',
            'account_type' => 'required|max:255',
            'account_name' => 'required|max:255',
            'account_no' => 'required|max:255',
            'deposit_slip' => 'required|max:255',
            'remarks' => 'required|max:255',
        ];
    }
}

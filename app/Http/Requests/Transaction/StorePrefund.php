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
            'prefundAmount' => 'required',
            'nameofbank' => 'required|max:255',
            'branch' => 'required|max:255',
            'accountType' => 'required|max:255',
            'accountName' => 'required|max:255',
            'accountNo' => 'required|max:255',
            'depositSlip' => 'required|file',
            //'remarks' => 'required|max:255',
        ];
    }

    /**
     * Custom message for validation rules
     * 
     * @return array
     **/
    public function messages()
    {
        return [
            'depositSlip.required' => 'Deposit Slip is Required'
        ];
    }
}

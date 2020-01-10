<?php

namespace App\Http\Requests\Services;

use Illuminate\Foundation\Http\FormRequest;

class JointValidate extends FormRequest
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
            'service_code' => 'required', 
            'service_name' => 'required',
            'service_description' => 'required',
            'wallet_type' => 'required', 
            'joint_services' => 'required'
        ];
    }
}

<?php

namespace App\Http\Requests\ServiceGateway;

use Illuminate\Foundation\Http\FormRequest;

class ServiceGateway extends FormRequest
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
            'gateway_code' => 'required',
            'gateway_name' => 'required',
        ];
    }
}

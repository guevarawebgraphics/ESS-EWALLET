<?php

namespace App\Http\Requests\ServiceMatrix;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceGroup extends FormRequest
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
            'group_description' => 'required|max:255|unique:service_grouping'
        ];
    }
}

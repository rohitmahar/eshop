<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'shipping_address' => 'required|min:3',
            'phone_number' => 'required|min:9',
            'agreed' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'agreed.required' => 'Terms Need to be Agreed.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
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
        $rules = [
            'category' => 'required|min:2',
        ];

        foreach($this->request->get('subcategories') as $key => $val)
        {
            $rules['subcategories.'.$key] = 'required|min:2';
        }

        return $rules;
    }
}

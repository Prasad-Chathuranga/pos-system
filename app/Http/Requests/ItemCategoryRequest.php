<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemCategoryRequest extends FormRequest
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
            'category_code' => 'required',
            'category_description' => 'required',
            'category_status' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'category_description.required' => 'A Category Description is required !',
            'category_status.required' => 'Please Select Category Status !',
        ];
    }
}

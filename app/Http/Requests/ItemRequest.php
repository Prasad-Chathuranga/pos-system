<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            "category_code" => 'required',
            "description" => 'required',
            "code" => 'required',
            "item_no" => 'required',
            "item_code" => 'required',
            "item_description" => 'required',
            "soh" => 'required',
            "bin" => 'required',
            "sale_price" => 'required',
            "cost_price" => 'required'
        ];
    }
}

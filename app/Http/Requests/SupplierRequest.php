<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            "code" => "required",
            "name" => "required",
            "country" => "required",
            "city" => "required",
            "address" => "required",
            "contact_no_1" => "required",
            "contact_no_2" => "required",
            "status" => "required",
            "credit_balance" => "required",
            "about" => "required"
        ];
    }
}

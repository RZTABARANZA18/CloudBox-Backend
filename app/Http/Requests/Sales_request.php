<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Sales_request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'quantity'      => 'integer',
            'total_amount'  => 'required|numeric|between:0.01,9999999.99',
            'prod_id'       => 'required|integer',
            'trans_id'      => 'required|integer',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Transaction_request extends FormRequest
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
            'trans_type'        => 'required|string|max:255',
            'income'            => 'required|integer',
            'description'       => 'string|max:255',
            'update_balance'    => 'required|numeric|between:0.01,9999999.99',
            'location'          => 'required|string|max:255',
            'account_id'        => 'required|integer',
        ];
    }
}

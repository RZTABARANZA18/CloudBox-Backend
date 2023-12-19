<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Activity_request extends FormRequest
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
            'type'          => 'required|string|max:255',
            'prod_id'       => 'required|integer',
            'account_id'    =>  'required|integer',
        ];
    }
}

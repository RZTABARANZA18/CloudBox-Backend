<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Product_request extends FormRequest
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
    // public function rules(): array
    // {
    //     if (request()->routeIs('product.store')) {
    //         return [
    //             'prod_name'     => 'required|string|max:255',
    //             'price'         => 'required|numeric|between:0.01,9999999.99',
    //             'description'   => 'string|max:255',
    //             'status'        => 'string|max:255',
    //             'category_id'   => 'required|integer',
    //             'image'         => 'image|mimes:jpg,bmp,png|max:2048',
    //         ];
    //     } else if (request()->routeIs('product.image')) {
    //         return [
    //             'image'         => 'required|image|mimes:jpg,bmp,png|max:2048',
    //         ];
    //     }

    //     // Return an empty array if no condition matches
    //     return [];
    // }

    public function rules(): array
    {
        return [
            'prod_name'     => 'required|string|max:255',
            'price'         => 'required|numeric|between:0.01,9999999.99',
            'description'   => 'string|max:255',
            'status'        => 'string|max:255',
            'category_id'   => 'required|integer',
            'image'         => 'image|mimes:jpg,bmp,png|max:2048',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
           'product_title'=>'required',
           'category'=>'required',
           'selling_price'=>'required|numeric',
           'discount_price'=>'required|numeric',
           'main_thumbnail'=>'required|image|mimes:png,jpg,jpeg'
        ];
    }
}

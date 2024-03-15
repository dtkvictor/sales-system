<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'thumb' => 'image|max:30720',
            'name' => 'required|min:3|max:255',
            'price' => 'required|numeric|decimal:1,2|min:1|max:99999999.99',
            'inventory' => 'required|numeric|integer|min:0|max:2147483647',
            'category' => 'required|exists:categories,id',
            'description' => 'required|min:3|max:500',      
        ];
    }
}

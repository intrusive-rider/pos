<?php

namespace App\Http\Requests\Inventory;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => [
                'required',
                'max:255',
                Rule::unique(Product::class)->ignore($this->product),
            ],
            'price' => 'required|numeric|min:1',
            'stock' => 'required|numeric|min:1',
            'category' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,bmp|max:2048',
        ];
    }
}

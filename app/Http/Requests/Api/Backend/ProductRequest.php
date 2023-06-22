<?php

namespace App\Http\Requests\Api\Backend;

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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'max:255'],
            'sku' => ['nullable'],
            'is_featured' => ['required', 'boolean'],
            'is_active' => ['required', 'boolean'],
            'description' => ['nullable', 'max:255'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'orig_price' => ['required', 'numeric'],
            'discounted_price' => ['nullable'],
            'standard_shipping_price' => ['required', 'numeric'],
            'express_shipping_price' => ['required', 'numeric'],
            'stocks' => ['nullable'],
            'supplier_id' => ['required', 'integer', 'exists:suppliers,id'],
        ];
    }
}

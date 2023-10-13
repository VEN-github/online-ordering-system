<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Backend;

use Illuminate\Foundation\Http\FormRequest;

class InventoryRequest extends FormRequest
{
    /** Determine if the user is authorized to make this request. */
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
            'product_id' => 'required|exists:products,id',
            'variation_id' => 'nullable|exists:variations,id',
            'added_stock' => 'required|numeric|min:1,',
        ];
    }
}

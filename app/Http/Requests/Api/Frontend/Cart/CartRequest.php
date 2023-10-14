<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Frontend\Cart;

use App\Rules\CheckVariationExistsRule;
use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    /** @return array<string, \Illuminate\Contracts\Validation\Rule|array|string> */
    public function rules(): array
    {
        return [
            'id' => 'required',
            'variation_id' => ['nullable', new CheckVariationExistsRule()],
            'quantity' => ['required', 'numeric'],
        ];
    }
}

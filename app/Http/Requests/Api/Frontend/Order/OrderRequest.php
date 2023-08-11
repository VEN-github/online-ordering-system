<?php

namespace App\Http\Requests\Api\Frontend\Order;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'email' => [],
            'first_name' => [],
            'last_name' => [],
            'company' => [],
            'address' => [],
            'unit' => [],
            'city' => [],
            'country' => [],
            'state' => [],
            'postal_code' => [],
            'phone' => [],
            'payment_method' => ['required', 'string'],
            'payment_status' => ['required', 'string'],
            'status' => ['required', 'string'],
            'shipping_method' => ['required', 'string'],
            'total_price' => ['required']
        ];
    }
}

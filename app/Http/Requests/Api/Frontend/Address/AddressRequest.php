<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Frontend\Address;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'first_name' => ['required'],
            'last_name' => ['required'],
            // 'company' => ['required'],
            'address' => ['required'],
            // 'unit' => ['required'],
            'city' => ['required'],
            'country' => ['required'],
            'state' => ['required'],
            'postal_code' => ['required'],
            'phone' => ['required'],
            'is_primary' => ['required', 'boolean'],
        ];
    }
}

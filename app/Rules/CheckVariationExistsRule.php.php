<?php

declare(strict_types=1);

namespace App\Rules;

use App\Models\Variation\Variation;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckVariationExistsRule implements ValidationRule
{
    /** @param Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (filled($value) && ! Variation::find($value)->exists()) {
            $fail('Ooops! Product not found.');
        }
    }
}

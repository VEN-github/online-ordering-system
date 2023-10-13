<?php

declare(strict_types=1);

namespace App\Models\Variation\Traits;

use Database\Factories\VariationFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

trait VariationMethod
{
    use HasFactory;

    protected static function newFactory(): Factory
    {
        return VariationFactory::new();
    }
}

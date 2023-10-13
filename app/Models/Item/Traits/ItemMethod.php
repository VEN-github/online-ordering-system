<?php

declare(strict_types=1);

namespace App\Models\Item\Traits;

use Database\Factories\ItemFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

trait ItemMethod
{
    use HasFactory;

    protected static function newFactory(): Factory
    {
        return ItemFactory::new();
    }

    protected function totalPrice(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value * 100,
        );
    }
}

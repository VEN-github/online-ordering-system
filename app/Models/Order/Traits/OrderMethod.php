<?php

namespace App\Models\Order\Traits;

use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

trait OrderMethod
{
    use HasFactory;

    protected static function newFactory(): Factory
    {
        return OrderFactory::new();
    }

    protected function totalPrice(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value * 100,
        );
    }
}
